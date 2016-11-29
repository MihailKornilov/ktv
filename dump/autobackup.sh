#!/bin/sh

NAME=`date "+ktv_%Y-%m-%d_%H-%M_auto.sql"`

/usr/local/bin/mysqldump --password=ytepyfdftvsq -u root ktv > /home/www/ktv/dump/backup/${NAME}
