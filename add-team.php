#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$TeamName = $argv[3];
$CityName = $argv[4];
$ArenaName = $argv[5];

//confirms a proper Team Name, City Name, and Arena Name were passed in from the command line:  If it wasn't the program exits.


if (empty($TeamName) ==  true || empty($CityName)== true || empty($ArenaName) == true)
{
   echo __FILE__.":".__LINE__.": A Team Nickname, Home city, and Arena must ALL be provided to add a new team!".PHP_EOL;
   exit(0);
}


$db = new mysqli('localhost', $dbuser, $passwd, 'stats');

//make certain the parameters have been scrubbed for security purposes

$TeamName_esc = $db->escape_string($TeamName);
$LastName_esc = $db->escape_string($CityName);
$ArenaName_esc = $db->escape_string($ArenaName);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
$query = "insert team (Name, City, Arenaname)
values ('$TeamName', '$CityName', '$ArenaName')
;";

$success = $db->query($query);

//Make certain the insert statement completed successfully

if ($success != 0) {
   $count = $db->affected_rows;
   echo "<p>$count new team was added!: $TeamName_esc</p>";
}  else {
   $error_message = $db->error;
   echo "<p>An error occurred during database insert: $error_message</p>";
}
   
//Close the database connection
//$success->free();
$db->close();
?> 
