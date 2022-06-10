<?php
    session_start();
    require('./Includes/library.php');
    var_dump($_GET);
    $username = $_SESSION['username'];
    $coin = $_GET['coin'] ?? null;
    $func = $_GET['func'] ?? null;
    $conn = connectDB();
    //If adding
    if(strcmp($func, 'add')==0)
    {
        if($coin!=null)
        {
            $flag=addToDB($conn, $coin, $username);
            if($flag)
            {
                echo "Added to user list";
            }
            else{
                echo "Something went wrong when adding";
            }
        }
    }
    else if(strcmp($func, 'remove')==0) //If removing
    {
        if($coin!=null)
        {
            $flag=deleteFromDB($conn, $coin, $username);
            if($flag)
            {
                echo "removed from user list";
            }
            else{
                echo "Something went wrong when removing";
            }
        }
    }
    exit();
?>