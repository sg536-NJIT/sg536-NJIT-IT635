#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$PlayerName = $argv[3];


//confirms a proper First Name, Last Name, and DisplayName paramter were passed in from the command line:  If it wasn't the program exits.


if (empty($PlayerName) ==  true)
{
   echo __FILE__.":".__LINE__.": A player name must be provided to view statistics! Please note the names are case sensitve and examples are Carmelo Anthony, and Kobe Bryant. Partial, first, and last names are acccepted as long as case sensitivity is correct.".PHP_EOL;
   exit(0);
}

//Prepare variable to be passed into like clause for partial name parameters

$PlayerName_concat = "%" . $PlayerName . "%";
$PlayerName_concat_final  = $PlayerName_concat;


$db = new mysqli('localhost',$dbuser,$passwd,'stats');

//escape characters to make certain parameter is secure.

$PlayerName_concat_final_esc = $db->escape_string($PlayerName_concat_final);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
$query = "select displayname, teamname, assists, points, steals, blocks from 2016_NBA_Player_Stats where displayname like '$PlayerName_concat_final_esc';";

$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// Check if query returned any rows, and exit if it did not
if ($result->num_rows == 0) {

echo __FILE__.":".__LINE__.": No records were returned! You didn't provide a current NBA player name. Please note input is case sensitive and examples include Carmelo Anthony and Kobe Bryant! Partial, First, and Last names are all accepted if the case sensitivity is correct !:".PHP_EOL;
   exit(0);

} else {

$row_count = $result->num_rows;
}
//display individual team statistics

for ($i = 0; $i < $row_count; $i++){
$PlayerStats = $result->fetch_assoc();
echo $PlayerStats['displayname'] . ' ';
echo $PlayerStats['teamname'] . ' ';
echo $PlayerStats['assists'] . ' ';
echo $PlayerStats['points'] . ' ';
echo $PlayerStats['steals'] . ' ';
echo $PlayerStats['blocks'] . "\n";

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
