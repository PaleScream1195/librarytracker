<?php
session_start();
require_once('MYSQL_Class.php');
$mySQL = new mySQL();
$mySQL->connect('localhost','librarytracker','root','');

if(!isset($_SESSION['ID'])) {
  header('location:sign-in.php');
}

$UID = $_SESSION["ID"] ;
$data = $_GET['ID'];
/* sql query to insert the new note */
if (isset($_POST['upload'])){
  $note = $_POST['note'];
  $result = $mySQL -> insert ("INSERT INTO notes (bookID, userID, note) VALUES (?,?,?)",array($data,$UID,$note));
}
/* sql query to update the page_number */
if (isset($_POST['page_number_saver'])){
   $page_number = $_POST['page_number'];
   $result = $mySQL -> update ("UPDATE users_books SET page_number = ? WHERE userID = ? AND bookID = ?", array($page_number,$UID,$data));
}
?>
<!doctype html>
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<div class="container" id='bookDetail'>
</div>

<script>
  var data;
  $.getJSON("detail.JSON.php?ID=<?php echo $_GET['ID']; if(isset($_GET['page'])){echo '&page='.$_GET['page'];} ?>",function(result){
    console.log(result);
    var html='';
    html+=
    '<div class="box">'+
    result.title + ' By: ' + result.fname + ' ' + result.lname +
    '<br><p>Description of the book:<br>' + result.description + '</p>';
    console.log(Object.keys(result.notes).length);
    if(Object.keys(result.notes).length>0){
    html+=
    '<div class="box">' + result.page_number + '</div>' +
    '<div class="box">';
    console.log(result.notes);
    for( key in result.notes){
      html+= result.notes[key].text;
      if(result.notes[key].canDelete==1){
        html +=
        '<br><a href="delete_note.php?noteID=' + key + '&bookID=' + result.ID + '" name="delete_note" role="button">Delete this note</a><br>';
      }
    }
    html+='</div>';
  }
    html+='</div>';
    $( "#bookDetail" ).html(html);
  });
</script>
<?php if(!isset($_GET['page'])){  ?>
 <form method="post">
   <div class="form-group container">
   <div class="form-group">
     <label for="page_number">Page you're on:</label>
     <input type="text" name="page_number">
   </div>
   <div>
     <input type="submit" name="page_number_saver" value="You're on this page!">
   </div><br>
   <div class="form-group">
     <label for="notes">Notes:  </label>
     <textarea placeholder="Save any notes here." name="note"></textarea>
   </div>
   <div>
     <input type="submit" name="upload" value="Add these notes!">
   </div>
   </div>
 </form>
<?php } ?>
<br><a href="delete.php?ID=<?php echo $_GET['ID']; if(isset($_GET['page'])){echo '&page='.$_GET['page'];} ?>" name="delete" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Delete this Entry</a>
<br><a href="Index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Return to the Index</a>


</body>
</html>
