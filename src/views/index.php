<?php
session_start();
require_once __DIR__ . '/../controller/usuarioController.php';


$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $controller = new UsuarioController();
    $usuario = $controller->login($email, $password);

    if ($usuario) {
        $_SESSION["usuario"] = $usuario;

        // Redirigir según rol
        if ($usuario["rol"] === "administrador") {
            header("Location: admin.php");
        } else {
            header("Location: trabajador.php");
        }
        exit();
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema Tienda</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Correo:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
