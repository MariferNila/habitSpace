<nav class="navbar navbar-expand-lg">

    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            HabitSpace
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../home/index.php">
                        Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../habitos/index.php">
                        Hábitos
                    </a>
                </li>

                <?php if($_SESSION['rol'] == 'admin'): ?>

                <li class="nav-item">
                    <a class="nav-link" href="../usuarios/index.php">
                        Usuarios
                    </a>
                </li>

                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="../../logout.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>