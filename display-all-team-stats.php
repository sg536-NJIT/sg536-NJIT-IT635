#!/usr/bin/php
<?php


$db = new mysqli('localhost','root','letsgomets','stats');

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
$query = "SELECT b.name, a.games, a.FGPct, a.FTPct, a.RebsPG, a.PointsPG 
        FROM teamstats a inner join team b  on a.teamid=b.teamid and a.leagueid=b.leagueid and a.season=b.season  
        where a.leagueid='00'      
         and a.season=2015     
         and a.seasonType=2       
         and a.isopponent =0    
         and b.abbr not in ('WST', 'EST')
         and b.name != 'World'
        order by a.pointsPg desc;";
$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// store number of rows in result set

$row_count = $result->num_rows;

//display all team statistics in order by PPG

for ($i = 0; $i < $row_count; $i++){
$leagueStats = $result->fetch_assoc();
echo $leagueStats['name'] . ' ';
echo $leagueStats['games'] . ' ';
echo $leagueStats['FGPct'] . ' ';
echo $leagueStats['FTPct'] . ' ';
echo $leagueStats['RebsPG'] . ' ';
echo $leagueStats['PointsPG'] . "\n";

}

//$row_count = $result->num_rows;
//echo $row_count;

/*$query = "call addTeacher(@teacherID,'$teacherName',$teacherRating,'$teacherTitle');";

echo "running query:\n$query".PHP_EOL;

$response = $db->query($query);

$response = $db->query("select @teacherID");
if (!$response)
{
   echo "Error from mysql: ". $db->error.PHP_EOL;
   exit();
}
$results = $response->fetch_assoc();
echo "select results: ".PHP_EOL;
foreach ($results as $row)
{
    print_r($row);
    echo PHP_EOL;
}

?> */
