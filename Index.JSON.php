<?php
session_start();
$data = $_SESSION["ID"] ;

require_once('MYSQL_Class.php');
$mySQL = new mySQL();
$mySQL->connect('localhost','librarytracker','root','');

$result = $mySQL -> select ('SELECT books.ID, title, fname, lname FROM books
                             JOIN users_books ON users_books.bookID = books.ID
                             JOIN authors_books ON books.ID = authors_books.bookID
                             JOIN authors ON authors.ID = authors_books.authorID
                             WHERE users_books.userID = ?', [$data]);

$results = array();
  while ($row = $result->fetch()){
    $results[]=$row;
}
header('Content-Type: application/json');
echo json_encode($results);
