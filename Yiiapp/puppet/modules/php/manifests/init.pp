class php {
	package { "php5":
   		ensure => "installed",
	}
	package { "php5-memcached":
                ensure => "installed",
		require => Package["php5"],
        }
	package { "php5-curl":
                ensure => "installed",
		require => Package["php5"],
        }
	package { "php5-gd":
                ensure => "installed",
		require => Package["php5"],
        }
	package { "php5-gmp":
                ensure => "installed",
                require => Package["php5"],
        }
	package { "php-pear":
                ensure => "installed",
                require => Package["php5"],
        }
	package { "libapache2-mod-php5":
                ensure => "installed",
		require => Package["php5"],
        }
	
	file {
                "/etc/php5/apache2/php.ini.old":
                ensure => present,
                source => "/etc/php5/apache2/php.ini",
                replace => "no",
        }

	file {
                "/etc/php5/apache2/php.ini":
                ensure => file,
                source => "puppet:///modules/php/php.ini",
                require => File["/etc/php5/apache2/php.ini.old"],
        }	
#	pear::package { "Text_LanguageDetect":
#		version => "0.3.0",
#		repository => "pear.php.net",
#		require => Package["php-pear"],
#	}
}

