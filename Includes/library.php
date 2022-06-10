<?php
    //Function to connect to mongoDB database

    //function to connect to the database
    function connectDB()
    {
        $serverName = "LAPTOP-F4NIPHRU";
        $connectionOptions = array("Database"=>"master",
            "Uid"=>"chigoziemuonagolu", "PWD"=>"raphael2002");
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if($conn == false)
            {
                echo "failed to connect";
                die(FormatErrors(sqlsrv_errors()));
            }
        return $conn;
    }
    //Search function to get all the crypto's in a users list
    function searchDB($conn, $username)
    {
        $query ="SELECT coinName FROM userCoins WHERE username = '{$username}'";
        $stmt = sqlsrv_query($conn, $query);
        $result = array();
        $i =0;
        while( $obj = sqlsrv_fetch_object( $stmt )) 
        {
            $result[$i]=$obj->coinName;
            $i+=1;
        }
        return $result;           //Return an array of results
    }
    //function to handle login returns true is successful, false if failed
    function loginDB($conn, $username, $password)
    {
        $query = "SELECT * FROM Users where username='{$username}'";   //Query the database for the matching username
        $stmt = sqlsrv_query($conn, $query);
        if($stmt)  
        {
            $rows = sqlsrv_has_rows( $stmt );
            if( $rows == false)     //IF no row was found with the matching username return false
            {
                return false;
            }
            else
            {
                while( $row = sqlsrv_fetch_object( $stmt )) 
                {
                    $username=$row->username;
                    $userpass=$row->userpass;
                }
                $encryptedPass = hash('sha512', $password, true);     //Encrypt the input password
                if(hash_equals($userpass, $encryptedPass)) //Then compare to the password in the db
                {
                    return true;
                }
                else{
                    return false;
                }
            }
        }
    }
    //Function to add users to the database
    function signupDB($conn, $username, $password)
    {
        $query = "SELECT username FROM Users";
        $stmt = sqlsrv_query($conn, $query);
        if($stmt)
        {
            while($obj = sqlsrv_fetch_object($stmt))
            {
                if(strcasecmp($username, $obj->username)==0)       //IF THE USER ALREADY EXISTS IN THE DATABASE
                {
                    return false;
                }
            }
        }
        //Query to insert into the database
        $insert = "INSERT INTO Users(username, userpass)
        VALUES('{$username}', HASHBYTES('SHA2_512', '{$password}'))";
        $results = sqlsrv_query($conn, $insert);
        return true;
    }
    //Function to add a coin to user database
    function addToDB($conn, $coinToAdd, $username)
    {
        //Check if the user already has the coin in their list
        $checkQuery = "SELECT * FROM UserCoins WHERE username = '{$username}' AND coinName = '{$coinToAdd}'";
        $stmt = sqlsrv_query($conn, $checkQuery);
        if($stmt)  
        {
            $rows = sqlsrv_has_rows( $stmt );
            if( $rows == false){        //If no rows were found 
                $query = "INSERT INTO userCoins(username, coinName) VALUES('{$username}','{$coinToAdd}')";
                $results = sqlsrv_query($conn, $query);
                if($results)
                {
                    return true;
                }
                else{
                    return false;
                }
            }
        }
        else{
            echo "USER ALREADY HAS COIN IN LIST";
            return false;
        }
    }
    //Function to delete coin from user database
    function deleteFromDB($conn, $coinToDelete, $username)
    {
        $query = "DELETE FROM userCoins WHERE username='{$username}' AND coinName='{$coinToDelete}'";
        $results = sqlsrv_query($conn, $query);
        if($results)
        {
            return true;
        }
        else{
            return false;
        }
    }
?>