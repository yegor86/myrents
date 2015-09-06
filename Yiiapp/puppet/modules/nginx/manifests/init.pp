class nginx {

	file {
                "/etc/nginx/nginx.conf.old":
                ensure => present,
                source => "/etc/nginx/nginx.conf",
		replace => "no",
        }

	file {
    		"/etc/nginx/nginx.conf":
	  	ensure => file,
		source => "puppet:///modules/nginx/nginx.conf",
		require => File["/etc/nginx/nginx.conf.old"],
	}

  	package { "nginx":
		ensure => installed,
	} 
}

