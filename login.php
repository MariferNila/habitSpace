<?php
    session_start();

    include 'includes/conexion.php';
    $mensaje = "";
    $tipo = "";

    if($_POST){
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE correo = :correo";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':correo', $correo);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario){
            if(password_verify($password, $usuario['password'])){
                $_SESSION['usuario'] = $usuario['nombre'];
                $_SESSION['rol'] = $usuario['rol'];
                $_SESSION['id_usuario'] = $usuario['id'];
                header("Location: pages/home/index.php");
            } else {
                $mensaje = "Contraseña incorrecta";
                $tipo = "danger";
            }
        } else {
            $mensaje = "Usuario no encontrado";
            $tipo = "danger";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión | HabitSpace</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/estilos.css">
    </head>

    <body>
        <div class="auth-container">
            <div class="auth-card">
                <a href="index.php" class="back-link">
                    ← Volver al inicio
                </a>

                <h1 class="auth-title">
                    Iniciar Sesión
                </h1>

                <?php if($mensaje != ""): ?>
                    <div class="alert alert-<?php echo $tipo; ?>">

                        <?php echo $mensaje; ?>

                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="correo"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required
                        >
                    </div>

                    <button class="btn btn-primary w-100">
                        Iniciar sesión
                    </button>
                </form>

            </div>
        </div>
        <?php include 'includes/footer.php'; ?>  
    </body>

</html>