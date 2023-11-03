<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location:login.php");
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>Welcome To my Site </div>
    <?php
        if(isset($_SESSION['email'])) {
        echo "<a href='logout.php'>Logout</a>";
    }
    ?>
</body>
</html>