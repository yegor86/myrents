class yii {
	
	puppi::netinstall { "yii.framework":
  		url => "http://yii.googlecode.com/files/yii-1.1.12.b600af.tar.gz",
		extracted_dir => "yii-1.1.12.b600af",
		destination_dir => "/tmp",
	}
	file {
                "/srv/www/framework":
                ensure => "directory",
		recurse => "true",
		force => "true",
		purge => "true",
		source => "/tmp/yii-1.1.12.b600af/framework",
		require => Puppi::Netinstall["yii.framework"],
        }
}

