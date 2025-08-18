<?php
// Manejo de sesión y helpers de autenticación / autorización
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/conexion.php';

function auth_login(string $username, string $password): bool {
    global $conexion;
    $sql = 'SELECT u.id, u.usuario, u.contrasennia, u.nombre, u.id_privilegio, p.privilegio FROM usuario u INNER JOIN privilegios p ON p.id = u.id_privilegio WHERE u.usuario = ? LIMIT 1';
    if (!$stmt = mysqli_prepare($conexion, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['contrasennia'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => (int)$row['id'],
                'usuario' => $row['usuario'],
                'nombre' => $row['nombre'],
                'rol_id' => (int)$row['id_privilegio'],
                'rol' => $row['privilegio']
            ];
            return true;
        }
    }
    return false;
}

function auth_logout(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}

function is_logged_in(): bool { return isset($_SESSION['user']); }
function current_user_id(): ?int { return $_SESSION['user']['id'] ?? null; }
function current_user_role(): ?string { return $_SESSION['user']['rol'] ?? null; }
function is_admin(): bool { return current_user_role() === 'administrador'; }
function is_agente(): bool { return current_user_role() === 'agente de ventas'; }

function require_login(): void {
    if (!is_logged_in()) {
        header('Location: ../login.php');
        exit;    }
}

function require_admin(): void {
    require_login();
    if (!is_admin()) {
        http_response_code(403);
        echo 'Acceso denegado';
        exit;    }
}
