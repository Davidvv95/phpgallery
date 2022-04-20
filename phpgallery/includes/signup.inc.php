<?php
//Check if user got to this page using the sign up form
//If the user submitted the form, then we run the code in this file, otherwise we send them back to the signup page
if (isset($_POST["submit"])) {

  //Grab data from URL
  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';
  //Error Handlers

  //Use error handler functions to catch errors
  //1) Inputs left empty
  if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
    header("Location: ../signup.php?error=emptyinput");
    exit();
  }
  //2) Check if the username is a proper username
  if (invalidUid($username) !== false) {
    header("Location: ../signup.php?error=invaliduid");
    exit();
  }
  //3) Check if the email is a proper email
  if (invalidEmail($email) !== false) {
    header("Location: ../signup.php?error=invalidemail");
    exit();
  }
  //4) Check if passwords are not the same passwords
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("Location: ../signup.php?error=passwordmatch");
    exit();
  }
  //5) Username / Email already exists
  if (uidExists($conn, $username, $email) !== false) {
    header("Location: ../signup.php?error=usernametaken");
    exit();
  }
  //SIGN UP user
  createUser($conn, $name, $email, $username, $pwd);

}

else {
  header("Location: ../signup.php");
}
