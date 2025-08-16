<?php
$resultado = $conexion->query("SELECT * FROM propiedades WHERE id_tipo = 2");

if ($resultado && $resultado->num_rows > 0) {
    $_SESSION['propiedadesVentas'] = [];
    while ($propiedad = $resultado->fetch_assoc()) {
        $_SESSION['propiedadesVentas'][] = $propiedad;
    }
}
