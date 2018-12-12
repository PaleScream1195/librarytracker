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

$result = $mySQL -> select ('SELECT books.ID, title, fname, lname, description FROM books
                               JOIN wishlist ON wishlist.bookID = books.ID
                               JOIN authors_books ON books.ID = authors_books.bookID
                               JOIN authors ON authors.ID = authors_books.authorID
                               WHERE wishlist.userID = ?', [$UID]);

$results = array();
  while ($row = $result->fetch()){
  $results[]=$row;
}
header('Content-Type: application/json');
echo json_encode($results);
