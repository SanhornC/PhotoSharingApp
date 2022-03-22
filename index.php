<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Sharing App</title>
    <link rel="stylesheet" type="text/CSS" href="index.css">
    <header>
        <nav>
            <ul class="nav_links">
                <li><a href="./lobby.html"> Home</a></li>
                <li><a href="./login.html">Log In</a></li>
            </ul>
        </nav>
    </header>
</head>

<body>
    <form action="./formHandlerSign.php" method="POST">
        <h1>Sign Up</h1>
        <input type="text" name="Username" placeholder="Username" required>
        <select name="gender" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>