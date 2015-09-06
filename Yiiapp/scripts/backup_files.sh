#!/bin/bash

#время хранения (10 дней)
STORE_DATE=10
BASEDIR="/mnt/backup/uploads/"
SRCDIR="/srv/www/myrents/uploads/"

#удаление файлов и каталогов, старше указанного времени хранения
find  /mnt/backup/db/mysql/ -mtime +$STORE_DATE -exec rm {} \;
find  $BASEDIR -type d -mtime +$STORE_DATE  -exec rm -rf {} \;

#название будущей папки
NOW="$(date +"%Y-%m-%d")"
CURDIR=$BASEDIR$NOW
mkdir $CURDIR
cp -Ru $SRCDIR $CURDIR


