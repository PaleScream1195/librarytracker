<?php
session_start();
?>



<!doctype html>
<!--  ********************************************************************
      AddBook.html        by: Ethan Owens      Date:22 October 2018
      The script contained in this file

      ********************************************************************  -->

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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="Index.php">Your Library</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a class="nav-link" href="AddBook.php">Add Book</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="wishlist.php">Wish List</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="sign-out.php">Sign out</a>
            </li>
        </ul>
      </div>
    </nav>
    <!-- How will it all be displayed on the page. -->

<?php
if (isset($_POST['upload'])){

echo '
    <div class="alert alert-success" role="alert">
      <h4>Your book has been added to your library!</h4>
    </div> ';

}
if (isset($_POST['wishlist'])){

echo '
    <div class="alert alert-success" role="alert">
      <h4>Your book has been added to your wishlist!</h4>
    </div> ';

}
?>




      <form method = 'post'>
  <div class="form-group container">
      <div >
    <label for="title">Title:</label>
    <input type="text" class="form-control" name="title" id="formGroupExampleInput" >
      </div>
  <div class="form-group">
    <label for="author fname">Author first name:</label>
    <input type="text" class="form-control" name="fname" id="formGroupExampleInput2" >
  </div>
  <div class="form-group">
    <label for="author lname">Author last name:</label>
    <input type="text" class="form-control" name="lname" id="formGroupExampleInput" >
  </div>
  <div class="form-group">
    <p>Please provide a complete description of the work.</p>
    <label for="description">Description:</label>
    <input type="text" class="form-control" name='description' id="formGroupExampleInput2" >
  </div>
  <div class="form-group">
    <label for="img">Image URl:</label>
    <input type="text" class="form-control" name="image" id="formGroupExampleInput" >
    </div>
  </div>
        <div>
        <input type="submit" name="upload" value="Add Book">
        <input type="submit" name="wishlist" value="Add to Wish List">
        </div>
           <a href="Index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Return to the Index</a>
</form>




    <?php

    if (isset($_POST['upload'])){

      require_once('MYSQL_Class.php');
      $mySQL = new mySQL();
      $mySQL->connect('localhost','librarytracker','root','');


        $title = $_POST['title'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $desc = $_POST['description'];
        $img = $_POST['image'];
        $UID = $_SESSION["ID"];


        $result = $mySQL -> select ("SELECT ID FROM authors WHERE authors.fname = ? AND authors.lname = ?",array($fname, $lname));
        if($result -> rowCount() > 0 ){
          $authorID = $result -> fetchColumn();
        }else{
      $authorID = $mySQL -> insert ("INSERT INTO authors (fname, lname) VALUES (?,?)",array($fname, $lname));
      }

       $result = $mySQL -> select ("SELECT ID FROM books WHERE Title = ?",array($title));
      if($result -> rowCount() > 0 ){
        $bookID = $result -> fetchColumn();
      }else{
      $bookID = $mySQL -> insert ("INSERT INTO books (title, description, img) VALUES (?,?,?)",array($title, $desc, $img));
      }



        $authorBooks = $mySQL -> insert ("INSERT INTO authors_books (authorID, bookID) VALUES(?,?)",array($authorID, $bookID));


        $userBooks = $mySQL -> insert ("INSERT INTO users_books (userID, bookID) VALUES(?,?)",array($UID, $bookID));



    }

    if (isset($_POST['wishlist'])){

            require_once('MYSQL_Class.php');
            $mySQL = new mySQL();
            $mySQL->connect('localhost','librarytracker','root','');


              $title = $_POST['title'];
              $fname = $_POST['fname'];
              $lname = $_POST['lname'];
              $desc = $_POST['description'];
              $img = $_POST['image'];
              $UID = $_SESSION["ID"];


              $result = $mySQL -> select ("SELECT ID FROM authors WHERE authors.fname = ? AND authors.lname = ?",array($fname, $lname));
              if($result -> rowCount() > 0 ){
                $authorID = $result -> fetchColumn();
              }else{
            $authorID = $mySQL -> insert ("INSERT INTO authors (fname, lname) VALUES (?,?)",array($fname, $lname));
            }

             $result = $mySQL -> select ("SELECT ID FROM books WHERE Title = ?",array($title));
            if($result -> rowCount() > 0 ){
              $bookID = $result -> fetchColumn();
            }else{
            $bookID = $mySQL -> insert ("INSERT INTO books (title, description, img) VALUES (?,?,?)",array($title, $desc, $img));
            }



              $authorBooks = $mySQL -> insert ("INSERT INTO authors_books (authorID, bookID) VALUES(?,?)",array($authorID, $bookID));

              $wishlist = $mySQL -> insert ("INSERT INTO wishlist (bookID, userID) VALUES(?,?)",array($bookID, $UID));

    }
    ?>

  </body>
  </html>
