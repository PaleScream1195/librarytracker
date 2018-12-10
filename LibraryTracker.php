

<!--  ********************************************************************
      LibraryTracker.php        by: Ethan Owens      Date:17 October 2018
      The script contained in this file
      is supposed to represent the homepage of my application.
      ********************************************************************  -->

      <?php

      #need to figure out the file system for this
      $file_handler=fopen('movies.csv','r');

      echo '<table border=1 class="table table-striped table-dark">';
      $count=0;


      while(!feof($file_handler)){
          $line=fgets($file_handler);
          $content=explode(';',$line);
          if(count($content)<$line)break;
          if($count==0) printHeader($content);
          else printRow($content,$count);
          $count++;
      }#end of while

      echo'<table>';


      function printHeader($row){
          echo'<tr>';
          foreach($row as $col)echo'<th>'.$col.'</th>';
          echo'</tr>';
      }#end of printHeader



      function printRow($row,$id){
        if(count($row)<3) return;
        echo'<tr>';
        echo'<td><a href="detail.php?id='.$id.'">'.$row[0].'</a></td>';
        echo'<td>'.$row[1].'</td>';
        echo'<td>'.$row[2].'</td>';
        echo'<td><img src="'.$row[3].'" width="100"/></td>';

        #need to change the href of this one
        echo'<td><a  href="http://localhost/my_imdb/modify.php?id='.$id.'">Modify this entry</a></td>';

        echo'</tr>';
      }#end of printRow


      ?>

      <html>
      <head>
        <link rel='stylesheet' href='css/bootstrap.min.css'>
      </head>
      <body>

      <form>
      <input type="button" value="Create a new entry!"
      onclick="window.location.href='http://localhost/my_imdb/create.php'"/>
      </form>

      <script language='JavaScript'>

      </script>

      </body>
      </html>
