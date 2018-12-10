<!doctype html>
<!--  ********************************************************************
      AddBook.html        by: Ethan Owens      Date:22 October 2018
      The script contained in this file

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

    <!-- Unknown method -->
    <form method = 'post'>
      <div> Title:<input name='Title' type='text'/></div>
      <div>Author first name:<input name="fname" type="text"/></div>
      <div>Author last name:<input name="lname" type="text"/></div>
      <div><p>Please use the dashes in your entry.</p></div>
      <div> ISBN:<input name='ISBN' type='text'/></div>
      <div><p>Please provide a complete description of the work.</p></div>
      <div> Description:<input name='description' type='text'/></div>
      <div>Image URl:<input name="image" type="text"/></div>
      <a href="Index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Return to the Index</a>
    </form>

    <?php

    if(isset($_POST['Title']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['ISBN']) && isset($_POST['description']) && isset($_POST['image'])) {

      require_once('MYSQL_Class.php');
      $mySQL = new mySQL();
      $mySQL->connect('localhost','librarytracker','root');


      $result = $mySQL -> select ('SELECT ID FROM authors WHERE fname = ? AND lname=?', [$_POST['fname'],$_POST['lname']] );
      if($result->$rowCount==0){
        $data2 = [$_POST['fname'], $_POST['lname']];
        $authorID = $mySQL -> insert ('INSERT INTO authors(fname, lname) VALUES (?,?)',$data2);
      }else{
        $authorID=$result->fetchColumn();
      }

      $result = $mySQL -> select ('SELECT ID FROM books WHERE Title = ?', $_POST['Title'] );
      if($result->rowCount==0){
        $data = [$_POST['Title'], $_POST['ISBN'], $_POST['description'], $_POST['image'] ];
        $result = $mySQL -> insert ("INSERT INTO books(Title, ISBN, description, img) VALUES(?,?,?,?)",$data);
      }else{
        $bookID=$result->fetchColumn();
      }

      $result = $mySQL -> insert ('INSERT INTO authors_books(authorID, bookID) VALUES(?,?)',[$authorID, $bookID]);

      header('location:Index.php');
    }
    ?>


    <!--DON'T MOVE THESE LINES FROM THE BOTTOM OF THE FILE!!
        They need to remain down here to opperate correctly according to
        http://getbootstrap.com/docs/4.1/getting-started/introduction/-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </html>
