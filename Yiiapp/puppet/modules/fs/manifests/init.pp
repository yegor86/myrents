class fs {

	file { "/srv/www/api/assets":
    		ensure => "directory",
		recurse => true,
		owner  => "www-data",
		group => "www-data",
		mode   => 664,
	}
	file { "/srv/www/api/log":
                ensure => "directory",
		recurse => true,
                owner  => "www-data",
                group => "www-data",
                mode   => 664,
        }
	file { "/srv/www/api/protected/runtime":
                ensure => "directory",
		recurse => true,
                owner  => "www-data",
                group => "www-data",
                mode   => 664,
        }
	file { "/srv/www/api/uploads":
                ensure => "directory",
		recurse => true,
                owner  => "www-data",
                group => "www-data",
                mode   => 664,
        }
	file { "/srv/www/api/nfs":
                ensure => "directory",
		recurse => true,
                owner  => "www-data",
                group => "www-data",
                mode   => 664,
        }
	file { "/srv/www/api/scripts/apid":
                owner  => "root",
                mode   => 774,
        }
	file { "/etc/init.d/apid":
   		ensure => "link",
		target => "/srv/www/api/scripts/apid",
	}
}

