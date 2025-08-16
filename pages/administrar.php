<?php 

//Personalizar página la cual nos mostrará un formulario el cual debe permitir 
//▪ Colores de la página(azul, amarillo y gris, blanco y gris) 
//▪ Cambiar el ícono, tanto el principal como el de color blanco 
//▪ Cambiar la imagen principal del banner y su mensaje 
//▪ Cambiar la información de quienes somos y la imagen que se 
//muestra ahí. 
//▪ Cambiar enlaces en redes sociales 
//▪ Cambiar dirección, teléfono, Email
//permitir cambiar las siguientes configuraciones del sitio: 


session_start();

//algo asi la validacion que iria en index.php
//verifica si el usuario ha iniciado sesión y si su rol es 'administrador'
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'administrador') {
    header('Location: ../index.php');
    exit();
}

//Colores de la página
$_SESSION['color-principal'];
$_SESSION['color-secundario'];
$_SESSION['color-terciario'];

//Definir todas las sesiones necesarias para la personalización
$_SESSION['icono-principal'] = 'ruta/icono_principal.png'; // Ruta del icono principal
$_SESSION['icono-blanco'] = 'ruta/icono_blanco.png'; // Ruta del icono blanco
$_SESSION['banner-imagen'] = 'ruta/banner_imagen.jpg'; // Ruta de la imagen del banner
$_SESSION['banner-mensaje'] = 'Bienvenido a nuestra página'; // Mensaje del banner
$_SESSION['quienes-somos'] = 'Somos una empresa dedicada a...'; // Información de "Quiénes somos"
$_SESSION['quienes-somos-imagen'] = 'ruta/quienes_somos_imagen.jpg'; // Ruta de la imagen de "Quiénes somos"
$_SESSION['redes-sociales'] = [
    'facebook' => 'https://facebook.com/tuempresa',
    'twitter' => 'https://twitter.com/tuempresa',
    'instagram' => 'https://instagram.com/tuempresa',
]; // Enlaces a redes sociales
$_SESSION['direccion'] = 'Calle Falsa 123, Ciudad'; // Dirección de la empresa
$_SESSION['telefono'] = '123-456-7890'; // Teléfono de contacto
$_SESSION['email'] = 'falso@correo.com'; // Email de contacto
?>