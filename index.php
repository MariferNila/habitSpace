<?php
    session_start();

    if(isset($_SESSION['usuario'])){
        header("Location: pages/home/index.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HabitSpace</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">
                    HabitSpace
                </a>

                <div>
                    <a href="login.php" class="btn btn-outline-light me-2">
                        Iniciar sesión
                    </a>
                </div>
            </div>
        </nav>

        <section class="container py-5">
            <div class="row align-items-center">
                
                <div class="col-md-6">
                    <h1 class="hero-title mb-4">
                        Crea un espacio para mejorar tus hábitos
                    </h1>

                    <p class="hero-text">
                        Gestiona tus actividades, crea hábitos positivos, sigue tu progreso y mejora cada día.
                    </p>

                    <a href="registro.php" class="btn btn-primary btn-lg mt-3">
                        Registrarse
                    </a>
                </div>

                <div class="col-md-6 text-center">
                    <img
                        src="https://habitslab.app/_next/image?url=%2Fimages%2Fblog%2Fgoal-tracking-app-vs-habit-tracker.png&w=1200&q=75"
                        class="img-fluid hero-image"
                        alt="HabitSpace"
                    >
                </div>

            </div>

        </section>
        <?php include 'includes/footer.php'; ?>
    </body>

</html>