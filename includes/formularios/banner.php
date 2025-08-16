<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_FILES['nueva_imagen']['name'];
    $tmp = $_FILES['nueva_imagen']['tmp_name'];
    $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
     $permitidas = ['jpg', 'png'];

    $nombre = $_POST['texto-banner'];

    if (in_array($ext, $permitidas)) {
        $nombreFinal = uniqid() . "." . $ext;
        $ruta = "imgs/" . $nombreFinal;
        if (move_uploaded_file($tmp, "../../imgs/" . $nombreFinal)) {
            $_SESSION['img-banner'] = $ruta;
            $_SESSION['texto-banner'] = $nombre;
        }
    }
    header("Location: ../../index.php");
}
