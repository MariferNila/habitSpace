<?php
    session_start();

    if($_SESSION['rol'] != 'admin'){
        die("Acceso denegado");
    }

    include '../../includes/conexion.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios
    WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    header("Location: index.php");

?>