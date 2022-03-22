<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment Form</title>
</head>
<body>

    <?php

        $CommentID = $_GET['id'];


        echo '
        
        <form action="./editComment.php?id='.$CommentID.'" method="POST">
            <labet>Edit Comment Content: </label>
            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
            <input type="submit">
        </form>
        
        
        ';

    ?>
</body>
</html>