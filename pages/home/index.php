<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        header("Location: ../../login.php");
        exit;
    }

    include '../../includes/conexion.php';

    $id_usuario = $_SESSION['id_usuario'];

    // TOTAL HABITOS
    $sqlTotal = "SELECT COUNT(*) as total FROM habitos WHERE usuario_id = :usuario_id";
    $stmtTotal = $conn->prepare($sqlTotal);
    $stmtTotal->bindParam(':usuario_id', $id_usuario);
    $stmtTotal->execute();
    $total = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

    // COMPLETADOS
    $sqlCompletados = "SELECT COUNT(*) as completados 
    FROM habitos 
    WHERE usuario_id = :usuario_id AND completado = 1";

    $stmtComp = $conn->prepare($sqlCompletados);
    $stmtComp->bindParam(':usuario_id', $id_usuario);
    $stmtComp->execute();
    $completados = $stmtComp->fetch(PDO::FETCH_ASSOC)['completados'];

    $pendientes = $total - $completados;

    $porcentaje = ($total > 0) ? ($completados / $total) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard | HabitSpace</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/css/estilos.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body>

        <?php include '../../includes/menu.php'; ?>

        <div class="container py-5">

            <div class="text-center mb-5">
                <h1 class="fw-bold">
                    Hola, <?php echo $_SESSION['usuario']; ?> 
                </h1>
                <p class="text-muted">
                    Continúa construyendo mejores hábitos cada día.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-4">
                        <h6>Total hábitos</h6>
                        <h2 class="fw-bold"><?php echo $total; ?></h2>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-4">
                        <h6>Completados</h6>
                        <h2 class="fw-bold text-success"><?php echo $completados; ?></h2>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 text-center p-4">
                        <h6>Pendientes</h6>
                        <h2 class="fw-bold text-warning"><?php echo $pendientes; ?></h2>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 mt-4 p-4">
                <h5 class="mb-3">Tu progreso</h5>

                <div class="progress">
                    <div class="progress-bar"
                        style="width: <?php echo $porcentaje; ?>%">
                        <?php echo round($porcentaje); ?>%
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 mt-4 p-4">
                <h5 class="mb-4">Resumen visual</h5>

                <canvas id="grafica" height="120"></canvas>
            </div>

        </div>

        <script>
            const ctx = document.getElementById('grafica');

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Completados', 'Pendientes'],
                        datasets: [{
                            data: [
                                <?php echo $completados; ?>,
                                <?php echo $pendientes; ?>
                            ],
                            backgroundColor: [
                                '#B6CFE4',
                                '#FFF1B5'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 4,
                            hoverOffset: 12
                        }]
                    },
                    options: {
                        responsive: true,
                        cutout: '70%',

                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 14
                                    }
                                }
                            },

                            tooltip: {
                                backgroundColor: '#222',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 12
                            }
                        },

                        animation: {
                            animateRotate: true,
                            duration: 1500,
                            easing: 'easeOutQuart'
                        }
                    }
                });
        </script>
        <?php include '../../includes/footer.php'; ?>
    </body>
</html>