class mysql {
	package { "mysql-server":
   		ensure => "installed",
		require => Class["php"],
	}
	package { "mysql-client":
                ensure => "installed",
        }
	package { "libapache2-mod-auth-mysql":
                ensure => "installed",
                require => Package["mysql-server"],
        }
	package { "php5-mysql":
                ensure => "installed",
                require => Package["mysql-server"],
        }

	$password = "Geronimo123"
	exec { "Set MySQL server root password":
    		subscribe => [ Package["mysql-server"], Package["mysql-client"] ],
#		refreshonly => true,
		unless => "mysqladmin -uroot -p$password status",
		path => "/bin:/usr/bin",
		command => "mysqladmin -uroot password $password",
  	}  
}

