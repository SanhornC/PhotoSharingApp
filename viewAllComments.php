<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Comments</title>
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
                    //echo $currentUserID;

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT * FROM `User_Info` WHERE user_id LIKE $currentUserID";
                        $result = $conn->query($sql);

                        while($row = $result->fetch()){
                            $_SESSION['profilepic'] = $row['profile_pic'];
                        
                            $img = $_SESSION['profilepic'];
                            
                           
                            echo '<img src="'.$img.'">';
                        }

                        //echo $img;

                    } catch(PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    

                    $sql = null;
                    $conn = null;
                ?>
            </div>
        </div>
    </nav> 
    
    <?php

        session_start();

        date_default_timezone_set("Asia/Taipei"); 

        $servername = "localhost";
        $username = "root";
        $password = "csh00515";
        $dbname = "photoSharingApp";
        $timestamp = date('Y-m-d H:i:s');
        $currentUserID = $_SESSION["userid"];
        $currentPostID = $_GET['id'];

        //echo $currentPostID;
        
        try {
            $conn209 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn209->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Post

            $sql2110 = "Select * FROM User_Posts JOIN User_Info ON User_Posts.user_ID = User_Info.user_ID WHERE User_Posts.post_ID = $currentPostID";
            $result2110 = $conn209->query($sql2110);
            while($row2110 = $result2110->fetch()){
                $name = $row2110['username'];
                $img = $row2110['post_1'];
                $description = $row2110['description'];
                $time = $row2110['post_time'];
                $currentPost = $row2110['post_ID'];
                $_SESSION['currentPost'] = $currentPost;
                $commentterm = "comment";
                echo '<div class="card">
                        <p>'.'<span style="color: Blue">User: </span>'.$name.'</p> <br>
                        <img src="'.$img.'" style=" width: 100%;margin-top:10px; margin-left: auto; margin-right: auto;"> 
                        <p class="message">'.'<span style="color: Blue">Description: </span>'.$description.'</p> <br>
                        <p class="timestramp"><span style="color: Blue">Time: </span>'.$time.'</p>
                    </div>';

            }

            echo '
                <br>
                <h2 style="text-align: center;">All Comments:</h2>
                <br>
            ';






        // All Comments           ​

            $sql209 = "SELECT * FROM Comments JOIN User_Info ON Comments.user_ID = User_Info.user_ID WHERE Comments.post_ID = ? ORDER BY Comments.comment_time DESC";
    
            
            $stmt209 = $conn209->prepare($sql209);
            $stmt209->bindParam(1,$currentPostID);
            $stmt209->execute();


            while($row209 = $stmt209->fetch()){               
                $name = $row209['username'];
                $profilepicture = $row209['profile_pic'];
                $commentcontent = $row209['text'];
                $commenttime = $row209['comment_time'];
                $currentCommentID = $row209['comment_ID'];
                $currentCommentUserID = $row209['user_ID'];
                

                
                echo '<div class="card">
                        <div class="nav2-user-icon Online">
                            <img src="'.$profilepicture.'">
                        </div>
                        <h3>'.'<span style="color: Blue">User: </span>'.$name.'</h3> <br>
                        <h4>Comments:</h4><br>
                        <p style="color: brown;"><span>'.$commentcontent.'</span></p><br>
                        <h4>Comment Time:</h4><br>
                        <p>'.$commenttime.'</p><br>
                    </div>';

                if ($currentCommentUserID == $currentUserID){
                    echo '
                        <div class="card">
                            <a href="./editCommentForm.php?id='.$currentCommentID.'">Edit</a>
                            <a href="./deleteComment.php?id='.$currentCommentID.'">Delete</a>
                        </div>
                    ';
                }
            
            }

        
                // $cnt = 0;
                
                // if ($cnt > 1){
                //     $commentterm = "comments";
                // }
                
                
                
        }

        
            


        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }



    ?>
   
</body>
</html>

