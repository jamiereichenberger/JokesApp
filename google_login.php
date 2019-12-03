<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "This is the google login page";

#composer require google/apiclient:2.2

session_start();

#require_once('vendor/autoload.php');

$client_id = 
$client_secret = 
$redirect_uri = 

############ MySQL details #################
$db_username = "root"; // DB username
$db_password = "root"; // DB Password
$host_name = "localhost"; // MySQL Hostname
$db_name = 'JokesDB'; // Database name
############################################

// create new connection to Google login service
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
$service = new Google_Service_Oauth2($client);

// case 1 - log user out
if (isset($_GET('logout'])) {
	$client->revokeToke($_SESSION['access_token']);
	session_destroy();
	header('Location: index.php');
}

// case 2 - URL contains a code from Google login service
if (isset($_GET['code'])) {
	$client->authenticate($_GET['code']);
	$_SESSION['access_token'] = $client->getAccessToken();
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	exit;
}

// case 3 - the access_token session variable is set. The user has been logged in. If the user has not been logged in, set variable $authURL to login page.
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	$client->setAccessToken($_SESSION['access_token']);
}
else {
	$authURL = $client->createAuthUrl();
}

// case 4 - user is not logged in. Display login page.
echo '<div style="margin:20px">';
if (isset($authURL)) {
	echo '<div align="center">';
	echo '<h3>Login</h3>';
	echo '<div>You will need a Google account to sign in.</div>';
	echo '<a class="login" href="' . $authURL . '">Login here</a>';
	echo '</div>';
} else {
	// case 5 - user has logged in. Display data about person and add to SQL database
	$user = $service->userinfo->get();
	$mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
	if ($mysqli->connect_error) {
		die('ERROR : (' . mysqli->connect_error . ') ' . $mysqli->connect_error);
}
// Check if user exists in google_users table
$result= $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id= $user->id");
$user_count = $result->fetch_object()->usercount; // return 0 if user doesn't exist

echo '<img src="'.$user->picture.'" style="float: right; margin-top: 33px;" />';
if ($user_count) // if user already exist change greeting text
{
	echo 'Welcome back' . $user->name . '! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
}
else {
	echo 'Hi '.$user->name.', Thanks for Registering! [<href="'.$redirect_uri.'?logout=1">Log Out</a>]';
	statement = $mysqli->prepare("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) VALUES (?,?,?,?,?)");
	$statement->bind_para('issss', $user->id, $user->name, $user->email, $user->link, $user->picture);
	$statement->execute();
	echo $mysqli->error;
	
	//  print user details
	echo "<p>Data about this user. <ul><li>Username: " . $user->name . "</li> <li> user id: " . $user->id . " </li><li>email: " . $user->email . "</li></ul></p>";
	$_SESSION['username']=$user-name;
	$_SESSION['userid']=$user->id;
	$_SESSION['useremail']=$user->email;
}
echo '</div>';

echo "<p>Data about this user. <ul><li>Username: " . $user->name . "</li> <li> user id: " . $user->id . "</li></ul></p>";
//set session variables that will be used by other pages in the application
$result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
$user_count = $result->fetch_object()->usercount; //will return 0 is user doesn't exist

// show user picture
echo '<img src="' . $user->picture.'" style=" float: right; margin-top: 33px;" />

?>