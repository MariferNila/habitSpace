<?php
    session_start();

    include '../../includes/conexion.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM habitos
    WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    header("Location: index.php");

?>