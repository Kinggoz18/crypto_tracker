<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header('Location: ./login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--SCRIPT LINKS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module" src="javascript/master.js"></script>
    <script defer type="module" src="javascript/account.js"></script>

    <!--FONT AWESOME LINK-->
    <script src="https://kit.fontawesome.com/e4c6fd0b9b.js" crossorigin="anonymous"></script>

    <!--STYLESHEET LINKS-->
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/account.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="javascript/master.js"></script>
    <link rel="stylesheet" href="Styles/master.css">
    <title>Cryptocurrency Tracker - Account</title>
</head>
<body>
    <!--Dyncamic nav bar included in index-->
    <?php include'Includes/header.php'; ?>
    <main>
    <?php echo "<h1 class=account_h>{$_SESSION['username']} Portfolio</h1>";?>
        <section>
            <ul class="crypto_list">
                <?php
                    $username = $_SESSION["username"];
                    $usersCoins = searchDB($conn, $username);
                    if(count($usersCoins) > 0)
                    {
                        foreach($usersCoins as $coin)
                        {
                            echo "<li><div id=coin_item>{$coin}</div> <div></div><div id=coinChange></div> <div id=remove><button class=remove_coin type=button>Remove</button></div></li>";
                        }
                    }
                ?>
            </ul>
        </section>
    </main>
    <?php include 'Includes/footer.php'; ?>
</body>
</html>