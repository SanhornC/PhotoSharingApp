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
                <li><a href="./likedPost.php">Liked Post</a></li>                
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
                <img src="./profileIcon.jpeg">
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
            <form action="./formHandlerUpload.php" method="POST" enctype="multipart/form-data">
                <input id="default-btn" type="file" name="myfile">
                <br><br>
                <label for="text">Description: </label>
                <br>
                <textarea name="mytext" id="text" cols="30" rows="10"></textarea>
                <br>
                <input type="submit" name="submit">

            </form>
        </div>
    </div>  




    
</body>
</html>