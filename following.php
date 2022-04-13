<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Following Page</title>
    <link rel="stylesheet" type="text/CSS" href="mypage.css">
    <link rel="stylesheet" type="text/CSS" href="viewcard.css">
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
                    require("connect_DB.php");
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
    </nav> <div class="container"> 
        <!---  Left Sidebar  -->
        <div class="left-sidebar">
            <div class="imp-links">
                <a id="post-show" href="./upload.php"><img src="./post.png"> <span> Post </span> </a>
            

            </div>
        </div>
        <div class="main-content">

        <?php

            session_start();
            $currentUserID = $_SESSION['userid'];
            //echo $_SESSION["userid"];
            //echo $currentUserID;
            date_default_timezone_set("Asia/Taipei"); 

            $servername = "localhost";
            $username = "root";
            $password = "csh00515";
            $dbname = "photoSharingApp";
           // $timestamp = date('Y-m-d H:i:s');

            
            $sql22 = "SELECT * FROM User_Info Right JOIN Followers ON User_Info.user_ID = Followers.follower_ID WHERE Followers.user_ID LIKE ?";
            $stmt = $conn->prepare($sql22);
            $stmt->bindParam(1,$currentUserID);
            $stmt->execute();
            //echo "success";
            
            while($row = $stmt->fetch()){
        
                $Usern = $row["username"];
                $profileimg = $row["profile_pic"];
                //$_SESSION["viewingID"] = $row["follower_ID"];
                //echo $_SESSION["viewingID"].'<br>'.$currentUserID;
                echo '
                <div class="card">
                <div class="nav2-user-icon online">
                <img src="'.$profileimg.'">
                </div>
                <p><span>User: </span>'.$Usern.'</p>
                <a href="./unfollow3.php?id='.$row["follower_ID"].'">Remove</a>
                </div>
                ';
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