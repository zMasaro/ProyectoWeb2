<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['texto-yt'])) {
        $_SESSION['url-yt'] = $_POST['texto-yt'];
    }
    if (isset($_POST['texto-fb'])) {
        $_SESSION['url-fb'] = $_POST['texto-fb'];
    }
    if (isset($_POST['texto-ins'])) {
        $_SESSION['url-ins'] = $_POST['texto-ins'];
    }        
    
    header("Location: ../../index.php");
}
