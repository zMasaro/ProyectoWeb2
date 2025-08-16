<?php 
session_start();

if (!isset($_SESSION['color-principal']) && !isset($_SESSION['color-secundario']) && 
!isset($_SESSION['color-terciario']) && !isset($_SESSION['color-claro'])) {
    $_SESSION['color-principal'] = '#10104b';
    $_SESSION['color-secundario'] = '#c7c400';
    $_SESSION['color-terciario'] = '#0000';
    $_SESSION['color-claro'] = '#ffffff';
}

$primario = $_SESSION['color-principal'];
$secundario = $_SESSION['color-secundario'];
$terciario = $_SESSION['color-terciario'];
$claro = $_SESSION['color-claro'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['color-principal'])) {
        $_SESSION['color-principal'] = $_POST['color-principal'];
    }
    if (isset($_POST['color-secundario'])) {
        $_SESSION['color-secundario'] = $_POST['color-secundario'];
    }
    if (isset($_POST['color-terciario'])) {
        $_SESSION['color-terciario'] = $_POST['color-terciario'];
    }
    if (isset($_POST['color-claro'])) {
        $_SESSION['color-claro'] = $_POST['color-claro'];
    }

    header("Location: ../../index.php");
}
