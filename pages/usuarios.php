<?php
require_once __DIR__ . '/../includes/auth.php';
require_admin();

$mensaje = '';

// Crear usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'crear') {
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $rol = (int)($_POST['id_privilegio'] ?? 2);
    $password = $_POST['password'] ?? '';
    if ($nombre && $telefono && $correo && $usuario && $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        $sql = 'INSERT INTO usuario (nombre, telefono, correo, usuario, contrasennia, id_privilegio) VALUES (?,?,?,?,?,?)';
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssssi', $nombre, $telefono, $correo, $usuario, $hash, $rol);
            if (mysqli_stmt_execute($stmt)) {
                $mensaje = 'Usuario creado';
            } else {
                $mensaje = 'Error al crear usuario';
            }
        }
    } else {
        $mensaje = 'Complete todos los campos';
    }
}

// Actualizar usuario (sin cambiar password aquí)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'actualizar') {
    $id = (int)($_POST['id'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $usuarioU = trim($_POST['usuario'] ?? '');
    $rol = (int)($_POST['id_privilegio'] ?? 2);
    if ($id && $nombre && $telefono && $correo && $usuarioU) {
        $sql = 'UPDATE usuario SET nombre=?, telefono=?, correo=?, usuario=?, id_privilegio=? WHERE id=?';
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssii', $nombre, $telefono, $correo, $usuarioU, $rol, $id);
            if (mysqli_stmt_execute($stmt)) {
                $mensaje = 'Usuario actualizado';
            } else {
                $mensaje = 'Error al actualizar';
            }
        }
    } else {
        $mensaje = 'Campos incompletos';
    }
}

// Eliminar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'eliminar') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id) {
        $sql = 'DELETE FROM usuario WHERE id = ? LIMIT 1';
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $mensaje = 'Usuario eliminado';
        }
    }
}

$usuarios = [];
$sqlLista = 'SELECT u.id, u.nombre, u.telefono, u.correo, u.usuario, u.id_privilegio, p.privilegio FROM usuario u INNER JOIN privilegios p ON p.id = u.id_privilegio ORDER BY u.id';
if ($res = mysqli_query($conexion, $sqlLista)) {
    while ($row = mysqli_fetch_assoc($res)) {
        $usuarios[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <header class="header">
        <div class="header-left">
            <h1>Usuarios</h1>
        </div>
        <div class="header-right">
            <nav>
                <a href="../index.php">Inicio</a> |
                <a href="usuarios.php">Usuarios</a> |
                <a href="mis_propiedades.php">Mis Propiedades</a> |
                <a href="../logout.php">Salir</a>
            </nav>
        </div>
    </header>
    <main class="usuarios-main">
        <section aria-labelledby="crear-titulo" class="usuarios-crear">
            <h2 id="crear-titulo">Crear Usuario</h2>
            <?php if ($mensaje): ?><p class="mensaje-info"><?php echo htmlspecialchars($mensaje); ?></p><?php endif; ?>
            <form method="post">
                <input type="hidden" name="accion" value="crear">
                <div class="form-group"><label for="nombre">Nombre</label><input id="nombre" name="nombre" required></div>
                <div class="form-group"><label for="telefono">Teléfono</label><input id="telefono" name="telefono" required></div>
                <div class="form-group"><label for="correo">Correo</label><input type="email" id="correo" name="correo" required></div>
                <div class="form-group"><label for="usuario">Usuario</label><input id="usuario" name="usuario" required></div>
                <div class="form-group"><label for="password">Contraseña</label><input type="password" id="password" name="password" required></div>
                <div class="form-group"><label for="id_privilegio">Rol</label>
                    <select id="id_privilegio" name="id_privilegio">
                        <option value="1">Administrador</option>
                        <option value="2" selected>Agente de ventas</option>
                    </select>
                </div>
                <div class="form-group button-container"><button type="submit" class="btn-enviar">Guardar</button></div>
            </form>
        </section>
        <section aria-labelledby="lista-titulo" class="usuarios-lista">
            <h2 id="lista-titulo">Lista de Usuarios</h2>
            <table class="tabla-usuarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?php echo (int)$u['id']; ?></td>
                            <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($u['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($u['correo']); ?></td>
                            <td><?php echo htmlspecialchars($u['usuario']); ?></td>
                            <td><?php echo htmlspecialchars($u['privilegio']); ?></td>
                            <td>
                                <form method="post" class="inline-form" aria-label="Actualizar usuario <?php echo (int)$u['id']; ?>">
                                    <input type="hidden" name="accion" value="actualizar">
                                    <input type="hidden" name="id" value="<?php echo (int)$u['id']; ?>">
                                    <input name="nombre" value="<?php echo htmlspecialchars($u['nombre']); ?>" required>
                                    <input name="telefono" value="<?php echo htmlspecialchars($u['telefono']); ?>" required>
                                    <input name="correo" value="<?php echo htmlspecialchars($u['correo']); ?>" required>
                                    <input name="usuario" value="<?php echo htmlspecialchars($u['usuario']); ?>" required>
                                    <select name="id_privilegio">
                                        <option value="1" <?php if ($u['id_privilegio'] == 1) echo 'selected'; ?>>Administrador</option>
                                        <option value="2" <?php if ($u['id_privilegio'] == 2) echo 'selected'; ?>>Agente de ventas</option>
                                    </select>
                                    <button type="submit" class="btn-enviar">Actualizar</button>
                                </form>
                                <form method="post" onsubmit="return confirm('¿Eliminar usuario?');" class="inline-form" aria-label="Eliminar usuario <?php echo (int)$u['id']; ?>">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="id" value="<?php echo (int)$u['id']; ?>">
                                    <button type="submit" class="btn-enviar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>