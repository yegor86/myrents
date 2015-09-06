# MySQLBackup By Matt Moeller 
# RED OLIVE DESIGN INC.
# SET backupdate=date:~0,2%-date:~3,2%-date:~6,4% date:~0,2%-date:~3,2%
#
# MySQl DB user
#set dbuser=yii
#
# MySQl DB users password
#set dbpass=yiipass
#
#set dbname=myrentsdb
#
mysqldump --user=yii --password=yiipass myrentsdb | gzip -c > myrentsdb-dump.sql.gz
echo "All done, pretty slick eh"
