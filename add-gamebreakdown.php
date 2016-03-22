#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$gamedate = $argv[3];
$winningteam = $argv[4];
$winningteamscore = $argv[5];
$losingteam = $argv[6];
$losingteamscore = $argv[7];
$comments = $argv[8];


//confirms a proper PlayerName paramter were passed in from the command line:  If it wasn't the program exits.


if (empty($gamedate)  || empty($winningteam) || empty($winningteamscore) || empty($losingteam) || empty($losingteamscore))
{
   echo __FILE__.":".__LINE__.": A key value to insert a complete game breakdown is missing!".PHP_EOL;
   exit(0);
}
//Confirms that scores passed in are valid numeric entries

if (!is_numeric($winningteamscore)  || !is_numeric($losingteamscore))
{
   echo __FILE__.":".__LINE__.": A valid team score must be provided to enter a game breakdown! re: $winningteamscore $losingteamscore".PHP_EOL;
   exit(0);
}
//Makes certain the winning team had a higher score!
if ($winningteamscore <= $losingteamscore)
{
   echo __FILE__.":".__LINE__.": The winning team score must be higher than the loser! re: $winningteamscore $losingteamscore".PHP_EOL;
   exit(0);
}


//Confirms that a valid date format has been passed to the program, if not it exits.  If so assigns date to date1 variable!!

if (date_create($gamedate)== false)
{
   echo __FILE__.":".__LINE__.": Please provide a proper game date so breakdown can be entered!, re: $gamedate".PHP_EOL;
   exit(0);
} else {
   $date1=date_create($gamedate);
}

$date2=date_format($date1,"Y-m-d");


//Good to this point

$db = new mysqli('localhost', $dbuser, $passwd,'stats');

//escape characters to make certain parameter is secure.

//$PlayerName_esc = $db->escape_string($PlayerName);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
// CONFIRMING  legitimate team names were passed in to the program

$query = "select * from team where name in ('$winningteam', '$losingteam');";
$result=$db->query($query);
if ($result==false) {
$error_message=$db->error;
echo "<p>An error occurred: $error_message</p>";
exit();
}
$row_count = $result->num_rows;

if ($row_count < 2) {
   echo __FILE__.":".__LINE__.": Appropriate Winning and Losing team nick names must be provided to enter a game breakdown. Examples are Knicks and Nets! re: $winningteam $losingteam".PHP_EOL;
   exit(0);
}

//Insert gamebreak table!


 $query = "insert 2016_Game_Breakdown (GameDate, WinningTeam, WinningTeamScore, LosingTeam, LosingTeamSCore, GameComments) values ('$gamedate', '$winningteam', '$winningteamscore', '$losingteam', '$losingteamscore', '$comments');";
 $success = $db->query($query);
 if ($success) {
 //$count = $db->affected_rows;
 echo __FILE__.":".__LINE__.":A game breakdown has been inserted!:$gamedate $winningteamscore $losingteamscore".PHP_EOL;}
 else {
 $error_message = $db->error;
           echo "<p>An error occurred during database insert: $error_message</p>";
}

//Update logic for Assists!
/*
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
*/
?>
