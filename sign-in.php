<?php
session_start();
if(isset($_POST['password']) && isset($_POST['email'])) {
  require_once('MYSQL_Class.php');
  $SQL = new mySQL();
  $SQL->connect('localhost','librarytracker','root');
  $result=$SQL->select("SELECT email, password, ID FROM users WHERE email=?",[$_POST['email']]);
  if($result->rowCount()==0) {
    echo("Invalid email entered.");
  }
  else
  {
    $user = $result->fetch();
    if(password_verify($_POST['password'],$user['password'])) {
      $_SESSION["ID"]=$user["ID"];
      header('location:Index.php');
    }
    else {
      echo("Invalid password. Try again.");
    }
  }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Library Tracker</title>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="library.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </head>

<!-- missing the method for the form. -->

  <body class="text-center">
    <form class="form-signin" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name='email' class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name='password' class="form-control" placeholder="Password" required>

        <!-- This button is not operating correctly. -->
         <button type='submit' name='login' value='0'>Log In</button>
          <a href='sign-up.php'><button type='button' name='sign-up'>Sign-Up</button></a>
   <!--
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    -->

    </form>

  </body>
</html>
