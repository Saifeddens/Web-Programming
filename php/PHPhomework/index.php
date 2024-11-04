<?php
session_start();
require 'helper.php';
$books = loadBooks();
$books = is_array($books) ? $books : [];
echo "".isset($_SESSION['user']);
echo "something";
function runMyFunction() {
    logout();
  }

if (isset($_GET['logout'])) {
    runMyFunction();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IK-Library | Home</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/cards.css">
</head>

<body>
    <header>
        <h1><a href="index.php">IK-Library</a> > Home</h1>
        <nav>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/pages/user_page.php"><?= ($_SESSION['user']) ?></a>
                <?php if (isAdmin($_SESSION['user'])): ?>
                    <a href="/pages/adding_page.php">Add Book</a>
                <?php endif; ?>
                <a href="index.php?logout=true">Logout</a>
            <?php else: ?>
                <a href="pages\login_page.php">Login</a>
                <a href="pages\register_page.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>

    <div id="content">
        <div id="card-list">
            <?php foreach ($books as $id => $book): ?>
                <div class="book-card">
                    <div class="image">
                        <img src="assets/images/<?= ($book['image']) ?>" alt="<?= ($book['title']) ?>">
                    </div>
                    <div class="details">
                        <h2><a href="pages/book_page.php?id=<?= $id ?>"><?= ($book['title']) ?></a></h2>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <footer>
        <p>IK-Library | ELTE IK Webprogramming</p>
    </footer>
</body>

</html>