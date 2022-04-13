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

        date_default_timezone_set("Asia/Taipei"); 

        require("connect_DB.php");
        $distination = "/Applications/XAMPP/xamppfiles/htdocs/PhotoSharingApp/photo/";

        $filepath = $distination.$_FILES["myfile"]["name"];
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $filepath);
        //echo $_FILES["myfile"]["name"];
        $img = "./photo/".$_FILES["myfile"]["name"];
        //echo "<img src='./photo/".$_FILES['myfile']['name']."'>";
       
        
        

        $description = addslashes($_POST['mytext']);
       
        


        $descriptionNew = addslashes($description);
        $imgnew = addslashes($img);
        //echo $descriptionNew;
        $userid = $_SESSION['userid'];
        $sql3 = "INSERT INTO `User_Posts`(`user_ID`, `description`, `post_1`, `post_time`) VALUES ('$userid', '$description', '$imgnew', '$timestamp')";
        $conn->exec($sql3);

        echo "Please Wait, Redirecting....";
        
        
        // ------------------------------------------
        $sql3 = NULL;
        $conn = NULL;
        
        header("refresh:3;url=./upload.php");

        
    ?>
</body>
</html>