<?php
session_start();
?>
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

      <div class="container" id="bookList">
      </div>
  <script>
            $.getJSON("wishlist.JSON.php", function(result){
              var html='';
              for(i=0;i<result.length;i++){
                  html+=
                  '<div class="box" > '+
                  "<a href=detail.php?ID=" + result[i].ID +">"+result[i].title+"</a>" +
                  " By: "+result[i].fname+" "+result[i].lname + "<br>" +
                  '<a class="btn btn-primary btn-sm active delete_button" data-id="'+result[i].ID+'" name="delete"  role="button" aria-pressed="true">Delete this Entry</a>'
                  +
                  "</div>";
              }
              $( "#bookList" ).html(html);
            });
            $(document ).on('click', ".delete_button",function() {
              // contains the bookID that is dynamically grabbed.
              $(this).data('id');
              console.log($(this).data('id'));
              $(this).parent().remove();
              $.getJSON("delete.php?ID="+ $(this).data('id') +"&page=wishlist");
            });
  </script>
<a href="Index.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Return to the Index</a>

</body>
</html>
