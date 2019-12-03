<?php
include "db_connect.php";

$new_username = $_GET['username'];
$new_password1 = $_GET['password1'];
$new_password2 = $_GET['password2'];

$hashed_password = password_hash($new_password1, PASSWORD_DEFAULT);

echo "<h2>Trying to add a new user " . $new_username . " pw = " . $new_password1 . " and " . $new_password2 . " $</h2>";

// check to see register_add_user already exists
/*$sql = "SELECT * FROM users where username = '$new_username'";

$result = $mysqli->query($sql) or die (mysqli_error($mysqli));

if ($result->num_rows > 0 ) {
	// already exists
	echo "The username" . $new_username . " is already in the database. Can't register twice!";
	
} */
$stnt = $mysqli->prepare("SELECT id, username,password FROM users where username = ? and password = ?");
$stnt->blind_param("ss", $username, $password);

$stnt->execute();
$stnt->store_results();

$stmt->bind_result($userid, $uname, $pw);

if ($new_password1 != $new_password2) {
	echo "The passwords do not match. Please try again";
	exit;
}

preg_match( '/[0-9]+/' , $new_password1, $matches);
if (sizeof($matches) == 0) {
	echo "The password must have one number<br>";
	exit;
}

preg_match('/[!@#$%^&*()]+/', $new_password1, $matches);
if (sizeof($matches) == 0) {
	echo "The password must have one special character<br>";
	exit;
}
if (strlen($new_password1) <= 8) {
	echo "The password must be at least 8 characters long<br>";
}
//insert a new user
//$sql = "INSERT INTO users (id, username, password) VALUES (null, '$new_username', '$hashed_password')";

$stmt = $mysqli->prepare("INSERT INTO users (id, username, password) VALUES (null, ?, ?)");
$stmt->bind_param("ss", $new_username, $hashed_password);
$result->execute();

if ($result) {
	echo "Registration success";
}
else {
	echo "Something went wrong. Not registered";
}

echo "<a href= 'index.php'>Return to main page</a>"
?>