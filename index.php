<?php
session_start();
include 'includes/conexion.php';

if (!isset($_SESSION['propiedadesDestacadas'])) {
    include 'includes/obtenerPropiedades/obtenerDestacadas.php';
}
if (!isset($_SESSION['propiedadesVentas'])) {
    include 'includes/obtenerPropiedades/obtenerVentas.php';
}
if (!isset($_SESSION['propiedadesAlquiler'])) {
    include 'includes/obtenerPropiedades/obtenerAlquiler.php';
}
if (!isset($_SESSION['color-principal'])) {
    $_SESSION['color-principal'] = '#10104b';
    $_SESSION['color-secundario'] = '#c7c400';
    $_SESSION['color-terciario'] = '#000000';
    $_SESSION['color-claro'] = '#ffffff';
}

if (!isset($_SESSION['icono-principal'])) $_SESSION['icono-principal'] = 'imgs/logo1.png';
if (!isset($_SESSION['icono-blanco'])) $_SESSION['icono-blanco'] = 'imgs/logo2.png';


if (!isset($_SESSION['img-banner'])) $_SESSION['img-banner'] = 'imgs/banner.jpg';
if (!isset($_SESSION['texto-banner'])) $_SESSION['texto-banner'] = "PERMITENOS AYUDARTE A CUMPLIR TUS SUEÑOS";

if (!isset($_SESSION['img-somos'])) $_SESSION['img-somos'] = 'imgs/QuienesSomos.jpg';
if (!isset($_SESSION['texto-somos'])) $_SESSION['texto-somos'] = "Somos una empresa dedicada a brindar soluciones inmobiliarias de calidad, con un equipo comprometido a ayudarte a encontrar el lugar perfecto para ti.";

if (!isset($_SESSION['url-yt'])) $_SESSION['url-yt'] = 'https://www.youtube.com/';
if (!isset($_SESSION['url-fb'])) $_SESSION['url-fb'] = 'https://www.facebook.com/';
if (!isset($_SESSION['url-ins'])) $_SESSION['url-ins'] = 'https://www.instagram.com/';

if (!isset($_SESSION['texto-direccion'])) $_SESSION['texto-direccion'] = '300 metros norte y 200 este del liceo Maurilio Alvarado Vargas';
if (!isset($_SESSION['texto-telefono'])) $_SESSION['texto-telefono'] = '123456789';
if (!isset($_SESSION['texto-correo'])) $_SESSION['texto-correo'] = 'info@utnrealstate.com';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTN Real State</title>
    <style>
        :root {
            --color-principal: <?php echo $_SESSION['color-principal']; ?>;
            --color-secundario: <?php echo $_SESSION['color-secundario']; ?>;
            --color-terciario: <?php echo $_SESSION['color-terciario']; ?>;
            --color-claro: <?php echo $_SESSION['color-claro']; ?>;
        }

        .banner {
            background-image: url('./<?php echo $_SESSION['img-banner'] ?>');
        }
    </style>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>
    <header class="header">
        <section class="header-left">
            <div class="logo-container">
                <img class="logo-principal" src="./<?php echo $_SESSION['icono-principal'] ?>" alt="logo">
            </div>
            <div class="social-icons">
                <a href="<?php echo $_SESSION['url-fb'] ?>"><img src="./imgs/Facebook.png" alt="Facebook"></a>
                <a href="<?php echo $_SESSION['url-yt'] ?>"><img src="./imgs/Youtube.png" alt="YouTube"></a>
                <a href="<?php echo $_SESSION['url-ins'] ?>"><img src="./imgs/Instagram.png" alt="Instagram"></a>
            </div>

        </section>

        <section class="header-right">
            <div class="social-icons">
                <img class="logo-cuenta" src="./imgs/cuenta.png" alt="cuenta">
            </div>

            <nav>
                <!----<a href="">Administrar</a> |                       Este es el que se debe mostrar si el login es Admin--->
                <a href="./pages/administrar.php">ADMINISTRAR</a> |
                <a href="">INICIO</a> |
                <a href="#QuienesSomos">QUIENES SOMOS</a> |
                <a href="./pages/verMasPropiedades.php?id=<?= $row['id'] = 1 ?>">DESTACADAS</a> |
                <a href="./pages/verMasPropiedades.php?id=<?= $row['id'] = 2 ?>">ALQUILERES</a> |
                <a href="./pages/verMasPropiedades.php?id=<?= $row['id'] = 3 ?>">VENTAS</a> |
                <a href="#Contactanos">CONTACTANOS</a>
            </nav>
            <form action="./includes/obtenerPropiedades/obtenerFiltradas.php" method="GET">
                <div class="buscador">
                    <input type="text" name="descripcion_breve" placeholder="Ingrese su busqueda">
                    <button type="submit">Buscar</button>
                </div>
            </form>
        </section>
    </header>

    <main>

        <section class="banner">
            <article class="texto-banner">
                <h1><?php echo $_SESSION['texto-banner'] ?></h1>
            </article>
        </section>
        <section id="QuienesSomos"  class="quienes-somos">

            <h1 class="titulos">Quienes Somos</h1>
            <article class="texto-quienes-somos">
                <p><?php echo $_SESSION['texto-somos'] ?></p>
            </article>
            <article class="quienes-somos-img-container">
                <img class="quienes-somos-img" src="./<?php echo $_SESSION['img-somos'] ?>" alt="Quienes Somos">
            </article>

        </section>

        <section class="card-container">
            <h1 class="titulos">Propiedades Destacadas</h1>

            <?php
            $propiedadesDestacadas = array_slice($_SESSION['propiedadesDestacadas'], -3); // solo extrae 3 propiedades destacadas
            foreach ($propiedadesDestacadas as $propiedad) {
            ?>
                <article class="card" onclick="location.href='./pages/propiedad.php?id=<?= $propiedad['id'] ?>'">
                    <div class="card-img-container">
                        <img class="card-img" src="<?= htmlspecialchars($propiedad['img_link']) ?>" alt="Foto Propiedad">
                    </div>

                    <div class="card-titulo">
                        <h3><?= htmlspecialchars($propiedad['titulo']) ?></h3>
                    </div>

                    <div class="card-descripcion">
                        <p><?= htmlspecialchars($propiedad['descripcion_breve']) ?></p>
                        <p>Precio: $<?= htmlspecialchars($propiedad['precio']) ?></p>
                    </div>
                </article>

            <?php } //Cierre del foreach 
            ?>
            <div class="cardButtonContainer">
                <button class="learn-more" onclick="location.href='./pages/verMasPropiedades.php?id=<?= $row['id'] = 1 ?>'">
                    <span class="circle" aria-hidden="true">
                        <span class="icon arrow"></span>
                    </span>
                    <span class="button-text">Ver mas</span>
                </button>
            </div>

        </section>

        <section class="ventas-container">
            <h1 class="titulos">Propiedades en venta</h1>

            <?php
            $propiedadesVentas = array_slice($_SESSION['propiedadesVentas'], -3); // solo extrae 3 propiedades destacadas
            foreach ($propiedadesVentas as $propiedad) {
            ?>
                <article class="card2" onclick="location.href='./pages/propiedad.php?id=<?= $propiedad['id'] ?>'">
                    <div class="card-img-container">
                        <img class="card-img" src="<?= htmlspecialchars($propiedad['img_link']) ?>" alt="Foto Propiedad">
                    </div>

                    <div class="card-titulo">
                        <h3><?= htmlspecialchars($propiedad['titulo']) ?></h3>
                    </div>

                    <div class="card-descripcion">
                        <p><?= htmlspecialchars($propiedad['descripcion_breve']) ?></p>
                        <p>Precio: $<?= htmlspecialchars($propiedad['precio']) ?></p>
                    </div>
                </article>

            <?php } //Cierre del foreach 
            ?>

            <div class="cardButtonContainer">
                <button class="learn-more2" onclick="location.href='./pages/verMasPropiedades.php?id=<?= $row['id'] = 3 ?>'">
                    <span class="circle2" aria-hidden="true">
                        <span class="icon2 arrow2"></span>
                    </span>
                    <span class="button-text2">Ver mas</span>
                </button>
            </div>
        </section>

        <section class="card-container">
            <h1 class="titulos">Propiedades en alquiler</h1>

            <?php
            $propiedadesAlquiler = array_slice($_SESSION['propiedadesAlquiler'], -3); // solo extrae 3 propiedades destacadas
            foreach ($propiedadesAlquiler as $propiedad) {
            ?>
                <article class="card" onclick="location.href='./pages/propiedad.php?id=<?= $propiedad['id'] ?>'">
                    <div class="card-img-container">
                        <img class="card-img" src="<?= htmlspecialchars($propiedad['img_link']) ?>" alt="Foto Propiedad">
                    </div>

                    <div class="card-titulo">
                        <h3><?= htmlspecialchars($propiedad['titulo']) ?></h3>
                    </div>

                    <div class="card-descripcion">
                        <p><?= htmlspecialchars($propiedad['descripcion_breve']) ?></p>
                        <p>Precio: $<?= htmlspecialchars($propiedad['precio']) ?></p>
                    </div>
                </article>

            <?php } //Cierre del foreach 
            ?>

            <div class="cardButtonContainer">
                <button class="learn-more" onclick="location.href='./pages/verMasPropiedades.php?id=<?= $row['id'] = 2 ?>'">
                    <span class="circle" aria-hidden="true">
                        <span class="icon arrow"></span>
                    </span>
                    <span class="button-text">Ver mas</span>
                </button>
            </div>
        </section>

    </main>

    <footer>
        <section class="footer-amarillo">
            <article class="footer-left">
                <h3>Direccion: <?php echo $_SESSION['texto-direccion'] ?></h3>
                <p>Telefono: <?php echo $_SESSION['texto-telefono'] ?></p>
                <p>Email: <?php echo $_SESSION['texto-correo'] ?></p>
            </article>

            <article class="footer-center">

                <article class="logo-footer-container">
                    <img class="logo-footer" src="./<?php echo $_SESSION['icono-blanco'] ?>" alt="Logo oscuro">
                </article>

                <article class="social-icons">
                    <a href="<?php echo $_SESSION['url-fb'] ?>"><img src="./imgs/Facebook.png" alt="Facebook"></a>
                    <a href="<?php echo $_SESSION['url-yt'] ?>"><img src="./imgs/Youtube.png" alt="YouTube"></a>
                    <a href="<?php echo $_SESSION['url-ins'] ?>"><img src="./imgs/Instagram.png" alt="Instagram"></a>
                </article>

            </article>

            <div id="Contactanos" class="contact-form">
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