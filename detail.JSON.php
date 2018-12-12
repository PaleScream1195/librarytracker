<?php
session_start();

if(!isset($_SESSION['ID'])) {
header('Content-Type: application/json');
$results=array('message'=>'You are not logged in to the system. Please log in.');
echo json_encode($results);
}

require_once('MYSQL_Class.php');
$mySQL = new mySQL();
$mySQL->connect('localhost','librarytracker','root','');

$UID = $_SESSION["ID"] ;
$data = $_GET['ID'];

if(isset($_GET['page']) && $_GET['page'] == 'wishlist'){
  $result = $mySQL -> select ('SELECT books.ID, title, fname, lname, description FROM books
                               JOIN wishlist ON wishlist.bookID = books.ID
                               JOIN authors_books ON books.ID = authors_books.bookID
                               JOIN authors ON authors.ID = authors_books.authorID
                               WHERE wishlist.bookID = ?', [$data]);
}else{
/* sql query to select the specific book */
$result = $mySQL -> select ('SELECT books.ID, notes.ID as noteID, notes.userID, title, fname, lname, description, page_number, note FROM books
                             JOIN authors_books ON books.ID = authors_books.bookID
                             JOIN authors ON authors.ID = authors_books.authorID
                             JOIN users_books ON users_books.bookID = books.ID
                             LEFT JOIN notes ON notes.bookID = books.ID
                             WHERE books.ID = ?', [$data]);
}

$results = array();
$results['notes']=array();

while($row = $result->fetch()){
  $results['ID']=$_GET['ID'];
  $results['title']=$row['title'];
  $results['fname']=$row['fname'];
  $results['lname']=$row['lname'];
  $results['description'] = $row['description'];
  if(isset($_GET['page']) && $_GET['page'] == 'wishlist'){
    continue;
  }
  $results['page_number']=$row['page_number'];
  $results['notes'][$row['noteID']]=['canDelete'=>$row['userID']==$_SESSION["ID"] ? 1 : 0,'text'=>$row['note']];
}

header('Content-Type: application/json');
echo json_encode($results);
