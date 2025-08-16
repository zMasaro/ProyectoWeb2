<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['texto-direccion'])) {
        $_SESSION['texto-direccion'] = $_POST['texto-direccion'];
    }
    if (isset($_POST['texto-telefono'])) {
        $_SESSION['texto-telefono'] = $_POST['texto-telefono'];
    }
    if (isset($_POST['texto-correo'])) {
        $_SESSION['texto-correo'] = $_POST['texto-correo'];
    }        
    
    header("Location: ../../index.php");
}
