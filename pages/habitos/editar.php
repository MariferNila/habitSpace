<?php
    session_start();

    include '../../includes/conexion.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM habitos
    WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    $habito = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_POST){
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $frecuencia = $_POST['frecuencia'];
        $meta = $_POST['meta'];

        $sqlUpdate = "UPDATE habitos SET

        titulo = :titulo,
        descripcion = :descripcion,
        frecuencia = :frecuencia,
        meta = :meta
        WHERE id = :id";

        $stmtUpdate = $conn->prepare($sqlUpdate);

        $stmtUpdate->bindParam(':titulo', $titulo);
        $stmtUpdate->bindParam(':descripcion', $descripcion);
        $stmtUpdate->bindParam(':frecuencia', $frecuencia);
        $stmtUpdate->bindParam(':meta', $meta);
        $stmtUpdate->bindParam(':id', $id);

        $stmtUpdate->execute();

        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Hábito | HabitSpace</title>
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
                    Editar Hábito 
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
                            value="<?php echo $habito['titulo']; ?>"
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
                        ><?php echo $habito['descripcion']; ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Frecuencia
                        </label>

                        <input
                            type="text"
                            name="frecuencia"
                            class="form-control"
                            value="<?php echo $habito['frecuencia']; ?>"
                            placeholder="Ejemplo: diario, lunes a viernes..."
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
                            value="<?php echo $habito['meta']; ?>"
                            placeholder="Ejemplo: 30 minutos diarios"
                        >
                    </div>

                    <button class="btn btn-primary">
                        Actualizar hábito
                    </button>

                </form>

            </div>

        </div>
        <?php include '../../includes/footer.php'; ?>
    </body>

</html>