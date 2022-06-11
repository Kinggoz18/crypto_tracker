<?php
    include_once('./Includes/library.php');
    $conn = connectDB(); //Connect to the database
?>
<header>
    <div>
        <h1>CRYPTO TRACKER</h1>
    </div>
    <nav id="dynamic_navbar">
        <ul>
            <li id="nav-home"><a class="nav-div" href="./index.php"><i class="fa-solid fa-house-user"></i>Home</a></li>
            <li id="nav-news"><a class="nav-div" href="./news.php"><i class="fa-solid fa-newspaper"></i>News</a></li>
            <li id="nav-account"><a class="nav-div" href="./account.php"><i class="fa-solid fa-street-view"></i>Account</a></li>
            <li id="nav-logout"><a class="nav-div" href="./login.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a></li>
        </ul>
    </nav>
    <div id="mobile_nav">
        <div id="mobile_icon"><i class="fa-solid fa-bars"></i></div>
    </div>
</header>
<nav class="mobile_list">
    <ul>
        <li id="mobile_nav-home"><a class="nav-div" href="./index.php">Home</a></li>
        <li id="mobile_nav-news"><a class="nav-div" href="./news.php">News</a></li>
        <li id="mobile_nav-account"><a class="nav-div" href="./account.php">Account</a></li>
        <li id="mobile_nav-logout"><a class="nav-div" href="./login.php">Logout</a></li>
    </ul>
</nav>