<?php   
    //START NEW SESSION
    session_start();
    session_destroy();
    session_start();
    include_once("./Includes/library.php");
    $login_username = $_POST['login-username'] ?? NULL;
    $login_password = $_POST['login-password'] ?? NULL;
    $signup_password = $_POST['signup-password'] ?? NULL;
    $signup_username= $_POST['signup-username'] ?? NULL;
    $conn = connectDB();
    $loginErr;
    $signupErr;
    if(isset($_POST['login'])) //IF LOGIN IN WAS CLICKED< VALIDATE THEN REDIRECT
    {
        if(isset($login_username) && strlen(($login_username))!=0)
        {
            if(loginDB($conn, $login_username, $login_password))
            {
                $_SESSION['username']=$login_username;
                header('Location: ./index.php');
            }
            else{
                $loginErr = true;
            }
        }
    }
    else if(isset($_POST['signup']))    //IF SIGN UP IN WAS CLICKED VALIDATE THEN REDIRECT
    {
        if(isset($signup_username) && strlen(($signup_username))!=0 && isset($signup_password) && strlen(($signup_password))!=0 )
        {
            if(signupDB($conn, $signup_username, $signup_password))
            {
                $_SESSION['username']=$signup_username;
                header('Location: ./index.php');
            }
            else{
                $signupErr = true;
            }
        }
        else{
            $signupErr = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--SCRIPT LINKS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer type="module" src="javascript/master.js"></script>
    <script defer type="module" src="javascript/login.js"></script>
    <!--FONT AWESOME LINK-->
    <script src="https://kit.fontawesome.com/e4c6fd0b9b.js" crossorigin="anonymous"></script>
    <!--STYLESHEET LINKS-->
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/login.css">
    <title>Cryptocurrency Tracker - Login</title>
</head>
<body>
    <?Php include'./Includes/header.php' ?>
    <main>
        <h1>LOGIN IN OR SIGN UP NOW</h1>
        <section class="login-section">
            <form class="login-box" method="post">
                <div class="login-icon">
                    <i class="fa-solid fa-circle-dollar-to-slot"></i>
                </div>
                <div class="login-name">
                    <input type="text" name="login-username" id="login-username" placeholder="username">
                </div>
                <div class="login-password">
                    <input type="password" name="login-password" id="login-password" placeholder="password">
                </div>
                <span class="error <?=!isset($loginErr) ? 'hidden' : "";?>">Please enter correct login credentials!</span>
                <div class="btn-options">
                    <button name="login" value="submit" id="login-btn">Login</button>
                    <button type="button" class="swicth-signup" name="create-account">Create Account</button>
                </div>
            </form>
        </section>
        <section class="signup-section hidden">
            <form class="signup-box" method="post">
                <div class="login-icon">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div class="login-name">
                    <input type="text" name="signup-username" id="signup-username" placeholder="Enter a username">
                </div>
                <div class="login-password">
                    <input type="password" name="signup-password" id="signup-password" placeholder="Enter a password">
                </div>
                <span id ="signup-error" class="error <?=!isset($signupErr) ? 'hidden' : "";?>">Please enter an available username!</span>
                <div class="btn-options">
                    <button type="button" class="swicth-login" id="login-btn" name="s-login">Login</button>
                    <button name="signup" value="submit" id="createAcc" >Create Account</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>