#!/bin/sh

gamedate=$1
winningteam=$2
winningteamscore=$3
losingteam=$4
losingteamscore=$5
comments=$6

realgamedate='"'$gamedate'"'
realwinningteam='"'$winningteam'"'
realwinningteamscore='"'$winningteamscore'"'
reallosingteam='"'$losingteam'"'
reallosingteamscore='"'$losingteamscore'"'
realcomments='"'$comments'"'

echo $realgamedate
echo $realwinningteam
echo $realwinningteamscore
echo $reallosingteam
echo $reallosingteamscore
echo $realcomments

directory=/home/it-635/mongodb-linux-i686-3.2.6/bin
$directory/mongo ds013172.mlab.com:13172/mongo_stats -u stats_modify -p letsgomets --eval 'db.Game_Breakdown_2016.insert({"GameDate": "2/28/2016","WinningTeam": "Mavericks","WinningTeamScore": "100","LosingTeam": "Warriors","LosingTeamScore": "17","GameComments": "Warriors inefficient Without Curry"})'
