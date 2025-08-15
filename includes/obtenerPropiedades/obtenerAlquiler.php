<?php
if (isset($_SESSION['propiedadesAlquiler'])) {
    session_destroy();
}



$resultado = $conexion->query("SELECT * FROM propiedades WHERE id_tipo = 1");

if ($resultado && $resultado->num_rows > 0) {
    while ($propiedad = $resultado->fetch_assoc()) {
        $_SESSION['propiedadesAlquiler'][] = $propiedad;
    }
}
