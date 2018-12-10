<?php
require_once('MYSQL_Class.php');
$db=new mySQL;
$db->connect('localhost','librarytracker','root','');
// get value from submit
if(isset($_POST['email']{0}) && isset($_POST['password']{0}) ) {
  //get values from input
    $email=$_POST['email'];
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
  // Check whether the user exist
    $db_email = $db->select("SELECT email FROM users WHERE email = ?",array($email));
    if($db_email->rowCount() == 0) {
        // insert data
        $db->insert("INSERT INTO users (fname, lname, email, password) VALUES (?,?,?,?)",array($fname,$lname,$email,$password));

        header('location:sign-in.php');

    } else {
        echo "This email has already registered.";
    }
}

?>

<!--  ********************************************************************
      sign-up.php        by Ethan Owens      Date 15 November 2018
      The script contained in this file
      will be the sign-up form for my application.
      ********************************************************************
Please create an account with us!

-->

<html>

 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>sign-up</title>
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

  <body>


    <form method="post" class="container">
        <h3 class="sign-upTitle">Please create an account with us!</h3>
        <div class='form-group'>
            <label> First Name </label>
            <input type="text" name="fname" class="form-control"/>
        </div>
        <div class='form-group'>
            <label> Last Name </label>
            <input type="text" name="lname" class="form-control"/>
        </div>
        <div class='form-group'>
            <label> Email </label>
            <input type="email" name="email" autocomplete="off" class="form-control"/>
        </div>
        <div class='form-group'>
            <label> Password </label>
            <input type="password" name="password" autocomplete="off" class="form-control"/>
        </div>
            <input type="submit" name="submit" value="Sign up"/>
    </form>

  </body>
</html>
