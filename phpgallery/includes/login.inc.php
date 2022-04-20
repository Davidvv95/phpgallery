<?php
//Check if user used the sign in form
if (isset($_POST["submit"])) {

  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  //Error Handlers
  //1) Empty inputs
  if (emptyInputLogin($username, $pwd) !== false) {
    header("Location: ../login.php?error=emptyinput");
    exit();
  }
  //Login user
  loginUser($conn, $username, $pwd);
}
else {
  header("Location: ../login.php");
  exit();
}
