<?php
    define("SERVER", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DB", "gun");
    $conn = new mysqli(SERVER, USER, PASS, DB);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    
