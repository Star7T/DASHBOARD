<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];

// Redirigir según el rol
if ($usuario['rol'] === 'administrador') {
    header("Location: admin.php");
    exit();
} elseif ($usuario['rol'] === 'vendedor') {
    header("Location: trabajador.php");
    exit();
} else {
    echo "Rol desconocido. Contacte con el administrador.";
    exit();
}
