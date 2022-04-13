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

                    require("connect_DB.php");
                    $currentUserID = $_SESSION["userid"];
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
            $_SESSION['viewingPostID'] = $_GET['id'];
            $_SESSION['unlikeIIDD'] = $_GET['unlikeID'];

            if ($_SESSION['viewingPostID'] == NULL && $_SESSION['unlikeIIDD'] == NULL){
                
                $sql100 = "SELECT * From `Post_likes` WHERE user_ID = ?";

                $stmt100 = $conn->prepare($sql100);
                $stmt100->bindParam(1,$currentUserID);
                $stmt100->execute();


                while($row100 = $stmt100->fetch()){
                    
                    $_SESSION[$row100['post_ID']] = 111;
                
                }
            }

            
            else{


                if (isset($_SESSION['unlikeIIDD'])){
                    //require("connect_DB.php");
                    

                    $sql15 = "DELETE FROM `Post_likes` WHERE post_ID = ? and user_ID = ?";
                    $stmt15 = $conn->prepare($sql15);
                    $stmt15->bindParam(1,$_SESSION['unlikeIIDD']);
                    $stmt15->bindParam(2,$currentUserID);
                    $stmt15->execute();

                    $sql9 = "SELECT * From `Post_likes` WHERE user_ID = ?";

                    $stmt9 = $conn->prepare($sql9);
                    $stmt9->bindParam(1,$currentUserID);
                    
                    $stmt9->execute();

                    


                    while($row9 = $stmt9->fetch()){
                        
                        $_SESSION[$row9['post_ID']] = 111;
                    
                    }
                }

                if (isset($_SESSION['viewingPostID'])){
                    $viewpost = $_SESSION['viewingPostID'];
                    //require("connect_DB.php");
                    $sql5 = "INSERT INTO `Post_likes`(`post_ID`,`user_ID`) VALUES ('$viewpost','$currentUserID')";
                    $stmt5 = $conn->prepare($sql5);
                    $stmt5->execute();

                    $sql4 = "SELECT * From `Post_likes` WHERE user_ID = ?";

                    $stmt4 = $conn->prepare($sql4);
                    $stmt4->bindParam(1,$currentUserID);
                    
                    $stmt4->execute();

                    

                    while($row4 = $stmt4->fetch()){
                        
                        $_SESSION[$row4['post_ID']] = 111;
                    
                    }
                }
            }  

            //require("connect_DB.php");
            $sql3 = "SELECT * FROM Followers JOIN User_Posts ON Followers.follower_ID = User_Posts.user_ID LEFT JOIN User_Info ON Followers.follower_ID = User_Info.user_ID WHERE Followers.user_ID = ? ORDER BY post_time DESC";
           
                
            
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bindParam(1,$currentUserID);
            $stmt3->execute();

            while($rowww = $stmt3->fetch()){
                $name = $rowww['username'];
                $img = $rowww['post_1'];
                $description = $rowww['description'];
                $time = $rowww['post_time'];
                $currentPost = $rowww['post_ID'];
                $commentterm = "comment";
                echo '<div class="card">
                        <p>'.'<span style="color: Blue">User: </span>'.$name.'</p> <br>
                        <img src="'.$img.'" style=" width: 100%;margin-top:10px; margin-left: auto; margin-right: auto;"> 
                        <p class="message">'.'<span style="color: Blue">Description: </span>'.$description.'</p> <br>
                        <p class="timestramp"><span style="color: Blue">Time: </span>'.$time.'</p>
                    </div>';

                $sql19 = "SELECT * FROM Comments WHERE post_ID = $currentPost";
                $result19 = $conn->query($sql19);
                $cnt = 0;
                while($row19 = $result19->fetch()){
                    $cnt++;
                }
                if ($cnt > 1){
                    $commentterm = "comments";
                }
                
                
                if($_SESSION[$rowww['post_ID']] == 111){
                    echo '
                        <div class="card">
                            <a href="./home.php?unlikeID='.$rowww["post_ID"].'">Unlike</a>
                            <br><Br>
                            <div class="nav-right">
                                <div class="search-box">
                                    <img src="./commenticon.png">
                                    <form action="./comment.php?id='.$currentPost.'" method="POST">
                                        <input type="text" name="addcomment" placeholder="Add Comment ">
                                    </form>
                                </div>
                            </div>
                            <a href="./viewAllComments.php?id='.$currentPost.'">'.$cnt.' '.$commentterm.'</a>
                        </div>
                    ';
                    
                }
                if($_SESSION[$rowww['post_ID']] != 111){
                    echo '
                        <div class="card">
                            <a href="./home.php?id='.$rowww["post_ID"].'">Like</a>
                            <br><Br>
                            <div class="nav-right">
                                <div class="search-box">
                                    <img src="./commenticon.png">
                                    <form action="./comment.php?id='.$currentPost.'" method="POST">
                                        <input type="text" name="addcomment" placeholder="Add Comment">
                                    </form>
                                </div>
                            </div>
                            <a href="./viewAllComments.php?id='.$currentPost.'">'.$cnt.' '.$commentterm.'</a>
                            
                        </div>
                    ';
                    
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



