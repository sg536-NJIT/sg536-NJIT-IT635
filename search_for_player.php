#!/usr/bin/php
<?php
$dbuser = $argv[1];
$passwd = $argv[2];
$PlayerLookup = $argv[3];


//confirms a proper player name was passed in from the command line:  If it wasn't the program exits.


if (empty($PlayerLookup) ==  true)
{
   echo __FILE__.":".__LINE__.": No records were returned! You didn't provide a current NBA player name. Please note input is case sensitive and examples include Carmelo Anthony, Kobe Bryant, and Kristaps Porzingis. Please note Partial names are accepted if the case sensitivity is correct!.".PHP_EOL;
   exit(0);
}

//Prepare variable to be passed into like clause for partial name parameters

$PlayerLookup_concat = "%" . $PlayerLookup . "%";
$PlayerLookup_concat_final  = $PlayerLookup_concat;


$db = new mysqli('localhost',$dbuser, $passwd,'stats');

//escape characters to make certain parameter is secure.

$PlayerLookup_concat_final_esc = $db->escape_string($PlayerLookup_concat_final);

//make certain you can connect to the database cleanly

if ($db->connect_errno !=  null)
{
   echo __FILE__.":".__LINE__.": failed to connect to db, re: $db->connect_error".PHP_EOL;
   exit(0);
}
$query = "select displayname, school, birthdate, teamname from 2016_NBA_Player where displayname like '$PlayerLookup_concat_final_esc';";

$result = $db->query($query);

//check the result set to make certain the query data was provided cleanly

if ($result == false) {
$error_message = $db->error;
echo "<p>An error occurred: $error_message<\p>";
exit();
}

// Check if query returned any rows, and exit if it did not
if ($result->num_rows == 0) {

echo __FILE__.":".__LINE__.": No records were returned! You didn't provide a current NBA player name. Please note input is case sensitive and examples include Carmelo Anthony, Kobe Bryant, and Kristaps Porzingis. Please note Partial names are accepted if the case sensitivity is correct!:".PHP_EOL;
   exit(0);

} else {

$row_count = $result->num_rows;
}
//display individual team information

for ($i = 0; $i < $row_count; $i++){
$PlayerDetails = $result->fetch_assoc();
echo $PlayerDetails['displayname'] . ' ';
echo $PlayerDetails['school'] . ' ';
echo $PlayerDetails['birthdate'] . ' ';
echo $PlayerDetails['teamname'] . "\n";

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
