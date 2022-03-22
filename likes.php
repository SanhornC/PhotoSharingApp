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
            
            try {
                $conn2 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // //$sql2 = "SELECT * FROM Followers LEFT JOIN User_Posts ON Followers.follower_ID = User_Posts.user_ID RIGHT JOIN User_Info ON Followers.follower_ID = User_Info.user_ID WHERE Followers.user_ID = ? ORDER BY post_time DESC";
                // ​

                $sql3 = "SELECT * FROM Followers JOIN User_Posts ON Followers.follower_ID = User_Posts.user_ID LEFT JOIN User_Info ON Followers.follower_ID = User_Info.user_ID WHERE Followers.user_ID = ? ORDER BY post_time DESC";
           
                
                $stmt3 = $conn2->prepare($sql3);
                $stmt3->bindParam(1,$currentUserID);
                $stmt3->execute();

                while($rowww = $stmt3->fetch()){
                    $name = $rowww['username'];
                    $img = $rowww['post_1'];
                    $description = $rowww['description'];
                    $time = $rowww['post_time'];
                   
                    echo '<div class="card">
                            <p>'.'<span style="color: Blue">User: </span>'.$name.'</p> <br>
                            <img src="'.$img.'" style=" width: 100%;margin-top:10px; margin-left: auto; margin-right: auto;"> 
                            <p class="message">'.'<span style="color: Blue">Description: </span>'.$description.'</p> <br>
                            <p class="timestramp"><span style="color: Blue">Time: </span>'.$time.'</p>
                            
                            <a href="./likes.php?id='.$rowww["user_ID"].'" >Like</a>
                        </div>';
                }

                //echo $img;

                /*    Likes    */
                



            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

            
            // if (isset($GET['id'])){
            //     try{
            //         $conn33 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //         $conn33->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //         $sql4 = "INSERT INTO `Post_likes`(`user_ID`) VALUES ('$currentUserID')";

            //         $stmt4 = $conn33->prepare($sql4);
            //         $stmt4->execute();

            //         // $stmt3 = $conn2->prepare($sql3);
            //         // $stmt3->bindParam(1,$currentUserID);
            //         // $stmt3->execute();

            //     }
            // }

            
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



