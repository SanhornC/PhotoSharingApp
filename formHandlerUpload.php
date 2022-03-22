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
       
        
        

        $description = addslashes($_POST['mytext']);
       
        


        $descriptionNew = addslashes($description);
        $imgnew = addslashes($img);
        //echo $descriptionNew;
        $userid = $_SESSION['userid'];
       // echo '<br>'.$userid;
        

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            
            $sql = "INSERT INTO `User_Posts`(`user_ID`, `description`, `post_1`, `post_time`) VALUES ('$userid', '$description', '$imgnew', '$timestamp')";
            $conn->exec($sql);

            echo "Please Wait, Redirecting....";
            
            
            // ------------------------------------------
            $sql = NULL;
            $conn = NULL;
            
            header("refresh:3;url=./upload.php");
           
            
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            echo "<br>Try again!";
            echo "<br><a href ='./upload.php'>Try Again</a>";
        }
    ?>
</body>
</html>