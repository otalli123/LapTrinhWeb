<?php

    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "dangkylichkhamchuabenh";

    try
    {
        $db = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUsername, $dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEXCEPTION $e)
    {
        echo $e->getMessage();
    }

?>