<?php
session_start();
chdir("../");
require 'helper.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$bookId = $_GET['id'];
$book = loadBook($bookId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($book['title']) ?> | IK-Library</title>
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body>
    <header>
        <h1><a href="../index.php">IK-Library</a> > <?= $book['title'] ?></h1>
    </header>
    <div id="content">
        <h1><?= htmlspecialchars($book['title']) ?></h1>
        <p><strong>Author:</strong> <?= $book['author'] ?></p>
        <p><strong>Year:</strong> <?= htmlspecialchars($book['year']) ?></p>
        <p><strong>Planet:</strong> <?= htmlspecialchars($book['planet']) ?></p>
        <p><?= htmlspecialchars($book['description']) ?></p>
        <div class="image">
            <img src="../assets/images/<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">
        </div>
    </div>
    <footer>
        <p>IK-Library | ELTE IK Webprogramming</p>
    </footer>
</body>
</html>
