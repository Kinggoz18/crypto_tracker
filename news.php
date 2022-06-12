<?php
    session_start();
    //IF THE SESSION USER NAME IS NOT SET REDIRECT TO  THE LOGIN PAGE
    if(!isset($_SESSION['username']))
    {
        header('Location: ./login.php');
    }
    header('Access-Control-Allow-Origin: *');
?>
<!--DISPLAY TOP 50 PERFORMING COINS HERE-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--SCRIPT LINKS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer type="module" src="javascript/master.js"></script>
    <script defer type="module" src="javascript/news.js"></script>
    <!--FONT AWESOME LINK-->
    <script src="https://kit.fontawesome.com/e4c6fd0b9b.js" crossorigin="anonymous"></script>
    <!--STYLESHEET LINKS-->
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/news.css">
    <title>Cryptocurrency Tracker - News</title>
</head>
<body>
    <!--Dyncamic nav bar included in index-->
    <?php include'Includes/header.php'; ?>
    <main>
        <h1>STAY UP TO DATE WITH OUR CRYPTO NEWS</h1>
        <section class="news_container">
        </section>
    </main>
    <?php include 'Includes/footer.php'; ?>
</body>
</html>