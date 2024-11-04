<?php 
session_start(); 
chdir("../");
require 'helper.php';
$error = "";
$username = ""; 
$password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (checkUser($_POST['username'], $_POST['password'])) {
        $_SESSION['user'] = $_POST['username'];
        $users = loadUsers();
        $users[$_POST['username']]['last_login'] = date('Y-m-d H:i:s');
        saveUsers($users);
        header("Location: ../index.php");
        exit();
    } else {
        $error = 'Invalid username or password!';
        echo $error;
    } 
}  
function checkUser($username, $password){
    $users = loadUsers();
    if (isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
        return true;
    }
    return false;
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
                <h1><a href="../index.php">IK-Library</a> > Login</h1>
        </header> 
        <div class="content">
            <div class="form-container"><div class="screen"><div class="screen__content">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">    
                    <div class="log">
                    <div class="login__field">
                    <input class="login__input" type="text" name="username" value="<?php echo $username;?>" placeholder="Username" required>  
                    </div>
                    <div class="login__field">
                    <input class="login__input" type="password" name="password",value="<?php echo $password?>"placeholder="Password" required>
                    </div>
                    <div>
                    <input class = "submit__button" type="submit" name="submit" value="Login ">    
                    </div>
                    </div>
                </form>  
                </div></div>
        </div>
        </div>
    </body>  
</html>  