class mr_cron {
  
  cron{ sphinx-indexer-all:
        ensure => present,
        command => "/usr/local/bin/indexer --all --rotate",
		user => "root",
		hour => "2",
		minute => "17"
  }
  cron{ sphinx-indexer-rents:
        ensure => present,
        command => "/usr/local/bin/indexer rents --rotate",
        user => "root",
        hour => "*",
		minute => "0"
  }
  cron{ sphinx-indexer-delta:
        ensure => present,
        command => "/usr/local/bin/indexer delta --rotate && /usr/local/bin/indexer --merge rents delta --rotate",
        user => "root",
		hour => "*",
        minute => "*/5"
  }
  cron{ getCurrency:
        ensure => present,
        command => "php /srv/www/myrents/protected/cron.php getcurrency",
        user => "root",
        hour => "00",
        minute => "00"
  }
  cron{ topSwitcher:
        ensure => present,
        command => "php /srv/www/myrents/protected/cron.php topswitcher",
        user => "root",
        hour => "*",
        minute => "*/1"
  }
  cron{ dbBackup:
        ensure => present,
		command => "sh /srv/www/myrents/scripts/backup_local_bases.sh && rsync -avz /home/backup/mysql/ myrents@dev.myrents.com.ua:~/db_backup |  mail -s "db_backup_copy" admin@myrents.com.ua",
        user => "root",
        hour => "3",
        minute => "32"
  }
  cron{ fsBackup:
        ensure => present,
        command => "rsync -avz /srv/www/myrents/uploads/ myrents@dev.myrents.com.ua:~/uploads | mail -s 'Images Backup' admin@myrents.com.ua",
        user => "root",
        hour => "3",
        minute => "47"
  }
}

