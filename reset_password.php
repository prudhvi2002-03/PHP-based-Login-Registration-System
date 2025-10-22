<?php
session_start();
require 'db.php';

if(isset($_POST['reset'])){
    $email = $conn->real_escape_string($_POST['email']);
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($result->num_rows == 1){
        $token = bin2hex(random_bytes(50));
        $conn->query("UPDATE users SET reset_token='$token' WHERE email='$email'");
        $reset_link = "http://localhost/reset_password_form.php?token=$token";
        $success = "Password reset link: <a href='$reset_link'>$reset_link</a>";
    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h2>Reset Password</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<form method="post">
    Enter your email: <input type="email" name="email" required><br><br>
    <button type="submit" name="reset">Send Reset Link</button>
</form>
<p><a href="login.php">Back to Login</a></p>
</body>
</html>
