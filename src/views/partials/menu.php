<?php
if (!isset($_SESSION)) {
    session_start();
}

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
?>

<nav>
    <ul>
        <?php if ($usuario && $usuario['rol'] === 'admin'): ?>
            <li><a href="admin.php">Panel Admin</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="trabajador.php">Panel Vendedor</a></li>
        <?php elseif ($usuario && $usuario['rol'] === 'trabajador'): ?>
            <li><a href="trabajador.php">Panel Vendedor</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>
</nav>
