<?php
$resultado = $conexion->query("SELECT * FROM usuario");

if ($resultado && $resultado->num_rows > 0) {
    $_SESSION['usuarios'] = [];
    while ($propiedad = $resultado->fetch_assoc()) {
        $_SESSION['usuarios'][] = $propiedad;
    }
}
