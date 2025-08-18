<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();

// Carga propiedades del usuario actual (o todas si admin para reutilizar vista)
$propiedades = [];
if (is_admin()) {
    $sql = 'SELECT p.*, u.nombre AS agente FROM propiedades p INNER JOIN usuario u ON u.id = p.id_usuario ORDER BY p.id DESC';
    $stmt = mysqli_query($conexion, $sql);
} else {
    $sql = 'SELECT p.*, u.nombre AS agente FROM propiedades p INNER JOIN usuario u ON u.id = p.id_usuario WHERE p.id_usuario = ? ORDER BY p.id DESC';
    $stmtPrep = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmtPrep, 'i', $_SESSION['user']['id']);
    mysqli_stmt_execute($stmtPrep);
    $stmt = mysqli_stmt_get_result($stmtPrep);
}
if ($stmt) {
    while ($row = mysqli_fetch_assoc($stmt)) {
        $propiedades[] = $row;
    }
}

$mensaje = '';

// Crear
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'crear') {
    if (!is_admin() && !is_agente()) {
        http_response_code(403);
        exit;
    }
    $id_usuario = is_admin() ? (int)($_POST['id_usuario'] ?? current_user_id()) : current_user_id();
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion_breve = trim($_POST['descripcion_breve'] ?? '');
    $precio = trim($_POST['precio'] ?? '');
    $id_tipo = (int)($_POST['id_tipo'] ?? 1);
    $destacada = isset($_POST['destacada']) ? 1 : 0;
    $descripcion_larga = trim($_POST['descripcion_larga'] ?? '');
    $ubicacion = trim($_POST['ubicacion'] ?? '');
    $mapa_link = '';
    $img_link = '';

    // Subidas (simplificado, reutiliza carpeta imgs existente)
    if (!empty($_FILES['imagen']['name'])) {
        $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $nombreFinal = 'propiedad_' . time() . '_' . rand(1, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . '/../imgs/' . $nombreFinal)) {
                $img_link = 'imgs/' . $nombreFinal;
            }
        }
    }
    if (!empty($_FILES['mapa']['name'])) {
        $extM = strtolower(pathinfo($_FILES['mapa']['name'], PATHINFO_EXTENSION));
        if (in_array($extM, ['jpg', 'jpeg', 'png'])) {
            $nombreFinalM = 'mapa_' . time() . '_' . rand(1, 999) . '.' . $extM;
            if (move_uploaded_file($_FILES['mapa']['tmp_name'], __DIR__ . '/../imgs/' . $nombreFinalM)) {
                $mapa_link = 'imgs/' . $nombreFinalM;
            }
        }
    }

    if ($titulo && $descripcion_breve && $precio && $img_link) {
        $sqlIns = 'INSERT INTO propiedades (id_tipo, destacada, titulo, descripcion_breve, precio, id_usuario, img_link, descripcion_larga, mapa_link, ubicacion) VALUES (?,?,?,?,?,?,?,?,?,?)';
        if ($stmtC = mysqli_prepare($conexion, $sqlIns)) {
            mysqli_stmt_bind_param($stmtC, 'iisssissss', $id_tipo, $destacada, $titulo, $descripcion_breve, $precio, $id_usuario, $img_link, $descripcion_larga, $mapa_link, $ubicacion);
            if (mysqli_stmt_execute($stmtC)) {
                $mensaje = 'Propiedad creada';
            } else {
                $mensaje = 'Error al crear';
            }
        }
    } else {
        $mensaje = 'Campos requeridos faltantes';
    }
}

// Actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'actualizar') {
    $id = (int)($_POST['id'] ?? 0);
    // Verificar ownership
    $propCheck = mysqli_prepare($conexion, 'SELECT id_usuario FROM propiedades WHERE id=?');
    mysqli_stmt_bind_param($propCheck, 'i', $id);
    mysqli_stmt_execute($propCheck);
    $resCheck = mysqli_stmt_get_result($propCheck);
    $ownerRow = mysqli_fetch_assoc($resCheck);
    if (!$ownerRow) {
        $mensaje = 'Propiedad inexistente';
    } else if (!is_admin() && $ownerRow['id_usuario'] != current_user_id()) {
        http_response_code(403);
        exit;
    } else {
        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion_breve = trim($_POST['descripcion_breve'] ?? '');
        $precio = trim($_POST['precio'] ?? '');
        $id_tipo = (int)($_POST['id_tipo'] ?? 1);
        $destacada = isset($_POST['destacada']) ? 1 : 0;
        $descripcion_larga = trim($_POST['descripcion_larga'] ?? '');
        $ubicacion = trim($_POST['ubicacion'] ?? '');

        // Opcionalmente reemplazar imágenes
        $updates = [];
        $params = [];
        $types = '';
        $updates[] = 'id_tipo=?';
        $types .= 'i';
        $params[] = $id_tipo;
        $updates[] = 'destacada=?';
        $types .= 'i';
        $params[] = $destacada;
        $updates[] = 'titulo=?';
        $types .= 's';
        $params[] = $titulo;
        $updates[] = 'descripcion_breve=?';
        $types .= 's';
        $params[] = $descripcion_breve;
        $updates[] = 'precio=?';
        $types .= 's';
        $params[] = $precio;
        $updates[] = 'descripcion_larga=?';
        $types .= 's';
        $params[] = $descripcion_larga;
        $updates[] = 'ubicacion=?';
        $types .= 's';
        $params[] = $ubicacion;

        if (!empty($_FILES['imagen']['name'])) {
            $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $nombreFinal = 'propiedad_' . time() . '_' . rand(1, 999) . '.' . $ext;
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . '/../imgs/' . $nombreFinal)) {
                    $updates[] = 'img_link=?';
                    $types .= 's';
                    $params[] = 'imgs/' . $nombreFinal;
                }
            }
        }
        if (!empty($_FILES['mapa']['name'])) {
            $extM = strtolower(pathinfo($_FILES['mapa']['name'], PATHINFO_EXTENSION));
            if (in_array($extM, ['jpg', 'jpeg', 'png'])) {
                $nombreFinalM = 'mapa_' . time() . '_' . rand(1, 999) . '.' . $extM;
                if (move_uploaded_file($_FILES['mapa']['tmp_name'], __DIR__ . '/../imgs/' . $nombreFinalM)) {
                    $updates[] = 'mapa_link=?';
                    $types .= 's';
                    $params[] = 'imgs/' . $nombreFinalM;
                }
            }
        }

        $types .= 'i';
        $params[] = $id;
        $sqlUp = 'UPDATE propiedades SET ' . implode(',', $updates) . ' WHERE id=?';
        if ($stmtU = mysqli_prepare($conexion, $sqlUp)) {
            mysqli_stmt_bind_param($stmtU, $types, ...$params);
            if (mysqli_stmt_execute($stmtU)) {
                $mensaje = 'Propiedad actualizada';
            } else {
                $mensaje = 'Error al actualizar';
            }
        }
    }
}

// Eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'eliminar') {
    $id = (int)($_POST['id'] ?? 0);
    $propCheck = mysqli_prepare($conexion, 'SELECT id_usuario FROM propiedades WHERE id=?');
    mysqli_stmt_bind_param($propCheck, 'i', $id);
    mysqli_stmt_execute($propCheck);
    $resCheck = mysqli_stmt_get_result($propCheck);
    $ownerRow = mysqli_fetch_assoc($resCheck);
    if ($ownerRow && (is_admin() || $ownerRow['id_usuario'] == current_user_id())) {
        $del = mysqli_prepare($conexion, 'DELETE FROM propiedades WHERE id=? LIMIT 1');
        mysqli_stmt_bind_param($del, 'i', $id);
        mysqli_stmt_execute($del);
        $mensaje = 'Propiedad eliminada';
    }
}

// Recargar propiedades tras operaciones
$propiedades = [];
if (is_admin()) {
    $sql = 'SELECT p.*, u.nombre AS agente FROM propiedades p INNER JOIN usuario u ON u.id = p.id_usuario ORDER BY p.id DESC';
    $stmt = mysqli_query($conexion, $sql);
} else {
    $sql = 'SELECT p.*, u.nombre AS agente FROM propiedades p INNER JOIN usuario u ON u.id = p.id_usuario WHERE p.id_usuario = ? ORDER BY p.id DESC';
    $stmtPrep = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmtPrep, 'i', $_SESSION['user']['id']);
    mysqli_stmt_execute($stmtPrep);
    $stmt = mysqli_stmt_get_result($stmtPrep);
}
if ($stmt) {
    while ($row = mysqli_fetch_assoc($stmt)) {
        $propiedades[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Mis Propiedades</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>
    <header class="header">
        <div class="header-left">
            <h1>Propiedades</h1>
        </div>
        <div class="header-right">
            <nav>
                <a href="../index.php">Inicio</a> |
                <?php if (is_admin()): ?><a href="usuarios.php">Usuarios</a> |<?php endif; ?>
                    <a href="mis_propiedades.php">Mis Propiedades</a> |
                    <a href="../logout.php">Salir</a>
            </nav>
        </div>
    </header>
    <main class="propiedades-main">
        <?php if ($mensaje): ?><p class="mensaje-info"><?php echo htmlspecialchars($mensaje); ?></p><?php endif; ?>
        <section class="crear-propiedad" aria-labelledby="crear-propiedad-titulo">
            <h2 id="crear-propiedad-titulo">Crear Propiedad</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="crear">
                <?php if (is_admin()): ?>
                    <div class="form-group"><label for="id_usuario">Agente</label>
                        <select name="id_usuario" id="id_usuario">
                            <?php $agRes = mysqli_query($conexion, "SELECT id,nombre FROM usuario WHERE id_privilegio=2 ORDER BY nombre");
                            while ($ag = mysqli_fetch_assoc($agRes)): ?>
                                <option value="<?php echo (int)$ag['id']; ?>"><?php echo htmlspecialchars($ag['nombre']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="form-group"><label for="titulo">Título</label><input id="titulo" name="titulo" required></div>
                <div class="form-group"><label for="descripcion_breve">Descripción breve</label><input id="descripcion_breve" name="descripcion_breve" required></div>
                <div class="form-group"><label for="precio">Precio</label><input id="precio" name="precio" required></div>
                <div class="form-group"><label for="id_tipo">Tipo</label>
                    <select id="id_tipo" name="id_tipo">
                        <option value="1">Alquiler</option>
                        <option value="2">Venta</option>
                    </select>
                </div>
                <div class="form-group"><label><input type="checkbox" name="destacada"> Destacada</label></div>
                <div class="form-group"><label for="descripcion_larga">Descripción larga</label><textarea id="descripcion_larga" name="descripcion_larga"></textarea></div>
                <div class="form-group"><label for="ubicacion">Ubicación</label><input id="ubicacion" name="ubicacion"></div>
                <div class="form-group"><label for="imagen">Imagen</label><input type="file" id="imagen" name="imagen" required></div>
                <div class="form-group"><label for="mapa">Mapa</label><input type="file" id="mapa" name="mapa"></div>
                <div class="form-group button-container"><button type="submit" class="btn-enviar">Guardar</button></div>
            </form>
        </section>
        <section class="lista-propiedades" aria-labelledby="lista-propiedades-titulo">
            <h2 id="lista-propiedades-titulo">Listado</h2>
            <table class="tabla-propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Destacada</th>
                        <th>Precio</th>
                        <th>Agente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($propiedades as $p): ?>
                        <tr>
                            <td><?php echo (int)$p['id']; ?></td>
                            <td><?php echo htmlspecialchars($p['titulo']); ?></td>
                            <td><?php echo $p['id_tipo'] == 1 ? 'Alquiler' : 'Venta'; ?></td>
                            <td><?php echo $p['destacada'] ? 'Sí' : 'No'; ?></td>
                            <td><?php echo htmlspecialchars($p['precio']); ?></td>
                            <td><?php echo htmlspecialchars($p['agente']); ?></td>
                            <td>
                                <form method="post" enctype="multipart/form-data" class="inline-form" aria-label="Actualizar propiedad <?php echo (int)$p['id']; ?>">
                                    <input type="hidden" name="accion" value="actualizar">
                                    <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
                                    <input name="titulo" value="<?php echo htmlspecialchars($p['titulo']); ?>" required>
                                    <input name="descripcion_breve" value="<?php echo htmlspecialchars($p['descripcion_breve']); ?>" required>
                                    <input name="precio" value="<?php echo htmlspecialchars($p['precio']); ?>" required>
                                    <select name="id_tipo">
                                        <option value="1" <?php if ($p['id_tipo'] == 1) echo 'selected'; ?>>Alquiler</option>
                                        <option value="2" <?php if ($p['id_tipo'] == 2) echo 'selected'; ?>>Venta</option>
                                    </select>
                                    <label><input type="checkbox" name="destacada" <?php if ($p['destacada']) echo 'checked'; ?>> Dest.</label>
                                    <input name="descripcion_larga" value="<?php echo htmlspecialchars($p['descripcion_larga']); ?>">
                                    <input name="ubicacion" value="<?php echo htmlspecialchars($p['ubicacion']); ?>">
                                    <input type="file" name="imagen">
                                    <input type="file" name="mapa">
                                    <button type="submit" class="btn-enviar">Actualizar</button>
                                </form>
                                <form method="post" onsubmit="return confirm('¿Eliminar propiedad?');" class="inline-form" aria-label="Eliminar propiedad <?php echo (int)$p['id']; ?>">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
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