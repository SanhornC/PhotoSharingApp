<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    date_default_timezone_set("Asia/Taipei"); 

    $servername = "localhost";
    $username = "root";
    $password = "csh00515";
    $dbname = "photoSharingApp";
    $timestamp = date('Y-m-d H:i:s');

    $usr =  $_POST['Username'];
    $usr = "%" . $usr . "%";
    $pwd = $_POST['pwd'];
    $usr = addslashes($usr);

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM `User_Info` WHERE username LIKE ?";

      

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1,$usr);
      $stmt->execute();
      
      $notfound = true; 
      while($row = $stmt->fetch())
      {
     
          $dbpwd = $row["password"];
          if(password_verify($pwd, $dbpwd) && $usr = $row["username"])
          {
            $notfound = false;
            $correctuserid = $row['user_ID'];
            $correctusr = $row["username"];
            $correctgender = $row['gender'];
            $correctmail = $row["email"];
            $correctpwd = $row["password"];
          }
        
      }

      if($notfound)
      {
        echo"<h1>username or password is incorrect</h1>";
        echo "<br><h1>Redirecting...</h1><br>";
        header("refresh:3;url=./newLogIn.html");
      }
      else
      {
        session_start();
        echo"<h1>Successfully Logged In!</h1>";
        $_SESSION['userid'] = $correctuserid;
        $_SESSION['username'] = $correctusr;
        $_SESSION['password'] = $correctpwd;
        $_SESSION['email'] = $correctmail;
        $_SESSION['gender'] = $correctgender;
    
    
        header("refresh:3;url=./mypage.php");
      }

    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      echo "<br>Try again!";
      echo "<br><a href ='./newLogIn.html'>Log In Page</a>";
    }

    ?>
    
</body>
</html>