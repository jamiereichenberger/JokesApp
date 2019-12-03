<?php
include "db_connect.php";
$keywordfromform = $_GET['keyword'];
echo "<h1>Looking for jokes that only have the word <em>$keywordfromform</em> in the question<br></h1>";
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo "<h2> Show all jokes with the word $keyword </h2>";
// check if there are any values in the table, and then display one at a time
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "<br>";

echo "<h2>Show all jokes with the word " . $keywordfromform . "</h2>";

$sql = "SELECT JokeID, Joke_question, Joke_answer, users_id, username FROM jokes JOIN users ON users.id = jokes.users_id WHERE Joke_question LIKE '%$keywordfromform'%";
$result = $mysqli->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row['JokeID']. " - Joke Question: " . $row['Joke_question']. " " . $row['Joke_answer']. "  submitted by user  " . $row['google_name'] . "<br>";
    }
} else {
    echo "0 results";
}

?>