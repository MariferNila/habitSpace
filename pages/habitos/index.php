<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        header("Location: ../../login.php");
    }

    include '../../includes/conexion.php';

    $id_usuario = $_SESSION['id_usuario'];

    $sqlReset = "UPDATE habitos
    SET completado = 0
    WHERE ultima_fecha IS NULL
    OR ultima_fecha < CURDATE()";

    $conn->query($sqlReset);

    $sql = "SELECT * FROM habitos
    WHERE usuario_id = :usuario_id
    ORDER BY id DESC";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':usuario_id', $id_usuario);

    $stmt->execute();

    $habitos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mis Hábitos | HabitSpace</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/css/estilos.css">
    </head>

    <body>
        <?php include '../../includes/menu.php'; ?>

        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="dashboard-title">
                        Mis Hábitos
                    </h1>
                </div>

                <a href="crear.php" class="btn btn-primary">
                    + Nuevo hábito
                </a>
            </div>

            <div class="dashboard-card">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="custom-table">
                            <tr>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Frecuencia</th>
                                <th>Meta</th>
                                <th>Estado</th>
                                <th>Progreso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($habitos as $habito): ?>
                            <tr>
                               <td class="fw-semibold">
                                    <?php echo $habito['titulo']; ?>
                                </td>
                                <td>
                                    <?php echo $habito['descripcion']; ?>
                                </td>

                                <td>
                                    <?php echo ucfirst($habito['frecuencia']); ?>
                                </td>

                                <td>
                                    <?php echo $habito['meta']; ?>
                                </td>

                                <td>
                                    <?php if($habito['completado']): ?>
                                        <span class="custom-badge success-badge">
                                            Completado
                                        </span>
                                    <?php else: ?>
                                        <span class="custom-badge pending-badge">
                                            Pendiente
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                     <?php echo $habito['dias_completados']; ?> días
                                </td>

                                <td class="d-flex gap-2 flex-wrap">
                                    <?php if(!$habito['completado']): ?>
                                        <a
                                            href="completar.php?id=<?php echo $habito['id']; ?>"
                                            class="btn btn-success btn-sm"
                                        >
                                            Completar
                                        </a>
                                    <?php endif; ?>

                                    <a
                                        href="editar.php?id=<?php echo $habito['id']; ?>"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Editar
                                    </a>

                                    <a
                                        href="eliminar.php?id=<?php echo $habito['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar hábito?')"
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
        <?php include '../../includes/footer.php'; ?>  
    </body>

</html>