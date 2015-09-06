class mount {
	
	mount { "/srv/www/api/nfs":
		device  => "myrents.com.ua:/srv/www/myrents/uploads",
		fstype  => "nfs",
		ensure  => "mounted",
		options => "rw,hard,intr",
		atboot  => true,
    }
}

