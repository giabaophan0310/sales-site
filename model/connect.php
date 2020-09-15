<?php

    function connect() {
        $severname = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$severname;dbname=nhanvan", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            //echo "Connect Successfully";
        } catch(PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }

?>