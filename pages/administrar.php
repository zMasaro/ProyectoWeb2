<?php 

//Personalizar página la cual nos mostrará un formulario el cual debe permitir 
//▪ Cambiar el ícono, tanto el principal como el de color blanco 
//▪ Cambiar la imagen principal del banner y su mensaje 
//▪ Cambiar la información de quienes somos y la imagen que se 
//muestra ahí. 
//▪ Cambiar enlaces en redes sociales 
//▪ Cambiar dirección, teléfono, Email
//permitir cambiar las siguientes configuraciones del sitio: 


session_start();

if (!isset($_SESSION['color-principal'])) $_SESSION['color-principal'] = '#10104b';
if (!isset($_SESSION['color-secundario'])) $_SESSION['color-secundario'] = '#c7c400';
if (!isset($_SESSION['color-terciario'])) $_SESSION['color-terciario'] = '#000000';
if (!isset($_SESSION['color-claro'])) $_SESSION['color-claro'] = '#ffffff';





//algo asi la validacion que iria en index.php
/*verifica si el usuario ha iniciado sesión y si su rol es 'administrador'
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'administrador') {
    header('Location: ../index.php');
    exit();
}



//Definir todas las sesiones necesarias para la personalización
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
    <link rel="stylesheet" href="../styles/index.css">
    <style>
        :root {
            --color-principal: <?php echo $_SESSION['color-principal']; ?>;
            --color-secundario: <?php echo $_SESSION['color-secundario']; ?>;
            --color-terciario: <?php echo $_SESSION['color-terciario']; ?>;
            --color-claro: <?php echo $_SESSION['color-claro']; ?>;
        }
    </style>

</head>
<body>
    <Header>
        <section class="header-left">
            <div class="logo-container">
                <img class="logo-principal" src="../<?php echo $_SESSION['icono-principal']?>" alt="logo">
            </div>
            <div class="social-icons">
                <a href="https://www.facebook.com/"><img src="../imgs/Facebook.png" alt="Facebook"></a>
                <a href="https://www.youtube.com/"><img src="../imgs/Youtube.png" alt="YouTube"></a>
                <a href="https://www.instagram.com/"><img src="../imgs/Instagram.png" alt="Instagram"></a>
            </div>

        </section>

        <section class="header-right">
            <div class="social-icons">
                <img class="logo-cuenta" src="../imgs/cuenta.png" alt="cuenta">
            </div>

            <nav>
                <!----<a href="">Administrar</a> |                       Este es el que se debe mostrar si el login es Admin--->
                <a href="../index.php">INICIO</a> |
                <a href="">QUIENES SOMOS</a> |
                <a href="verMasPropiedades.php?id=<?= $row['id'] = 1 ?>">DESTACADAS</a> |
                <a href="verMasPropiedades.php?id=<?= $row['id'] = 2 ?>">ALQUILERES</a> |
                <a href="verMasPropiedades.php?id=<?= $row['id'] = 3 ?>">VENTAS</a> |
                <a href="">CONTACTANOS</a>
            </nav>

            <form action="../includes/obtenerPropiedades/obtenerFiltradas.php" method="GET">
                <div class="buscador">
                    <input type="text" name="descripcion_breve" placeholder="Ingrese su busqueda">
                    <button type="submit">Buscar</button>
                </div>
            </form>
        </section>
    </Header>



    <section class="form-container">
        <form action="../includes/formularios/colores.php" method="post" enctype="multipart/form-data">
            <label for="color-principal">Color Principal</label>
            <input type="color" name="color-principal" value="<?= $_SESSION['color-principal'] ?>"><br>
            <label for="color-secundario">Color Secundario</label>
            <input type="color" name="color-secundario" value="<?= $_SESSION['color-secundario'] ?>"><br>
            <label for="color-terciario">Color Terciario</label>
            <input type="color" name="color-terciario" value="<?=  $_SESSION['color-terciario'] ?>"><br>
            <label for="color-claro">Color Claro</label>
            <input type="color" name="color-claro" value="<?= $_SESSION['color-claro'] ?>"><br>
            <button type="submit">Cambiar Colores</button>
        </form>
    </section><br><br>


    <section class="form-container">
        <form action="../includes/formularios/logos.php" method="post" enctype="multipart/form-data">
            <label for="nueva_imagen">Editar Logo Principal</label><br>
            <input type="file" name="nueva_imagen" required><br><br>
            <label for="nueva_imagen2">Editar Logo Secundario</label><br>
            <input type="file" name="nueva_imagen2" required><br><br>
            <button type="submit">Actualizar</button>
        </form>

    </section>


    <footer>
        <section class="footer-amarillo">
            <article class="footer-left">
                <h3>Direccion</h3>
                <p>Telefono: 123456789</p>
                <p>Email: info@utnrealstate.com</p>
            </article>

            <article class="footer-center">

                <article class="logo-footer-container">
                    <img class="logo-footer" src="../<?php echo $_SESSION['icono-blanco']?>" alt="Logo oscuro">
                </article>

                <article class="social-icons">
                    <a href="https://www.facebook.com/"><img src="../imgs/Facebook.png" alt="Facebook"></a>
                    <a href="https://www.youtube.com/"><img src="../imgs/Youtube.png" alt="YouTube"></a>
                    <a href="https://www.instagram.com/"><img src="../imgs/Instagram.png" alt="Instagram"></a>
                </article>

            </article>

            <div class="contact-form">
                <h3 class="contact-title">Contáctanos</h3>
                <form>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" class="input-text">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" class="input-text">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" class="input-text">
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea id="mensaje" class="input-text"></textarea>
                    </div>
                    <div class="form-group button-container">
                        <button type="submit" class="btn-enviar">Enviar</button>
                    </div>
                </form>
            </div>

        </section>

        <section class="footer-final">
            <p>UTN Real State - Todos los derechos reservados 2024</p>
        </section>

    </footer>
</body>
</html>