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