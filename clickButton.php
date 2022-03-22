<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Account</title>
   
    <link rel="stylesheet" type="text/CSS" href="mypage.css">
    <link rel="stylesheet" type="text/CSS" href="viewcard.css">
    
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
                <img src="./profileIcon.jpeg">
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
            session_start();

            $viewAccountUsername = $_GET['id'];
            $currentUser = $_SESSION["username"];
            
            
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
                    
                
                //echo $currentUser;
                //echo $_SESSION["viewingID"];
                
                $sql1 = "SELECT * FROM User_Info Right JOIN Followers ON User_Info.user_ID = Followers.user_ID WHERE username Like ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bindParam(1,$currentUser);
                $stmt1->execute();

                
                

                $followStatus = false;
                //$cnt = 0;
                while ($row = $stmt1->fetch()) {
                    if ($row["follower_ID"] == $_SESSION["viewingID"]){
                        $followStatus = true;
                    }
                }
                //echo "success";
                
                
                if ($followStatus){
                    echo'
                    <div class="card5">
                        <a href="./unfollow.php?id='.$viewAccountUsername.'">Unfollow</a>
                    </div>';
                }
                else{
                    echo'
                    <div class="card5">
                        <a href="./follow.php?id='.$viewAccountUsername.'">Follow</a>
                    </div>';
                }

                echo '
                    <div class="card5">
                        <h2>Account Name: <span style="color: Blue;">'.$viewAccountUsername.'</span></h2>
                    </div>
                ';

                $sql = " SELECT * FROM User_Posts INNER JOIN User_Info ON User_Posts.user_ID = User_Info.user_ID WHERE username Like ? ORDER BY post_time DESC";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1,$viewAccountUsername);
                $stmt->execute();

                
                while($row = $stmt->fetch()){
            
                    $img = $row['post_1'];
                    $description = $row['description'];
                    $time = $row['post_time'];
                    echo '<div class="card">
                            <img src="'.$img.'" style=" width: 100%;margin-top:10px; margin-left: auto; margin-right: auto;"> 
                            <p class="message">'.'<span style="color: Blue">Description: </span>'.$description.'</p> <br>
                            <p class="timestramp"><span style="color: Blue">Time: </span>'.$time.'</p>
                        </div>';

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