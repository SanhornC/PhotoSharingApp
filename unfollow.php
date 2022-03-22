<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow Handler</title>
</head>
<body>
    <?php

    session_start();
    $viewingName = $_GET['id'];
    $viewing = $_SESSION["viewingID"];
    $currentUser = $_SESSION["userid"];

   // echo $currentUser;
    
    date_default_timezone_set("Asia/Taipei"); 

    $servername = "localhost";
    $username = "root";
    $password = "csh00515";
    $dbname = "photoSharingApp";
    $timestamp = date('Y-m-d H:i:s');

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        
        $sql = "DELETE FROM `Followers` WHERE `follower_ID` LIKE '$viewing' AND `user_ID` LIKE '$currentUser'";
        $conn->exec($sql);
        
        
        header("refresh:0.5;url=./clickButton.php?id=$viewingName");
        // ------------------------------------------
        $sql = NULL;
        $conn = NULL;
        
       
        
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    ?>
</body>
</html>