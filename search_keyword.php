<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Accordion - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>
</head>


<?php

include "db_connect.php";
$keyword = $_GET['keyword'];
$keyword = "%" . $keyword . "%";
echo "<h1>Looking for jokes that only have the word <em>$keyword</em> in the question<br></h1>";
/*if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} */
echo "<h2> Show all jokes with the word $keyword </h2>";

$stnt = mysqli->prepare("SELECT JokeID, Joke_question, Joke_answer, users_id, username FROM jokes JOIN users ON users.id = jokes.users_ID WHERE Joke_question LIKE ?");
$stnt->blind_param("s", $keyword);
$stnt->execute();
$stnt->bind_result($JokeID, $Joke_question, $Joke_answer, $userid, $username);

/* $sql = "SELECT JokeID, Joke_question, Joke_answer, users_id, username FROM jokes JOIN users ON users.id = jokes.users_ID WHERE Joke_question LIKE '%" . $keyword . "%'"; */
//$result = $mysqli->query($sql);
//echo "Select returned $result->num_rows rows of data<br>";


if ($stnt->num_rows > 0) {
     //output data of each row
	
?> 
<div id="accordion">

<?php 
    while($stnt->fetch()) {
			$safe_joke_question = htmlspecialchars($Joke_question);
		$safe_joke_answer = htmlspecialchars($Joke_answer);
		echo "<h3>" . $safe_Joke_question . "</h3>";
		echo "<div><p>" . $safe_Joke_answer . "-- submitted by user " . $username . "</p></div>";
//		echo "JokeID = $row(JodeID), Joke_question = $row[joke_question], Joke_answer = $row[Joke_answer] <br>");
//       echo "id: " . $row["JokeID"]. " - Joke Question: " . $row["Joke_question"]. " " . $row["Joke_answer"]. "<br>";
    }
} else {
    echo "0 results";
}

?>

</div>