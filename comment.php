<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>commentHandler</title>
</head>
<body>
    <?php

        session_start();

        date_default_timezone_set("Asia/Taipei"); 

        $servername = "localhost";
        $username = "root";
        $password = "csh00515";
        $dbname = "photoSharingApp";
        $timestamp = date('Y-m-d H:i:s');

        $commentC = $_POST['addcomment'];
        $comment = $commentC;
        $commentContent = addslashes($comment);

        $currentPostID = $_GET['id'];
        $currentUserID = $_SESSION["userid"];

        require("connect_DB.php");

        $sql198 = "INSERT INTO `Comments`(`user_ID`, `text`, `post_ID`) VALUES ('$currentUserID', '$commentContent', '$currentPostID')";
        $conn->exec($sql198);
        
        
        // ------------------------------------------
        $sql198 = NULL;
        $conn = NULL;
        
        header("refresh:0.1;url=./home.php");
    ?>
</body>
</html>