<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<p><a href="logout.php">Logout</a></p>
</body>
</html>
