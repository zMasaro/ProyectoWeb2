<?php
require_once __DIR__ . '/includes/auth.php';

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($usuario === '' || $password === '') {
        $error = 'Usuario y contraseña requeridos';
    } else {
        if (!auth_login($usuario, $password)) {
            $error = 'Credenciales inválidas';
        } else {
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Ingresar</title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>
    <header class="header">
        <div class="header-left">
            <h1>Acceso</h1>
        </div>
    </header>
    <main class="auth-main">
        <section class="auth-box" aria-labelledby="login-title">
            <h2 id="login-title">Iniciar Sesión</h2>
            <?php if ($error): ?>
                <p class="mensaje-error" role="alert"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="post" novalidate>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" required autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                </div>
                <div class="form-group button-container">
                    <button type="submit" class="btn-enviar">Ingresar</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>