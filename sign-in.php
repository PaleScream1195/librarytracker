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

<!--  ********************************************************************
      sign-in.php        by: Ethan Owens      Date:15 November 2018
      The script contained in this file
      is the sign-in page of my application.
      ********************************************************************  -->

<?php /* ?>

<html>

  <head>
    <meta charset = 'utf-8'>
    <title>Program Name</title>
  </head>

  <body>

    <div>
      <form method='post'>
        Email: <input name='email' type='text'>
        Password:<input name='password' type='password'>
        <button type='submit' name='login' value='0'>Log In</button>
          <a href='sign-up.php'><button type='button' name='sign-up'>Sign-Up</button></a>
      </form>
    </div>


  </body>
</html>

<?php */ ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>librarytracker</title>
    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="library.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
