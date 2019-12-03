<?php

session_start();



include "db_connect.php";
$username= addslashes($_POST['username']);
$password = addslashes($_POST['password']);
//$userid = $_SESSION['user_id'];

echo "You attempted to login with " . $username . " and " . $password . "<br>";

//if ($mysqli->connect_errno) {
  //  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . //") " . $mysqli->connect_error;
//} 
//echo "<h2> Show all jokes with the word '$keyword' </h2>";

//sql = "SELECT id, password, username FROM users WHERE username = '$username' AND password = '$password'";
$stmt = $mysqli->prepare("SELECT id, username, password FROM users where username = ?");
$stmt->bind_param("s", $username);

$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 1) {
	echo "1 found one person with that userame<br>";
	$stmt->fetch();
	if (password_verify($password, $hashed_password)) {
		echo "The password matches<br>";
		$_SESSION['username'] = $uname;
	$_SESSION['userid'] = $userid;
	} else {
		echo "your password is wrong";
		$_SESSION = [];
	session_destroy();
	}
} else {
	echo "login failed";
	$_SESSION = [];
	session_destroy();
}

//echo "SQL = " . $sql . "<br>";

//$result = $mysqli->query($sql);
//echo "Select returned $result->num_rows rows of data<br>";


?> 