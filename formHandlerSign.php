<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Handler</title>
    
</head>
<body>

  


    <?php

    date_default_timezone_set("Asia/Taipei"); 

    $user = $_POST['Username'];
    $usr = addslashes($user);
    $eml = $_POST['email'];
    $email = addslashes($eml);
    $pwd = $_POST['pwd'];
    $pword = addslashes($pwd);
    $gender = $_POST['gender'];
    $hashedpwd =  password_hash($pword, PASSWORD_BCRYPT);


    $servername = "localhost";
    $username = "root";
    $pass = "csh00515";
    $dbname = "photoSharingApp";
    $timestamp = date('Y-m-d H:i:s');

   


    require("connect_DB.php");

   
    $sql = "INSERT INTO `User_Info`(`username`, `email`, `gender`, `password`) VALUES ('$usr', '$email', '$gender','$hashedpwd')";
    $conn->exec($sql);
    
    // ------------------------------------------
    session_start();
    $_SESSION['username'] = $usr;
    $_SESSION['email'] = $email;
    $_SESSION['gender'] = $gender;
    $_SESSION['password'] = $hashedpwd;

    header("refresh:3;url=./newLogIn.html");
    ?>
    
</body>
</html>