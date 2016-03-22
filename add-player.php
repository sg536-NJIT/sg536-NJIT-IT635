#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$displayname = $argv[3];

//confirms a proper First Name, Last Name, and DisplayName date paramter were passed in from the command line:  If it wasn't the program exits.


if (empty($displayname) ==  true)
{
   echo __FILE__.":".__LINE__.": A player Name must be provided to add a player!".PHP_EOL;
   exit(0);
}


$db = new mysqli('localhost',$dbuser,$passwd,'stats');

//make certain the parameters have been scrubbed for security purposes

$displayname_esc = $db->escape_string($displayname);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
$query = "insert 2016_NBA_Player (displayname)
values ('$displayname_esc')
;";

$success = $db->query($query);

//Make certain the insert statement completed successfully

if ($success != 0) {
   $count = $db->affected_rows;
   echo "<p>$count player was added!: $displayname_esc</p>";
}  else {
   $error_message = $db->error;
   echo "<p>An error occurred during database insert: $error_message</p>";
}
   
//Close the database connection
$db->close();
?> 
