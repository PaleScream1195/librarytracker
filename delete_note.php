<?php
session_start();

if(!isset($_SESSION['ID'])){
  header('location:sign-in.php');
}else{

require_once('MYSQL_Class.php');
$mySQL = new mySQL();
$mySQL->connect('localhost','librarytracker','root','');

$data= array($_GET['noteID'],$_SESSION['ID']);

$result = $mySQL -> delete ("DELETE FROM notes WHERE notes.ID=? AND notes.userID=?",$data);

header('location:detail.php?ID='.$_GET["bookID"]);
}
