<?php session_start(); ?>


<!doctype html>
<!--  ********************************************************************
      Index.php        by: Ethan Owens      Date:17 October 2018
      The script contained in this file
      is supposed to represent the shell of my application.

      I believe that it has been changed to represent the homepage of my application.
      ********************************************************************  -->

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title> Library Tracker </title>
  </head>
  <body>
    <!-- How will it all be displayed on the page. -->
    <?php
    require_once('MYSQL_Class.php');
    $mySQL = new mySQL();
    $mySQL->connect('localhost','librarytracker','root','');

    require_once('tableClasses.php');
    $creating = new csv;
    $databases = new database;




    $data = $_SESSION["ID"] ;


    $result = $mySQL -> select ('SELECT b.title, b.id, b.img, a.fname, a.lname FROM books AS b
                                 JOIN authors_books AS ab ON b.id = ab.bookID
                                 JOIN authors As a ON a.id = ab.authorID
                                 JOIN users_books AS ub on ub.userID = ?'
                                 , [$data]);

  #  $creating('');
  #  $databases($result);



    ?>

    <form>
      <a href="AddBook.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add a Book</a>
    </form>




    <!--DON'T MOVE THESE LINES FROM THE BOTTOM OF THE FILE!!
        They need to remain down here to opperate correctly according to
        http://getbootstrap.com/docs/4.1/getting-started/introduction/-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </html>
