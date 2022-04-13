<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
   
    <link rel="stylesheet" type="text/CSS" href="mypage.css">
    
    
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

                    require("connect_DB.php");
                    $currentUserID = $_SESSION["userid"];
                    $sql = "SELECT * FROM `User_Info` WHERE user_id LIKE $currentUserID";
                    $result = $conn->query($sql);

                    while($row = $result->fetch()){
                        $_SESSION['profilepic'] = $row['profile_pic'];
                    
                        $img = $_SESSION['profilepic'];
                        
                        
                        echo '<img src="'.$img.'">';
                    }
                    
                ?>
            </div>
        </div>
    </nav>

    <div class="container"> 
        <!---  Left Sidebar  -->
        <div class="left-sidebar">
            <div class="imp-links">
                <a id="post-show" href="./upload.php"><img src="./post.png"> <span> Post </span> </a>
                <a id="post-show" href="./uploadProfilePic.php"><img src="./profileIcon.jpeg"> <span>Upload Profile Pic</span> </a>
            </div>
        </div>
        <div class="main-content">

        <?php

            session_start();

            date_default_timezone_set("Asia/Taipei"); 

            require("connect_DB.php");

            $userid = $_SESSION['userid'];
            $usernameaa = $_SESSION['username'];
            $sql = "SELECT * FROM User_Posts WHERE user_id = $userid ORDER BY post_time DESC";
            $result = $conn->query($sql);

            while($row = $result->fetch()){
        
                $img = $row['post_1'];
                $description = $row['description'];
                $time = $row['post_time'];
                echo '<div class="card">
                        <img src="'.$img.'" style=" width: 100%;margin-top:10px; margin-left: auto; margin-right: auto;"> 
                        <p class="message">'.'<span style="color: Blue">Description: </span>'.$description.'</p> <br>
                        <p class="timestramp"><span style="color: Blue">Time: </span>'.$time.'</p>
                    </div>';
            }
            
        ?>

        </div>
        <div class="right-sidebar">
            <div class="sidebar-title">
                <h4>Events</h4>
                <a href="#"> See All</a>
            </div>

            <div class="event">
                <div class="left-event">
                    <h3>26</h3>
                    <span>Feburary</span>
                </div>
            

                <div class="right-event">
                    <h4>Vex Competition</h4>
                    <p>Team 96969Y</p>
                    <a href="#">More Info</a>
                </div>
            </div>

            <div class="event">
                <div class="left-event">
                    <h3>25</h3>
                    <span>Feburary</span>
                </div>
            

                <div class="right-event">
                    <h4>College</h4>
                    <p>UIUC Decision Letter</p>
                    <a href="#">More Info</a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>