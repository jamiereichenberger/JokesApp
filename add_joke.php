<?php
session_start();
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


include "db_connect.php";
$new_joke_question = addslashes($_GET["newjoke"]);
$new_joke_answer = addslashes($_GET["newanswer"]);
$user_id = $_SESSION["userid"];
$keyword = $_GET['keyword'];
$new_joke_user_id = $_SESSION['userid'];


if(!$_SESSION['username']) {
	echo "Only logged in users may access this page. Click <a href='login_form.php' here </a> to login<br>";
	exit;
}


$new_joke_question = addslashes($new_joke_question);
$new_joke_answer = addslashes($new_joke_answer);
$new_joke_user_id = $_SESSION['userid'];

// Purpose is to add jokes
echo "<h2>Trying to add a new joke: $new_joke_question and $new_joke_answer </h2>";

$sql = "INSERT INTO Jokes_table (JokeID, Joke_question, Joke_answer, user_id) VALUES (NULL, '$new_jokes_question', '$new_joke_answer', '$new_joke_user_id')";

$stnt = $mysqli->prepare("INSERT INTO jokes (JokeID, Joke_question, Joke_answer, users_id) VALUES ( NULL,'?', '?', '?)");
$stnt->bind_param("ssi", $new_joke_question, $new_joke_answer, $userid);

$stnt->execute();
$stnt->close();

$result = $mysqli->query($sql) or die(mysqli_error($mysqli));


include "search_all_jokes.php";


?>
<a href="index.php">Return to main page</a>