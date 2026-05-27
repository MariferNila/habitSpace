<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        header("Location: ../../login.php");
    }

    if($_SESSION['rol'] != 'admin'){
        die("Acceso denegado");
    }

    include '../../includes/conexion.php';

    $sql = "SELECT * FROM usuarios ORDER BY id DESC";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Usuarios</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/css/estilos.css">
    </head>

    <body class="bg-light">
        <?php include '../../includes/menu.php'; ?>

        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-header">
                    <h3>Usuarios Registrados</h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($usuarios as $usuario): ?>
                            <tr>
                                <td>
                                    <?php echo $usuario['id']; ?>
                                </td>

                                <td>
                                    <?php echo $usuario['nombre']; ?>
                                </td>

                                <td>
                                    <?php echo $usuario['correo']; ?>
                                </td>

                                <td>
                                    <?php if($usuario['rol'] == 'admin'): ?>

                                        <span class="badge bg-danger">
                                            Admin
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-primary">
                                            Usuario
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a
                                        href="eliminar.php?id=<?php echo $usuario['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                    >
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>