<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" type="text/CSS" href="upload.css">
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
                      <input type="text" placeholder="Search">
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
                    
                ?>
            </div>
        </div>
    </nav>

    <div class="body2">
        <div class= "container">
            <div class="wrapper">
                <div class="image">
                    <img src="./uploadicon.png">     
                </div>
                <div class="content">
                    <div class="icon"><i class="fas fa-cloud"></i></div>
                    <div class="text"> No File Chosen, Yet!</div>
                </div>
                <div id="cancel-btn"><i class="fas fa-times"></i></div>
                <div id="file-name">File Name Here</i></div>
            </div>
            <form action="./profilepichandler.php" method="POST" enctype="multipart/form-data">
                <input id="default-btn" type="file" name="myfile">
                <br><br>
                
                <input type="submit" name="submit">

            </form>
        </div>
    </div>  




    
</body>
</html>