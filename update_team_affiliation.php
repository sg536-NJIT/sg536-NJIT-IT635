#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$TeamName = $argv[3];
$CityName = $argv[4];
$ArenaName= $argv[5];


//confirms a proper TeamName paramter was passed in from the command line:  If it wasn't the program exits.


if (empty($TeamName) || is_numeric($TeamName))
{
   echo __FILE__.":".__LINE__.": A current NBA team name must be provided to make a modification. Please note the names are case sensitive and examples are Knicks, Rockets, and Cavaliers.".PHP_EOL;
   exit(0);
}


if (empty($CityName))
{
   echo __FILE__.":".__LINE__.": A new City and Arena name must be provided to update the affiliation.".PHP_EOL;
   exit(0);
}

if (empty($ArenaName))
{
   echo __FILE__.":".__LINE__.": A new City and Arena must be provided to update the affiliation.".PHP_EOL;
   exit(0);
}




$db = new mysqli('localhost',$dbuser,$passwd,'stats');

//escape characters to make certain parameter is secure.

//$PlayerName_esc = $db->escape_string($PlayerName);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
// CONFIRMING a legitimate NBA nickname was passed to the program

$query = "select * from team where Name = '$TeamName';";
$result=$db->query($query);
if ($result==false) {
$error_message=$db->error;
echo "<p>An error occurred: $error_message</p>";
exit();
}
$row_count = $result->num_rows;

if ($row_count == 0) {
   echo __FILE__.":".__LINE__.": An appropriate NBA team nickname must be provided to update their affiliation! Please note the names are case sensitive and examples are Bucks, Nets, and Heat.".PHP_EOL;
   exit(0);
}


//Update Logic to Change Affiliations!
if (isset($CityName) && isset($ArenaName))
{ echo $CityName;
      $query = "update team set city = '$CityName', ArenaName= '$ArenaName' where Name = '$TeamName';";
      $success = $db->query($query);
           if ($success) {
           //$count = $db->affected_rows;
           echo __FILE__.":".__LINE__.":Team Affiliation has been updated!: $TeamName $CityName $ArenaName".PHP_EOL;}
           else {
           $error_message = $db->error;
           echo "<p>An error occurred during database updated: $error_message</p>";

}} else {
echo __FILE__.":".__LINE__.":Affiliation not updated due to inappropriate or null value provided!".PHP_EOL;
}
?>
