<?php
session_start();
require 'db.php';

if(!isset($_GET['token'])){
    die("Invalid request");
}

$token = $_GET['token'];

if(isset($_POST['update'])){
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $conn->query("UPDATE users SET password='$password', reset_token=NULL WHERE reset_token='$token'");
    $_SESSION['success'] = "Password updated successfully. Please login.";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Set New Password</title>
</head>
<body>
<h2>Set New Password</h2>
<form method="post">
    New Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="update">Update Password</button>
</form>
</body>
</html>
