<?php
session_start();
chdir("../");
require 'helper.php';
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}
$user = loadUsers()[$_SESSION['user']];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['user'] ?> | IK-Library</title>
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body>
    <header>
        <h1><a href="../index.php">IK-Library</a> > <?= $_SESSION['user'] ?></h1>
    </header>
    <div id="content">
        <h1><?= $_SESSION['user'] ?></h1>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
        <p><strong>Last_Login:</strong> <?= $user['last_login'] ?></p>
        <p><strong>isAdmin:</strong> <?= $user['is_admin'] ?></p>
        
    </div>
    <footer>
        <p>IK-Library | ELTE IK Webprogramming</p>
    </footer>
</body>
</html>
