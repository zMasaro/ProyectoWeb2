<?php
session_start();
include '../conexion.php';

if (isset($_GET['descripcion_breve'])) {
    $filtro = $_GET['descripcion_breve'];
    $resultado = $conexion->query("SELECT * FROM propiedades WHERE destacada = 1");

    if ($resultado && $resultado->num_rows > 0) {
        $_SESSION['propiedadesDestacadas'] = [];
        while ( $propiedad =  $resultado->fetch_assoc()) {
            if (str_contains(strtolower($propiedad['descripcion_breve']), strtolower($filtro))) {
                $_SESSION['propiedadesDestacadas'][] = $propiedad;
            }
        }
    }

}

if (isset($_GET['descripcion_breve'])) {
    $filtro = $_GET['descripcion_breve'];
    $resultado = $conexion->query("SELECT * FROM propiedades WHERE id_tipo = 2");

    if ($resultado && $resultado->num_rows > 0) {
        $_SESSION['propiedadesVentas'] = [];
        while ( $propiedad =  $resultado->fetch_assoc()) {
            if (str_contains(strtolower($propiedad['descripcion_breve']), strtolower($filtro))) {
                $_SESSION['propiedadesVentas'][] = $propiedad;
            }
        }
    }

}

if (isset($_GET['descripcion_breve'])) {
    $filtro = $_GET['descripcion_breve'];
    $resultado = $conexion->query("SELECT * FROM propiedades WHERE id_tipo = 1");

    if ($resultado && $resultado->num_rows > 0) {
        $_SESSION['propiedadesAlquiler'] = [];
        while ( $propiedad =  $resultado->fetch_assoc()) {
            if (str_contains(strtolower($propiedad['descripcion_breve']), strtolower($filtro))) {
                $_SESSION['propiedadesAlquiler'][] = $propiedad;
            }
        }
    }

}
 header('Location: ' . $_SERVER['HTTP_REFERER']); //La verdad esto me lo encontre en internet y te retorna a la pagina anterior