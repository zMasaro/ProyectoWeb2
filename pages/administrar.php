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

if (isset($_SESSION['color-principal']) && isset($_SESSION['color-secundario']) && isset($_SESSION['color-terciario']) && isset($_SESSION['color-claro'])) {
    // Colores ya definidos en la sesión
} else {
    // Definir colores por defecto si no están establecidos
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

    header("Location: ../index.php");
    exit;
}
//algo asi la validacion que iria en index.php
/*verifica si el usuario ha iniciado sesión y si su rol es 'administrador'
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'administrador') {
    header('Location: ../index.php');
    exit();
}



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
$_SESSION['email'] = 'falso@correo.com'; // Email de contacto*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar</title>
</head>
<body>

    <section class="form-container">
        <form method="post" enctype="multipart/form-data">
            <label for="color-principal">Color Principal</label>
            <input type="color" name="color-principal" value="<?= $primario ?>"><br>
            <label for="color-secundario">Color Secundario</label>
            <input type="color" name="color-secundario" value="<?= $secundario ?>"><br>
            <label for="color-terciario">Color Terciario</label>
            <input type="color" name="color-terciario" value="<?= $terciario ?>"><br>
            <label for="color-claro">Color Claro</label>
            <input type="color" name="color-claro" value="<?= $claro ?>"><br>
            <button type="submit">Cambiar Colores</button>
        </form>
    </section>
    
</body>
</html>