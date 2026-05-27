<?php
    include 'includes/conexion.php';

    $mensaje = "";
    $tipo = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $passwordPlano = $_POST['password'];

        if (empty($nombre) || empty($correo) || empty($passwordPlano)) {
            $mensaje = "Todos los campos son obligatorios";
            $tipo = "danger";
        } else {
            $sqlCheck = "SELECT id FROM usuarios 
                        WHERE nombre = :nombre OR correo = :correo 
                        LIMIT 1";

            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bindParam(':nombre', $nombre);
            $stmtCheck->bindParam(':correo', $correo);
            $stmtCheck->execute();

            if ($stmtCheck->rowCount() > 0) {
                $mensaje = "El nombre de usuario o correo ya está registrado";
                $tipo = "danger";
            } else {
                $password = password_hash($passwordPlano, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuarios (nombre, correo, password)
                        VALUES (:nombre, :correo, :password)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':password', $password);

                if ($stmt->execute()) {
                    $mensaje = "Registro realizado correctamente";
                    $tipo = "success";
                    header("refresh:2;url=login.php");
                } else {
                    $mensaje = "Ocurrió un error al registrarse";
                    $tipo = "danger";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro | HabitSpace</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/estilos.css">
    </head>

    <body>

        <div class="auth-container">
            <div class="auth-card">
                <a href="index.php" class="back-link">
                    ← Volver al inicio
                </a>

                <h1 class="auth-title">Crear cuenta</h1>

                <?php if ($mensaje != ""): ?>
                    <div class="alert alert-<?php echo $tipo; ?>">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre de Usuario</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">
                        Registrarse
                    </button>

                </form>

            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>