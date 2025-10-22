<?php
session_start();
require 'db.php';

if(isset($_POST['register'])){
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email or username exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email' OR username='$username'");
    if($check->num_rows > 0){
        $error = "Username or Email already exists!";
    } else {
        $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
        $_SESSION['success'] = "Registration successful. Please login.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit" name="register">Sign Up</button>
</form>
<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
