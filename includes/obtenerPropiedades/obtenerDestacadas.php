<?php
if (isset($_SESSION['propiedadesDestacadas'])) {
    session_destroy();
}



$resultado = $conexion->query("SELECT * FROM propiedades WHERE destacada = 1");

if ($resultado && $resultado->num_rows > 0) {
    while ($propiedad = $resultado->fetch_assoc()) {
        $_SESSION['propiedadesDestacadas'][] = $propiedad;
    }
}
