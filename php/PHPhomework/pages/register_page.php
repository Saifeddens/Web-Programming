<?php 
session_start(); 
chdir("../");
require 'helper.php';
$username = ""; 
$email = "";  
$password = "";
$passwordConfirm = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(checkNewUser($_POST["username"])){
        registerUser($_POST["username"],$_POST["email"],$_POST["password"]);
        header(("Location: ../index.php"));
        exit();
    }
}  
function registerUser($username, $email, $password) {
    $users = loadUsers();
    debug_to_console($username);
    $users[$username] = [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'last_login' => date('Y-m-d H:i:s'),
        'is_admin' => false
    ];
    saveUsers($users);
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
                <h1><a href="../index.php">IK-Library</a> > Register</h1>
        </header> 
        <div class="content">
            <div class="form-container"><div class="screen"><div class="screen__content">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">    
                    <div class="log">
                    <div class="login__field">
                    <input class="login__input" type="text" name="username" value="<?php echo $username;?>" placeholder="Username">  
                    </div>
                    <div class="login__field">
                    <input class="login__input" type="text" name="email" value="<?php echo $email;?>" placeholder="Email">  
                    </div>
                    <div class="login__field">
                    <input class="login__input" type="password" name="password",value="<?php echo $password?>"placeholder="Password">
                    </div>
                    <div class="login__field">
                    <input class="login__input" type="password" name="password_confirm",value="<?php echo $passwordConfirm?>"placeholder="Confirm Password">
                    </div>
                    <div>
                    <input class = "submit__button" type="submit" name="submit" value="Register ">    
                    </div>
                    </div>
                </form>  
                </div></div>
        </div>
        </div>
    </body>  
</html>  