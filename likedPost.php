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
    <div class="container"> 
        <!---  Left Sidebar  -->
        <div class="left-sidebar">
            <div class="imp-links">
                <a id="post-show" href="./upload.php"><img src="./post.png"> <span> Post </span> </a>
            </div>
        </div>
        <div class="main-content">
        <?php
            
            
        //     $_SESSION['unlikeIIDD'] = $_GET['unlikeID'];
        //     if ($_SESSION['unlikeIIDD'] == NULL){
        //         try{
        //             $conn100 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //             $conn100->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    

        //             $sql100 = "SELECT * From `Post_likes` WHERE user_ID = ?";

        //             $stmt100 = $conn100->prepare($sql100);
        //             $stmt100->bindParam(1,$currentUserID);
        //             //$stmt4->bindParam(2,$viewpost);
        //             $stmt100->execute();

        //             // if($)


        //             //$likeStatus = false;


        //             while($row100 = $stmt100->fetch()){
                        
        //                 $_SESSION[$row100['post_ID']] = 111;
                    
        //             }

        //             // if($likeStatus){
        //             //     $_SESSION['viewPost'] = $_SESSION['viewingPostID'];
        //             // }
        //             // else{
        //             //     $_SESSION['viewPost'] = NULL;
        //             // }

        //             // $stmt3 = $conn2->prepare($sql3);
        //             // $stmt3->bindParam(1,$currentUserID);
        //             // $stmt3->execute();

        //         }
        //         catch(PDOException $e) {
        //             echo "Connection failed: " . $e->getMessage();
        //         }
            

            
        //     else{


        //         if (isset($_SESSION['unlikeIIDD'])){
        //             try{
        //                 $conn88 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //                 $conn88->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //                 $sql15 = "DELETE FROM `Post_likes` WHERE post_ID = ? and user_ID = ?";
        //                 $stmt15 = $conn88->prepare($sql15);
        //                 $stmt15->bindParam(1,$_SESSION['unlikeIIDD']);
        //                 $stmt15->bindParam(2,$currentUserID);
        //                 $stmt15->execute();

        //                 $sql9 = "SELECT * From `Post_likes` WHERE user_ID = ?";

        //                 $stmt9 = $conn88->prepare($sql9);
        //                 $stmt9->bindParam(1,$currentUserID);
        //                 //$stmt4->bindParam(2,$viewpost);
        //                 $stmt9->execute();

        //                 // if($)


        //                 //$likeStatus = false;


        //                 while($row9 = $stmt9->fetch()){
                            
        //                     $_SESSION[$row9['post_ID']] = 111;
                        
        //                 }

        //                 // if($likeStatus){
        //                 //     $_SESSION['viewPost'] = $_SESSION['viewingPostID'];
        //                 // }
        //                 // else{
        //                 //     $_SESSION['viewPost'] = NULL;
        //                 // }

        //                 // $stmt3 = $conn2->prepare($sql3);
        //                 // $stmt3->bindParam(1,$currentUserID);
        //                 // $stmt3->execute();

        //             }
        //             catch(PDOException $e) {
        //                 echo "Connection failed: " . $e->getMessage();
        //             }
        //         }
        //     }
        // }

            try{

                $conn625 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn625->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // //$sql2 = "SELECT * FROM Followers LEFT JOIN User_Posts ON Followers.follower_ID = User_Posts.user_ID RIGHT JOIN User_Info ON Followers.follower_ID = User_Info.user_ID WHERE Followers.user_ID = ? ORDER BY post_time DESC";
                // ​

                $sql625 = "SELECT * FROM Post_likes INNER JOIN User_Posts ON User_Posts.post_ID = Post_likes.post_ID INNER JOIN User_Info ON User_Info.user_ID = User_Posts.user_ID WHERE Post_likes.user_ID = ? ";
                
           
                
                $stmt625 = $conn625->prepare($sql625);
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

                //echo $img;

                /*    Likes    */
                


            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
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



