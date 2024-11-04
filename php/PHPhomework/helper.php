<?php
function loadBooks() {
    $json = file_get_contents('assets/data/books.json');
    if (json_decode($json) === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON format in books.json');
    }
    return json_decode($json, true);
}
function loadBook($id) {
    $books = loadBooks();
    return isset($books[$id]) ? $books[$id] : null;
}
function isAdmin($something){
    return True;
}
function loadUsers() {
    $json = file_get_contents('assets/data/user_database.json');
    return json_decode($json, true);
}

function saveUsers($users) {
    $json = json_encode($users, JSON_PRETTY_PRINT);
    return file_put_contents('assets/data/user_database.json', $json);
}
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
function checkNewUser($username){
    $users = loadUsers();
    if (isset($users[$username])) {
        return "wrong";
    }
    return true;
}
function logout(){
    session_start();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>