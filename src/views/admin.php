<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($usuario['nombre_usuario']); ?> (Administrador)</h1>
    <nav>
        <ul>
            <li><a href="#">Gestión de Usuarios</a></li>
            <li><a href="#">Gestión de Productos</a></li>
            <li><a href="#">Gestión de Ventas</a></li>
            <li><a href="#">Reportes</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</body>
</html>
