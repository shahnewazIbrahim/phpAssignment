<!-- login_process.php -->
<?php
// echo$_SERVER["REQUEST_METHOD"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['password'] = $_POST["password"];
    header("Location:index.php");
}
?>
