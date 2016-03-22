#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$TeamName = $argv[3];

//confirms a proper First Name, Last Name, and DisplayName date paramter were passed in from the command line:  If it wasn't the program exits.


if (empty($TeamName) ==  true)
{
   echo __FILE__.":".__LINE__.": A team nickname such as Knicks, Lakers, or Pelicans must be provided to look up statistics!".PHP_EOL;
   exit(0);
}



//EVERYTHING ABOVE IW WHAT IS BEING MODIFIED!
$db = new mysqli('localhost',$dbuser,$passwd,'stats');

//escape characters to make certain parameter is secure.

$TeamName_esc = $db->escape_string($TeamName);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
$query = "select name, games, rebs, assists, points, steals, blocks from 2016_NBA_Team_Stats where name = '$TeamName_esc';";

$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// Check if query returned any rows, and exit if it did not
if ($result->num_rows == 0) {

echo __FILE__.":".__LINE__.": No records were returned! You didn't provide a valid team name. Please note input is case sensitive and examples include Pistons or Hawks !:".PHP_EOL;
   exit(0);

} else {

$row_count = $result->num_rows;
}
//display individual team statistics

for ($i = 0; $i < $row_count; $i++){
$teamStats = $result->fetch_assoc();
echo $teamStats['name'] . ' ';
echo $teamStats['games'] . ' ';
echo $teamStats['rebs'] . ' ';
echo $teamStats['assists'] . ' ';
echo $teamStats['points'] . ' ';
echo $teamStats['steals'] . ' ';
echo $teamStats['blocks'] . "\n";

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
