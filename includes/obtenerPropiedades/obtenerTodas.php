<?php
session_start();
include '../includes/conexion.php';


$resultado = $conexion->query("SELECT * FROM propiedades");

if ($resultado && $resultado->num_rows > 0) {
    $_SESSION['propiedadesTodas'] = [];
    while ($propiedad = $resultado->fetch_assoc()) {
        $_SESSION['propiedadesTodas'][] = $propiedad;
    }
}
