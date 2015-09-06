<?php

/*
 * Таймер, для просмотра времени выполнения различных функций
 */

class CustomTimer {

    private $starttime;

    public function __construct() {
        $this->starttime = 0;
        $this->startTimer();
    }

    public function startTimer() {
        //замер скорости поиска
        $mtime = microtime();
        //Разделяем секунды и миллисекунды
        $mtime = explode(" ", $mtime);
        //Составляем одно число из секунд и миллисекунд
        $mtime = $mtime[1] + $mtime[0];
        //Записываем стартовое время в переменную
        $this->starttime = $mtime;
    }

    public function getTime() {
        $mtime = microtime();
        $mtime = explode(" ", $mtime);
        $mtime = $mtime[1] + $mtime[0];
        //Вычисляем разницу
        $totaltime = ($mtime - $this->starttime);
        return $totaltime;
    }

}

?>
