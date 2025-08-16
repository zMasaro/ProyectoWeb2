<?php
session_start();

if (!isset($_SESSION['icono-principal']) && !isset($_SESSION['icono-blanco'])) {
    $_SESSION['icono-principal'] = 'imgs/icono_principal.png';
    $_SESSION['icono-blanco'] = 'imgs/icono_blanco.png';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_FILES['nueva_imagen']['name'];
    $tmp = $_FILES['nueva_imagen']['tmp_name'];
    $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

    $nombre2 = $_FILES['nueva_imagen2']['name'];
    $tmp2 = $_FILES['nueva_imagen2']['tmp_name'];
    $ext2 = strtolower(pathinfo($nombre2, PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'png'];


    if (in_array($ext, $permitidas)) {
        $nombreFinal = uniqid() . "." . $ext;
        $ruta = "imgs/" . $nombreFinal;
        if (move_uploaded_file($tmp, "../../imgs/" . $nombreFinal)) {
            $_SESSION['icono-principal'] = "";
            $_SESSION['icono-principal'] = $ruta;
            var_dump($_SESSION['icono-principal']);
            var_dump($ruta);
        }
    }

    if (in_array($ext2, $permitidas)) {
        $nombreFinal2 = uniqid() . "." . $ext2;
        $ruta2 = "imgs/" . $nombreFinal2;
        if (move_uploaded_file($tmp2, "../../imgs/" . $nombreFinal2)) {
            $_SESSION['icono-blanco'] = "";
            $_SESSION['icono-blanco'] = $ruta2;
        }
    }
    header("Location: ../../index.php");
    
}
