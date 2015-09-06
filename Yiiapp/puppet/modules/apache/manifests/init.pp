class apache {
	
	file {
                "/etc/apache2/ports.conf.old":
                ensure => present,
                source => "/etc/apache2/ports.conf",
                replace => "no",
        }

	file {
                "/etc/apache2/ports.conf":
                ensure => file,
                source => "puppet:///modules/apache/ports.conf",
                require => File["/etc/nginx/nginx.conf.old"],
        }

        file {
                "/etc/apache2/sites-available":
                ensure => present,
		owner => "root",
		group => "root",
		mode => 0644,
                source => "puppet:///modules/apache/sites-available",
                require => File["/etc/apache2/ports.conf.old"],
        }

	file {
                "/etc/apache2/sites-enabled/myrents.com.ua":
                ensure => link,
                target => "/etc/apache2/sites-available/myrents.com.ua",
                require => File["/etc/apache2/sites-available"],
        }

	file {
                "/etc/apache2/sites-enabled/postadmin":
                ensure => link,
                target => "/etc/apache2/sites-available/postadmin",
                require => File["/etc/apache2/sites-available"],
        }

	file {
                "/etc/apache2/sites-enabled/roundcube":
                ensure => link,
                target => "/etc/apache2/sites-available/roundcube",
                require => File["/etc/apache2/sites-available"],
        }

	package { "apache2":
   		ensure => "installed"
	}

	exec { "a2enmod_php":
                command => "/usr/sbin/a2enmod php5",
                require => Package["libapache2-mod-php5"],
        }
        exec { "a2enmod_rewrite":
                command => "/usr/sbin/a2enmod rewrite",
                require => Package["apache2"],
        }
	exec { "a2ensite-myrents":
                command => "/usr/sbin/a2ensite myrents.com.ua",
                require => File["/etc/apache2/sites-enabled/myrents.com.ua"],
        }
	exec { "a2ensite-postadmin":
                command => "/usr/sbin/a2ensite postadmin",
                require => File["/etc/apache2/sites-enabled/postadmin"],
        }
	exec { "a2ensite-roundcube":
                command => "/usr/sbin/a2ensite myrents.com.ua",
                require => File["/etc/apache2/sites-enabled/roundcube"],
        }
        # define the service to restart
        service { "apache2":
                ensure  => "running",
                enable  => "true",
                require => [ Exec["a2enmod_php"], Exec["a2enmod_rewrite"], Exec["a2ensite-myrents"], Exec["a2ensite-postadmin"], Exec["a2ensite-roundcube"] ],
        }
}

