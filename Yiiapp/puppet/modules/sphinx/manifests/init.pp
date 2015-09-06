class sphinx {

	$dependencies = [ "libpq5" ]
	package { $dependencies: ensure => "installed" }	

	file { "/tmp/myrents-debs":
   		ensure => directory
  	}

	file {
		"/etc/sphinxsearch/sphinx.conf.old":
		ensure => present,
		source => "/etc/sphinxsearch/sphinx.conf",
		replace => "no",
	}

	file {
		"/etc/sphinxsearch/sphinx.conf":
		ensure => file,
		source => "puppet:///modules/sphinx/sphinx.conf",
		require => File["/etc/sphinxsearch/sphinx.conf.old"],
	}
	
	file {
		"/usr/local/etc/sphinxsearch/address_wordforms.txt":
		ensure => file,
		source => "puppet:///modules/sphinx/address_wordforms.txt",
	}
	
	file {
		"/usr/local/etc/sphinxsearch/rents_wordforms.txt":
		ensure => file,
		source => "puppet:///modules/sphinx/rents_wordforms.txt",
	}
	
	file {
		"/usr/local/etc/sphinxsearch/delta_wordforms.txt":
		ensure => file,
		source => "puppet:///modules/sphinx/delta_wordforms.txt",
	}

	wget::fetch {
		"sphinx.deb":
  		source => "http://sphinxsearch.com/files/sphinxsearch_2.0.5-release-0ubuntu11~precise2_amd64.deb",
		destination => "/tmp/myrents-debs/sphinx.deb",
	}

  	package { "sphinx":
    	provider => dpkg,
		ensure => installed,
		source => "/tmp/myrents-debs/sphinx.deb",
		require => Package["libpq5"],
	} 
}

