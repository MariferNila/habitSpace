<?php
    session_start();

    include '../../includes/conexion.php';

    $id = $_GET['id'];

    $sql = "UPDATE habitos
    SET completado = 1,
    ultima_fecha = CURDATE(),
    dias_completados = dias_completados + 1
    WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    header("Location: index.php");

?>