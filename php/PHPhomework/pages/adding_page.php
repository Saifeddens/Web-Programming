<?php 
session_start(); 
chdir("../");
require 'helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    debug_to_console("something should not be working");
    addBooks($_POST['title'],$_POST['author'],$_POST['description'],$_POST['year'],$_FILES['image'],$_POST['planet']);
}  
function addBooks($title,$author,$description,$year,$image,$planet){
    $books = loadBooks();
    move_uploaded_file($_FILES['image']['tmp_name'],"assets/images/book_cover_".(sizeof($books)+1).'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $books["book".(sizeof($books))] = [
        'title' => $title,
        'author' => $author,
        'description' =>$description,
        'year' => $year,
        'image' => "book_cover_".(sizeof($books)+1).'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION),
        'planet' =>$planet
    ];
    saveBooks($books);
}
function saveBooks($books) {
    $json = json_encode($books, JSON_PRETTY_PRINT);
    file_put_contents('assets/data/books.json', $json);
}
?>
<!DOCTYPE html>  
<html lang="en">  
<head>  
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | IK-Library</title>
    <link rel="stylesheet" href="../styles/main.css">
</head>  
    <body>    
        <header>
                <h1><a href="../index.php">IK-Library</a> > Adding Book</h1>
        </header> 
        <div class="content">
            <div class="form-container"><div class="screen"><div class="screen__content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                    <div class="login__field">
                        <input class = "login__input" type="text" id="title" name="title" placeholder="title" required>
                    </div>
                    <div class="login__field">
                        <input class = "login__input" type="text" id="author" name="author" placeholder="author" required>
                    </div>
                    <div class="login__field">
                        <input class = "login__input" type="number" id="year" name="year" placeholder="Year"  required>
                    </div>
                    <div class="login__field">
                        <textarea class = "login__input" id="description" name="description" placeholder="description"></textarea>
                    </div>
                    <div class="login__field">
                        <input  type="file" id="image" name="image" accept="image/*">                
                    </div>
                    <div class="login__field">
                        <input class = "login__input" type="text" id="planet" name="planet" placeholder="Planet" >
                    </div>
                
                <input class = "submit__button" type="submit" name = "submit" value = "Add">
            </form> 
                </div>
            </div>
        </div>
        </div>
    </body>  
</html>  