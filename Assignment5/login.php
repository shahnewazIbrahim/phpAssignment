<!-- login.php -->
<?php
session_start();
// print_r( $_SESSION);
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header('Location: admin_dashboard.php');
    exit();
} elseif (isset($_SESSION['role']) && $_SESSION['role'] && $_SESSION['role'] === 'manager') {
    header('Location: manager_dashboard.php');
    exit();
}
//  else {
//     header('Location: user_dashboard.php');
//     exit();
// }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login Form</h2>
    <form action="login_process.php" method="POST">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <a href="register.php">Register</a>
</body>
</html>
