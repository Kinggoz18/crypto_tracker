<?php
    session_start();
    //IF THE SESSION USER NAME IS NOT SET REDIRECT TO  THE LOGIN PAGE
    if(!isset($_SESSION['username']))
    {
        header('Location: ./login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--SCRIPT LINKS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer type="module" src="javascript/master.js"></script>
    
    <!--FONT AWESOME LINK-->
    <script src="https://kit.fontawesome.com/e4c6fd0b9b.js" crossorigin="anonymous"></script>
    <!--STYLESHEET LINKS-->
    <link rel="stylesheet" href="Styles/home.css"/>
    <link rel="stylesheet" href="Styles/navbar.css"/>

    <title>Cryptocurrency Tracker</title>
</head>
<body>
    <!--Dyncamic nav bar included in index-->
    <?php include'Includes/header.php'; ?>
    <main>
        <h2 class="h2-track">Start tracking now</h2>
        <form id="home_form">
            <div class="homesearch">
                <input type="text" name="searchbox" id="searchbox" placeholder="Start tracking your crypto now">
                <button id="searchbutton" name="submit" type="button">FIND</button>
            </div>
        </form>
        <h3>Note: Only Coins and tokens listed on the crypto.com exchnage can be tracked.</br> 
            IMPORTANT: Please add the “Allow Cors” extension from your browsers web store to prevent any Cross-Origin errors and allow for the site the work properly.</h3>
        <div class="result hidden">
        </div>
        <div class="date"></div>
        <div class="topcoin_container">
            <div class="topcoin_box-1"></div>
            <div class="topcoin_box-2"></div>
            <div class="topcoin_box-3"></div>
            <div class="topcoin_box-4"></div>
        </div>
    </main>
    <?php include 'Includes/footer.php'; ?>
</body>
</html>