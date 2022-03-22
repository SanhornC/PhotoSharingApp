<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Form Handler</title>
    <link rel="stylesheet" type="text/CSS" href="mypage.css">
</head>
<body>
    <nav>
        <div class="nav-left">
            <img src="paslogo.png" class="logo">
            <ul>
                <li><a href="./home.php">Home</a></li>
                <li><a href="./mypage.php">My Profile</a></li>
                <li><a href="./followers.php">Followers</a></li>
                <li><a href="./following.php">Following</a></li>
                <li><a href="./likedPost.php">Liked Post</a></li>                
                <li><a href="./logout.php">Log Out</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <div class="search-box">
                <img src="./seachicon.png">
                    <form action="./formSearch.php" method="POST">
                      <input type="text" name="searchusername" placeholder="Search">
                    </form>
            </div>
            <div class="nav-user-icon online">
            <?php
                    session_start();

                    date_default_timezone_set("Asia/Taipei"); 

                    $servername = "localhost";
                    $username = "root";
                    $password = "csh00515";
                    $dbname = "photoSharingApp";
                    $timestamp = date('Y-m-d H:i:s');
                    $currentUserID = $_SESSION["userid"];
                    

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                       
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT * FROM `User_Info` WHERE user_id LIKE $currentUserID";
                        $result = $conn->query($sql);

                        while($row = $result->fetch()){
                            $_SESSION['profilepic'] = $row['profile_pic'];
                        
                            $img = $_SESSION['profilepic'];
                            
                           
                            echo '<img src="'.$img.'">';
                        }

                    } catch(PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    
                ?>
            </div>
        </div>
    </nav>
    <?php

        session_start();

        $searchUser = $_POST['searchusername'];
        $searchu = '%'.$searchUser.'%';
        $searchUsername = addslashes($searchu);
        
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
                
            
            $sql = "SELECT * FROM User_Posts LEFT JOIN User_Info ON User_Posts.user_ID = User_Info.user_ID WHERE username Like ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$searchUsername);
            $stmt->execute();
            
            $existed = "";
            while($row = $stmt->fetch())
            {
                
                if ($existed != $row["username"]){
                    $profileimg = $row['profile_pic'];
                    $_SESSION["viewingID"] = $row["user_ID"]; 
                    echo '
                    <div class="card">
                        <div class="nav2-user-icon online">
                            <img src="'.$profileimg.'">
                        </div>
                        <p><span>User: </span>'.$row["username"].'</p>
                        <a href="./clickButton.php?id='.$row["username"].'">View Account</a>
                    </div>
                    '; 
                }
                $existed = $row["username"];
                
             }
            
            
            // ------------------------------------------
            $sql = NULL;
            $conn = NULL;
            
           
            
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            echo "<br>Try again!";
            echo "<br><a href ='./upload.php'>Try Again</a>";
        }
    ?>
</body>
</html>