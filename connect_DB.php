

<?php 
// mysql:host=localhost
// mysql://bdf329d56235af:9ed6df24@us-cdbr-east-05.cleardb.net/heroku_a97ede79aabb08e?reconnect=true
$username = 'bda0fa85881ff8';
$pass = 'c2f5db74';
$hostname = 'us-cdbr-east-05.cleardb.net';
$database = 'heroku_fd62410c1b90914';
try {
  $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $pass);
  //echo "Connected to database";
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>


