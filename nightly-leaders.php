#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$dateOfLookup = $argv[3];


//confirms a date paramter was passed in from the command line.  If it wasn't the program exits.


if (empty($dateOfLookup) ==  true)
{
   echo __FILE__.":".__LINE__.": A valid date parameter must be passed in for program to execute!".PHP_EOL;
   exit(0);
}



//Confirms that a valid date format has been passed to the program, if not it exits.  If so assigns date to date1 variable!!

if (date_create($dateOfLookup)== false)
{
   echo __FILE__.":".__LINE__.": Please provide a proper game date so leaders can be displayed!, re: $dateOfLookup".PHP_EOL;
   exit(0);
} else {
   $date1=date_create($dateOfLookup);
}

$date2=date_format($date1,"Y-m-d");
//echo $date2 . " ";


$db = new mysqli('localhost',$dbuser,$passwd,'stats');

//make certain the parameter has been scrubbed for security purposes

//$dateOfLookup_esc=$db->escape_string($dateOfLookup);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
$query = "select a.Rank,a.EventDate, c.displayname, a.StatType,a.Points
from nightlyleaders a
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid
where a.leagueid ='00' and a.statType='points'
and a.eventDate = '$date2'
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10;";

$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// If no records are returned from the query then another night where NBA games were played needs to be entered

if ($result->num_rows ==  0)
{
    echo __FILE__.":".__LINE__.": Unfortunately there were no NBA Games played on this night, please select another date!".PHP_EOL;
    exit(0);
}

// store number of rows in result set

$row_count = $result->num_rows;

//display points scoring leader for that night

for ($i = 0; $i < $row_count; $i++){
$pointLeaders = $result->fetch_assoc();
echo $pointLeaders['Rank'] . ' ';
echo $pointLeaders['EventDate'] . ' ';
echo $pointLeaders['displayname'] . ' ';
echo $pointLeaders['StatType'] . ' ';
echo $pointLeaders['Points'] . "\n";

}
//END OF POINTS LOGIC AND BEGINNING OF BLOCKS LOGIC

$query = "select a.Rank, a.EventDate, c.displayname, a.StatType,a.blocks
from nightlyleaders a
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid
where a.leagueid ='00' and a.statType='blocks'
and a.eventDate = '$date2'
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10;";

$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// store number of rows in result set

$row_count = $result->num_rows;

//display blocked shot leader for that night

for ($i = 0; $i < $row_count; $i++){
$blockLeaders = $result->fetch_assoc();
echo $blockLeaders['Rank'] . ' ';
echo $blockLeaders['EventDate'] . ' ';
echo $blockLeaders['displayname'] . ' ';
echo $blockLeaders['StatType'] . ' ';
echo $blockLeaders['blocks'] . "\n";

}
//END OF BLOCKS LOGIC AND BEGINNING OF ASSISTS

$query = "select a.Rank, a.EventDate, c.displayname, a.StatType,a.assists
from nightlyleaders a
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid
where a.leagueid ='00' and a.statType='assists'
and a.eventDate = '$date2'
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10
;";

$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// store number of rows in result set

$row_count = $result->num_rows;

//display points scoring leader for that night

for ($i = 0; $i < $row_count; $i++){
$pointLeaders = $result->fetch_assoc();
echo $pointLeaders['Rank'] . ' ';
echo $pointLeaders['EventDate'] . ' ';
echo $pointLeaders['displayname'] . ' ';
echo $pointLeaders['StatType'] . ' ';
echo $pointLeaders['assists'] . "\n";
}

//END OF ASSISTS LOGIC AND BEGINNING OF REBOUNDS LOGIC

$query = "select a.Rank, a.EventDate, c.displayname, a.StatType,a.rebs 
from nightlyleaders a
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid
where a.leagueid ='00' and a.statType='rebounds'
and a.eventDate = '$date2'
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10
;";

$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// store number of rows in result set

$row_count = $result->num_rows;

//display rebounds leader for that night

for ($i = 0; $i < $row_count; $i++){
$reboundLeaders = $result->fetch_assoc();
echo $reboundLeaders['Rank'] . ' ';
echo $reboundLeaders['EventDate'] . ' ';
echo $reboundLeaders['displayname'] . ' ';
echo $reboundLeaders['StatType'] . ' ';
echo $reboundLeaders['rebs'] . "\n";

}

//END OF REBOUNDS LOGIC AND BEGINNING OF STEALS LOGIC 

$query = "select a.Rank, a.EventDate, c.displayname, a.StatType,a.steals
from nightlyleaders a
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid
where a.leagueid ='00' and a.statType='steals'
and a.eventDate = '$date2'
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10
;";

$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// store number of rows in result set

$row_count = $result->num_rows;

//display points scoring leader for that night

for ($i = 0; $i < $row_count; $i++){
$stealsLeaders = $result->fetch_assoc();
echo $stealsLeaders['Rank'] . ' ';
echo $stealsLeaders['EventDate'] . ' ';
echo $stealsLeaders['displayname'] . ' ';
echo $stealsLeaders['StatType'] . ' ';
echo $stealsLeaders['steals'] . "\n";
}
//Close the database connection
$result->free();
$db->close();
?> 
