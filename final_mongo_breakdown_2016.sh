#!/bin/sh

directory=/home/it-635/mongodb-linux-i686-3.2.6/bin

dbuser=$1
password=$2


$directory/mongo ds013172.mlab.com:13172/mongo_stats -u $dbuser -p $password --eval 'db.Game_Breakdown_2016.find().pretty()'

