<?php
    $dbServerName = "us-cdbr-iron-east-01.cleardb.net";
    $dbUserName ="bdbc750bd92b62";
    $dbPassword = "ca049a5b";
    $dbName = "heroku_0ceb16f75c79f81";
    $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $connProduce = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
    if ($connProduce->connect_error) {
        die("Connection failed: " . $connProduce->connect_error);
    }

?>