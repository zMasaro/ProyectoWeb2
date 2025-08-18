<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

$mensaje = '';
$userId = current_user_id();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Admin puede cambiar password de cualquiera si se pasa id opcional
    if (is_admin() && isset($_POST['cambiar_password']) && !empty($_POST['nuevo_password']) && isset($_POST['id_usuario'])) {
        $targetId = (int)$_POST['id_usuario'];
        $hash = password_hash($_POST['nuevo_password'], PASSWORD_BCRYPT, ['cost' => 10]);
        if ($stmt = mysqli_prepare($conexion, 'UPDATE usuario SET contrasennia=? WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, 'si', $hash, $targetId);
            mysqli_stmt_execute($stmt);
            $mensaje = 'Contraseña actualizada';
        }
    } elseif (isset($_POST['actualizar_datos'])) {
        $nombre = trim($_POST['nombre'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $usuario = trim($_POST['usuario'] ?? '');
        if ($nombre && $telefono && $correo && $usuario) {
            if ($stmt = mysqli_prepare($conexion, 'UPDATE usuario SET nombre=?, telefono=?, correo=?, usuario=? WHERE id=?')) {
                mysqli_stmt_bind_param($stmt, 'ssssi', $nombre, $telefono, $correo, $usuario, $userId);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['user']['usuario'] = $usuario;
                    $_SESSION['user']['nombre'] = $nombre;
                    $mensaje = 'Datos actualizados';
                }
            }
        } else {
            $mensaje = 'Complete todos los campos';
        }
    }
}

$datos = [];
if ($stmt = mysqli_prepare($conexion, 'SELECT id, nombre, telefono, correo, usuario FROM usuario WHERE id=?')) {
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $datos = mysqli_fetch_assoc($res) ?: [];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <header class="header">
        <div class="header-left">
            <h1>Perfil</h1>
        </div>
        <div class="header-right">
            <nav>
                <a href="../index.php">Inicio</a> |
                <a href="mis_propiedades.php">Mis Propiedades</a> |
                <?php if (is_admin()): ?><a href="usuarios.php">Usuarios</a> | <a href="administrar.php">Administrar</a> |<?php endif; ?>
                    <a href="../logout.php">Salir</a>
            </nav>
        </div>
    </header>
    <main class="perfil-main">
        <?php if ($mensaje): ?><p class="mensaje-info"><?php echo htmlspecialchars($mensaje); ?></p><?php endif; ?>
        <section class="perfil-datos" aria-labelledby="perfil-datos-titulo">
            <h2 id="perfil-datos-titulo">Mis Datos</h2>
            <form method="post">
                <input type="hidden" name="actualizar_datos" value="1">
                <div class="form-group"><label for="nombre">Nombre</label><input id="nombre" name="nombre" value="<?php echo htmlspecialchars($datos['nombre'] ?? ''); ?>" required></div>
                <div class="form-group"><label for="telefono">Teléfono</label><input id="telefono" name="telefono" value="<?php echo htmlspecialchars($datos['telefono'] ?? ''); ?>" required></div>
                <div class="form-group"><label for="correo">Correo</label><input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($datos['correo'] ?? ''); ?>" required></div>
                <div class="form-group"><label for="usuario">Usuario</label><input id="usuario" name="usuario" value="<?php echo htmlspecialchars($datos['usuario'] ?? ''); ?>" required></div>
                <div class="form-group button-container"><button type="submit" class="btn-enviar">Guardar</button></div>
            </form>
        </section>
        <?php if (is_admin()): ?>
            <section class="perfil-password" aria-labelledby="perfil-password-titulo">
                <h2 id="perfil-password-titulo">Cambiar Contraseña (Admin)</h2>
                <form method="post">
                    <input type="hidden" name="cambiar_password" value="1">
                    <div class="form-group"><label for="id_usuario">Usuario ID</label><input type="number" id="id_usuario" name="id_usuario" required></div>
                    <div class="form-group"><label for="nuevo_password">Nueva Contraseña</label><input type="password" id="nuevo_password" name="nuevo_password" required></div>
                    <div class="form-group button-container"><button type="submit" class="btn-enviar">Actualizar</button></div>
                </form>
            </section>
        <?php endif; ?>
    </main>
</body>

</html>