 <?php
$hostname     = "localhost:3306"; // enter your hostname
$username     = "root";  // enter your table username
$password     = '$XkGeyt93y';   // enter your password
$databasename = "gdu";  // enter your database
// Create connection 
$conn = new mysqli($hostname, $username, $password,$databasename);
 // Check connection 
if ($conn->connect_error) { 
die("Unable to Connect database: " . $conn->connect_error);
 }
?>