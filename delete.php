<?php
session_start();
require_once('MYSQL_Class.php');
$mySQL = new mySQL();
$mySQL->connect('localhost','librarytracker','root','');

$data=array($_SESSION["ID"], $_GET['ID']);

if(isset($_GET['page']) && $_GET['page'] == 'wishlist'){
$result= $mySQL -> delete ("DELETE FROM wishlist WHERE userID=? AND bookID=?",$data);
/* redirects the user back to the wishlist */
header('location:wishlist.php');
}else{
$result = $mySQL -> delete ("DELETE FROM users_books WHERE userID=? AND bookID=?",$data);
$result = $mySQL -> delete ("DELETE FROM notes WHERE userID=? AND bookID=?", $data);
/* redirects the user back to the index */
header('location:Index.php');
}
