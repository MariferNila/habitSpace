<?php

    $host = "localhost";
    $user = "your_user";
    $password = "your_password";
    $database = "habitspace";

    try {

        $conn = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $user,
            $password
        );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {

        die("Error de conexion: " . $e->getMessage());

    }
?>