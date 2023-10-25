<!-- register_process.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    
    $userData = "$username|$email|$password\n";
    
    // Append user data to a text file (e.g., users.txt)
    file_put_contents("users.txt", $userData, FILE_APPEND);
    
    // Redirect to the login page
    header("Location: login.php");
    exit();
}
?>
