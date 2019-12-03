<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<h1> Jokes Page </h1>
<a href="logout.php">Click here to log out<a>
<a href="login_form.php">Click here login<a>
<a href="register_new_user.php">Click here register<a><br>
<?php

include "db_connect.php";
//include "search_all_jokes.php"
//include "search_keyword.php"
?>


<form class="form-horizontal" action="search_keyword.php">
<fieldset>

<!-- Form Name -->
<legend>Search for a joke</legend>

<!-- Search input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="searchinput">keyword</label>
  <div class="col-md-5">
    <input id="searchinput" name="keyword" type="text" placeholder="ex) chicken" class="form-control input-md" required="">
    <p class="help-block">Enter a word to search for in the joke table</p>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Submit"></label>
  <div class="col-md-4">
    <button id="Submit" name="Submit" class="btn btn-primary">Search</button>
  </div>
</div>

</fieldset>
</form>

<form class="form-horizontal" action="add_joke.php">
<fieldset>
<?php
session_start();
if (isset($_SESSION[userid])):
?>

<!-- Form Name -->
<legend>Add a Joke</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newjoke">Enter text of new joke</label>  
  <div class="col-md-5">
  <input id="newjoke" name="newjoke" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">Enter the first half of your joke</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newanswer">The answer of the joke</label>  
  <div class="col-md-5">
  <input id="newanswer" name="newanswer" type="text" placeholder="" class="form-control input-md">
  <span class="help-block">Enter the punchine of your joke</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Add a new joke</button>
  </div>
</div>

</fieldset>
</form>
<?php else: ?>
<!-- login message will go here-->
<div align="center">
<h3>Login</h3>
<div>You will need a Google account to add a new joke.</div>
<a href="google_login.php">Login here</a>
</div>
<?php endif; ?>

</body>

<hr>


<?php
$mysqli->close();


?>

</body>

<html>