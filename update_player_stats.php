#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$PlayerName = $argv[3];
$Points = $argv[4];
$Assists= $argv[5];
$Rebounds = $argv[6];
$Steals = $argv[7];


//confirms a proper PlayerName paramter were passed in from the command line:  If it wasn't the program exits.


if (empty($PlayerName)  || is_numeric($PlayerName))
{
   echo __FILE__.":".__LINE__.": A player name must be provided to update statistics! Please note the names are case sensitive and examples are Carmelo Anthony, and Kobe Bryant. Names must be an exact match to make certain the correct player's stats are updated!".PHP_EOL;
   exit(0);
}


$db = new mysqli('localhost', $dbuser, $passwd,'stats');

//escape characters to make certain parameter is secure.

$PlayerName_esc = $db->escape_string($PlayerName);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
// CONFIRMING a legitimate player name was passed to the program

$query = "select * from 2016_NBA_Player_Stats where displayname = '$PlayerName_esc';";
$result=$db->query($query);
if ($result==false) {
$error_message=$db->error;
echo "<p>An error occurred: $error_message</p>";
exit();
}
$row_count = $result->num_rows;

if ($row_count == 0) {
   echo __FILE__.":".__LINE__.": An appropriate player name must be provided to update statistics! Please note the names are case sensitive and examples are Carmelo Anthony, and Kobe Bryant. Names must be an exact match to make certain the correct player's stats are updated!".PHP_EOL;
   exit(0);
}

//Update Logic for Points!

if (isset($Points) && is_numeric($Points))
{
      $query = "update 2016_NBA_Player_Stats set points = '$Points' where displayname = '$PlayerName_esc';";
      $success = $db->query($query);
           if ($success) {
           //$count = $db->affected_rows;
           echo __FILE__.":".__LINE__.":A statistic has been updated!: $Points".PHP_EOL;}
           else {
           $error_message = $db->error;
           echo "<p>An error occurred during database insert: $error_message</p>";

}} else {
echo __FILE__.":".__LINE__.":Statistic not updated due to inappropriate or null value provided!: $Points".PHP_EOL;
}

//Update logic for Assists!

if (isset($Assists) && is_numeric($Assists))
{
      $query = "update 2016_NBA_Player_Stats set assists = '$Assists' where displayname = '$PlayerName_esc';";
      $success = $db->query($query);
           if ($success) {
           //$count = $db->affected_rows;
           echo __FILE__.":".__LINE__.":A statistic has been updated!: $Assists".PHP_EOL;}
           else {
           $error_message = $db->error;
           echo "<p>An error occurred during database insert: $error_message</p>";

}} else {
echo __FILE__.":".__LINE__.":Statistic not updated due to inappropriate or null value provided!: $Assists".PHP_EOL;
}

//Update logic for Rebounds!

if (isset($Rebounds) && is_numeric($Rebounds))
{
      $query = "update 2016_NBA_Player_Stats set rebs = '$Rebounds' where displayname = '$PlayerName_esc';";
      $success = $db->query($query);
           if ($success) {
           //$count = $db->affected_rows;
           echo __FILE__.":".__LINE__.":A statistic has been updated!: $Rebounds".PHP_EOL;}
           else {
           $error_message = $db->error;
           echo "<p>An error occurred during database insert: $error_message</p>";

}} else {
echo __FILE__.":".__LINE__.":Statistic not updated due to inappropriate or null value provided!: $Rebounds".PHP_EOL;
}

// Update logic for Steals

if (isset($Steals) && is_numeric($Steals))
{
      $query = "update 2016_NBA_Player_Stats set steals = '$Steals' where displayname = '$PlayerName_esc';";
      $success = $db->query($query);
           if ($success) {
           //$count = $db->affected_rows;
           echo __FILE__.":".__LINE__.":A statistic has been updated!: $Steals".PHP_EOL;}
           else {
           $error_message = $db->error;
           echo "<p>An error occurred during database insert: $error_message</p>";

}} else {
echo __FILE__.":".__LINE__.":Statistic not updated due to inappropriate or null value provided!: $Steals".PHP_EOL;
}
?>
