<?php
    session_start();

    include '../../includes/conexion.php';

    if($_POST){
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $frecuencia = $_POST['frecuencia'];
        $meta = $_POST['meta'];

        $usuario_id = $_SESSION['id_usuario'];

        $sql = "INSERT INTO habitos
        (usuario_id, titulo, descripcion, frecuencia, meta, fecha)
        VALUES
        (:usuario_id, :titulo, :descripcion, :frecuencia, :meta, NOW())";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':frecuencia', $frecuencia);
        $stmt->bindParam(':meta', $meta);

        if($stmt->execute()){

            header("Location: index.php");

        }
    }   

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nuevo Hábito | HabitSpace</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/css/estilos.css">
    </head>

    <body>
        <?php include '../../includes/menu.php'; ?>

        <div class="container py-5">
            <div class="mb-4">
                <a href="index.php" class="back-link">
                    ← Volver a hábitos
                </a>
            </div>

            <div class="dashboard-card form-card">
                <h1 class="dashboard-title mb-2">
                    Nuevo Hábito 
                </h1>

                <form method="POST">
                    <div class="mb-4">
                        <label class="form-label">
                            Título
                        </label>

                        <input
                            type="text"
                            name="titulo"
                            class="form-control"
                            placeholder="Ejemplo: Leer, cocinar, ejercicio"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            class="form-control"
                            rows="4"
                            placeholder="Describe tu hábito..."
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Frecuencia
                        </label>

                        <input
                            type="text"
                            name="frecuencia"
                            class="form-control"
                            placeholder="Ejemplo: diario, semanal, personalizada"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Meta
                        </label>

                        <input
                            type="text"
                            name="meta"
                            class="form-control"
                            placeholder="Ejemplo: 30 minutos diarios"
                        >
                    </div>

                    <button class="btn btn-primary">
                        Guardar
                    </button>

                </form>

            </div>

        </div>
        <?php include '../../includes/footer.php'; ?>
    </body>
</html>