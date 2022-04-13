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

        session_start();
        $currentUsername = $_SESSION["username"];
        $currentUserID = $_SESSION["userid"];
        date_default_timezone_set("Asia/Taipei"); 

        $servername = "localhost";
        $username = "root";
        $password = "csh00515";
        $dbname = "photoSharingApp";
        $timestamp = date('Y-m-d H:i:s');


        
        $distination = "/Applications/XAMPP/xamppfiles/htdocs/PhotoSharingApp/photo/";

        $filepath = $distination.$_FILES["myfile"]["name"];
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $filepath);
        //echo $_FILES["myfile"]["name"];
        $img = "./photo/".$_FILES["myfile"]["name"];
        //echo "<img src='./photo/".$_FILES['myfile']['name']."'>";
       
        
        

        
        $imgnew = addslashes($img);
        require("connect_DB.php");
        //echo $imgnew;
        $sql = "UPDATE `User_Info` SET `profile_pic` = '".$imgnew."' WHERE user_ID = $currentUserID";
        $conn->exec($sql);

        echo "Please Wait, Redirecting....";
        
        
        // ------------------------------------------
        $sql = NULL;
        $conn = NULL;
        
        header("refresh:3;url=./uploadProfilePic.php");
    ?>
</body>
</html>