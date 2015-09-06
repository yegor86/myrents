<?php
declare(ticks=1); 
/**
 * класс-демон для запуска и контроля дочерних процессов  отпраки смс
 */
class mailerdCommand extends CConsoleCommand {

    // Максимальное количество дочерних процессов
    public $maxProcesses = false; 
    // Когда установится в TRUE, демон завершит работу
    protected $stop_server = FALSE;
    // Здесь будем хранить запущенные дочерние процессы
    protected $currentJobs = array();
    
        /**
     * конструктор - добавлен вывод в консоль
     * @param type $name
     * @param type $runner 
     */
    public function __construct($name, $runner) {
	parent::__construct($name, $runner);
	$this->maxProcesses = Yii::app()->params['mailerMaxChildProcess'];
	echo "Сonstructed daemon controller" . PHP_EOL;
	// Ждем сигналы SIGTERM и SIGCHLD
	pcntl_signal(SIGTERM, array($this, "childSignalHandler"));
	pcntl_signal(SIGCHLD, array($this, "childSignalHandler"));
    }
    
    public function run() {
	$baseDir = dirname(__FILE__);
	ini_set('error_log', $baseDir . '/../../log/mailer-error.log');
	fclose(STDIN);

	fclose(STDOUT);
	fclose(STDERR);
	$STDIN = fopen('/dev/null', 'r');
	$STDOUT = fopen($baseDir . '/../../log/mailer.log', 'ab');
	$STDERR = fopen($baseDir . '/../../log/mailerd.log', 'ab');

	echo "Running daemon controller" . PHP_EOL;

	// Пока $stop_server не установится в TRUE, гоняем бесконечный цикл
	while (!$this->stop_server) {
	    // Если уже запущено максимальное количество дочерних процессов, ждем их завершения
	    while (count($this->currentJobs) >= $this->maxProcesses) {
		echo "Maximum children allowed, waiting 10sec..." . PHP_EOL;
		sleep(10);
	    }

	    Yii::app()->db->setActive(true);
	    $DBcommand = Yii::app()->db->createCommand()
		->select('value')
		->from('DBVariables')
		->where('name = :param',array(':param'=>'DJobStatus'));
	    $jobStatus = $DBcommand->queryRow();
	    Yii::app()->db->setActive(false);	    
	    if($jobStatus['value'] == 'queue'){
		$this->launchJob();
	    }else{
		//	echo "no jobs founded, sleeping\n";
	    }
	    sleep(Yii::app()->params['mailerDaemonCheckPeriod']);
	}
	echo "stopping server \n";
    }
    
        /**
     * запуск одного подпроцесса
     * @param ApiJob $job 
     */
    private function launchJob() {
	// Создаем дочерний процесс
	// весь код после pcntl_fork() будет выполняться
	// двумя процессами: родительским и дочерним
	$pid = pcntl_fork();
	if ($pid == -1) {
	    // Не удалось создать дочерний процесс
	    error_log('Could not launch new job, exiting');
	    return FALSE;
	} elseif ($pid) {
	    // Этот код выполнится родительским процессом
	    $this->currentJobs[$pid] = TRUE;
	} else {
	    echo "Процесс $pid с ID " . getmypid() . PHP_EOL;
	    $engine = new adminMailerComponent();
	    $engine->run();
	    exit(); 
	    
	}
	return TRUE;

    }

    public function childSignalHandler($signo, $pid = null, $status = null) {
	switch ($signo) {
	    case SIGTERM:
		// При получении сигнала завершения работы устанавливаем флаг
		$this->stop_server = true;
		break;
	    case SIGCHLD:
		// При получении сигнала от дочернего процесса
		if (!$pid) {
		    $pid = pcntl_waitpid(-1, $status, WNOHANG);
		}
		// Пока есть завершенные дочерние процессы
		while ($pid > 0) {
		    if ($pid && isset($this->currentJobs[$pid])) {
			// Удаляем дочерние процессы из списка
			unset($this->currentJobs[$pid]);
		    }
		    $pid = pcntl_waitpid(-1, $status, WNOHANG);
		}
		break;
	    default:
	    // все остальные сигналы
	}
    }
    
}