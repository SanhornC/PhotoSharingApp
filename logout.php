<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="project4.css">
  </head>
  <body>
    <section>
      <?php
        session_start();
        session_destroy();
        echo "<h1>User Logged Out!!</h1>";
        header("refresh:1;url=./lobby.html");
      ?>
      <br><br>
    </section>
  </body>
</html>