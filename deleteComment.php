<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Comment Handler</title>
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
        // $currentUserID = $_SESSION["userid"];
        $currentCommentID = $_GET['id'];
        $editContentO = $_POST['comment'];
        $editContent = addslashes($editContentO);
        $currentPost = $_SESSION['currentPost'];
        

        try {
            $conn0129 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
            $conn0129->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql0129 = "DELETE FROM Comments WHERE comment_ID = ?";
            
            $stmt0129 = $conn0129->prepare($sql0129);
            $stmt0129->bindParam(1,$currentCommentID);
            $stmt0129->execute();


            echo "Redirecting.....";
            header("refresh:0.5;url=./viewAllComments.php?id=$currentPost");
            // ------------------------------------------
            $sql211137 = NULL;
            $conn211137 = NULL;

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }






    ?>
</body>
</html>