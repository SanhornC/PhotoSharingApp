<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
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
                    

                    $sql = null;
                    $conn = null;
                ?>
            </div>
        </div>
    </nav> 
    <div class="container"> 
        <!---  Left Sidebar  -->
        <div class="left-sidebar">
            <div class="imp-links">
                <a id="post-show" href="./upload.php"><img src="./post.png"> <span> Post </span> </a>
            </div>
        </div>
        <div class="main-content">
        <?php
            
            require("connect_DB.php");
            $sql625 = "SELECT * FROM Post_likes INNER JOIN User_Posts ON User_Posts.post_ID = Post_likes.post_ID INNER JOIN User_Info ON User_Info.user_ID = User_Posts.user_ID WHERE Post_likes.user_ID = ? ";
                
           
                
            $stmt625 = $conn->prepare($sql625);
            $stmt625->bindParam(1,$currentUserID);
            $stmt625->execute();

            while($row625 = $stmt625->fetch()){
                $name = $row625['username'];
                $img = $row625['post_1'];
                $description = $row625['description'];
                $time = $row625['post_time'];
                echo '<div class="card">
                        <p>'.'<span style="color: Blue">User: </span>'.$name.'</p> <br>
                        <img src="'.$img.'" style=" width: 100%;margin-top:10px; margin-left: auto; margin-right: auto;"> 
                        <p class="message">'.'<span style="color: Blue">Description: </span>'.$description.'</p> <br>
                        <p class="timestramp"><span style="color: Blue">Time: </span>'.$time.'</p>
                        
                        
                    </div>';

                if($_SESSION[$row625['post_ID']] == 111){
                    echo '
                        <div class="card">
                            <a href="./home.php?unlikeID='.$row625["post_ID"].'">Unlike</a>
                        </div>
                    ';
                    //echo $_SESSION[$rowww['post_ID']];
                }
                
                
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



