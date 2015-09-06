<VirtualHost *:91>
	ServerName myrents.com.ua
	ServerAlias www.myrents.com.ua api.myrents.com.ua
	ServerAdmin webmaster@myrents.com.ua

	DocumentRoot /srv/www/myrents/
	<Directory /srv/www/myrents/>
		Options Indexes FollowSymLinks
		AllowOverride All
		Order allow,deny
		allow from all
	</Directory>


	ErrorLog ${APACHE_LOG_DIR}/myrents-error.log

	# Possible values include: debug, info, notice, warn, error, crit,
	# alert, emerg.
	LogLevel warn

	CustomLog ${APACHE_LOG_DIR}/myrents-access.log combined

</VirtualHost>
