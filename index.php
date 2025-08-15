<?php
session_start();

include 'includes/conexion.php';
include 'includes/obtenerPropiedades/obtenerAlquiler.php';
include 'includes/obtenerPropiedades/obtenerVentas.php';
include 'includes/obtenerPropiedades/obtenerDestacadas.php';


if (!isset($_SESSION['propiedadesDestacadas'])) {
    $_SESSION['propiedadesDestacadas'] = [];
}
if (!isset($_SESSION['propiedadesVentas'])) {
    $_SESSION['propiedadesVentas'] = [];
}
if (!isset($_SESSION['propiedadesAlquiler'])) {
    $_SESSION['propiedadesAlquiler'] = [];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTN Real State</title>
    <link rel="stylesheet" href="styles/index.css">
    <style>
        .banner {
            background-image: url('./imgs/banner.jpg');
        }
    </style>
</head>

<body>
    <Header>
        <section class="header-left">
            <div class="logo-container">
                <img class="logo-principal" src="./imgs/logo2.png" alt="logo">
            </div>
            <div class="social-icons">
                <a href="https://www.facebook.com/"><img src="./imgs/Facebook.png" alt="Facebook"></a>
                <a href="https://www.youtube.com/"><img src="./imgs/Youtube.png" alt="YouTube"></a>
                <a href="https://www.instagram.com/"><img src="./imgs/Instagram.png" alt="Instagram"></a>
            </div>

        </section>

        <section class="header-right">
            <div class="social-icons">
                <img class="logo-cuenta" src="./imgs/cuenta.png" alt="cuenta">
            </div>

            <nav>
                <a href="">INICIO</a> |
                <a href="">QUIENES SOMOS</a> |
                <a href="">ALQUILERES</a> |
                <a href="">VENTAS</a> |
                <a href="">CONTACTANOS</a>
            </nav>

            <div class="buscador">
                <input type="text" placeholder="Ingrese su busqueda">
                <button type="submit">Buscar</button>
            </div>
        </section>
    </Header>

    <main>

        <section class="banner">
            <article class="texto-banner">
                <h1>TEXTO DEL BANNER AQUI</h1>
            </article>
        </section>
        <h1 class="titulos">Quienes Somos</h1>
        <section class="quienes-somos">
            <article class="texto-quienes-somos">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio voluptatem adipisci similique error corporis earum libero veritatis aliquam, laudantium, molestiae aperiam minus ad ipsa sit fuga vitae modi nesciunt ut? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis deserunt praesentium, et veritatis, aperiam hic consequuntur voluptate quibusdam repellendus adipisci, natus assumenda optio suscipit quis iure eveniet nobis vel sunt! Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, error similique? Reiciendis eius accusantium distinctio, enim consequuntur tempora, repudiandae, obcaecati iusto et architecto libero dolores nam eos. Accusamus, reprehenderit inventore.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio voluptatem adipisci similique error corporis earum libero veritatis aliquam, laudantium, molestiae aperiam minus ad ipsa sit fuga vitae modi nesciunt ut? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis deserunt praesentium, et veritatis, aperiam hic consequuntur voluptate quibusdam repellendus adipisci, natus assumenda optio suscipit quis iure eveniet nobis vel sunt! Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, error similique? Reiciendis eius accusantium distinctio, enim consequuntur tempora, repudiandae, obcaecati iusto et architecto libero dolores nam eos. Accusamus, reprehenderit inventore.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio voluptatem adipisci similique error corporis earum libero veritatis aliquam, laudantium, molestiae aperiam minus ad ipsa sit fuga vitae modi nesciunt ut? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis deserunt praesentium, et veritatis, aperiam hic consequuntur voluptate quibusdam repellendus adipisci, natus assumenda optio suscipit quis iure eveniet nobis vel sunt! Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, error similique? Reiciendis eius accusantium distinctio, enim consequuntur tempora, repudiandae, obcaecati iusto et architecto libero dolores nam eos. Accusamus, reprehenderit inventore.</p>
            </article>
            <article class="quienes-somos-img-container">
                <img class="quienes-somos-img" src="./imgs/QuienesSomos.jpg" alt="Quienes Somos">
            </article>

        </section>

        <section class="card-container">
            <h1 class="titulos">Propiedades Destacadas</h1>

            <?php
            $propiedadesDestacadas = array_slice($_SESSION['propiedadesDestacadas'], 0, 3); // solo extrae 3 propiedades destacadas
            foreach ($propiedadesDestacadas as $propiedad) {
            ?>
                <article class="card">
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
                <button class="learn-more">
                    <span class="circle" aria-hidden="true">
                        <span class="icon arrow"></span>
                    </span>
                    <span class="button-text">Ver mas</span>
                </button>
            </div>

        </section>

        <section class="ventas-container">
            <h1 class="titulos">Propiedades en venta</h1>
            <?php { //un map que se recorre printando todas las tarjetas de las propiedades Destacadas (Nombre, Descripcion, Precio, Imagen)  DEBAJO DEJO EL EJEMPLO DE LAS TARJETA
            } ?>

            <?php
            $propiedadesVentas = array_slice($_SESSION['propiedadesVentas'], 0, 3); // solo extrae 3 propiedades destacadas
            foreach ($propiedadesVentas as $propiedad) {
            ?>
                <article class="card">
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
                <button class="learn-more2">
                    <span class="circle2" aria-hidden="true">
                        <span class="icon2 arrow2"></span>
                    </span>
                    <span class="button-text2">Ver mas</span>
                </button>
            </div>
        </section>

        <section class="card-container">
            <h1 class="titulos">Propiedades en alquiler</h1>
            <?php { //un map que se recorre printando todas las tarjetas de las propiedades Destacadas (Nombre, Descripcion, Precio, Imagen)  DEBAJO DEJO EL EJEMPLO DE LAS TARJETA
            } ?>

            <?php
            $propiedadesAlquiler = array_slice($_SESSION['propiedadesAlquiler'], 0, 3); // solo extrae 3 propiedades destacadas
            foreach ($propiedadesAlquiler as $propiedad) {
            ?>
                <article class="card">
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
                <button class="learn-more">
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
                <h3>Direccion</h3>
                <p>Telefono: 123456789</p>
                <p>Email: info@utnrealstate.com</p>
            </article>

            <article class="footer-center">

                <article class="logo-footer-container">
                    <img class="logo-footer" src="./imgs/logo1.png" alt="Logo oscuro">
                </article>

                <article class="social-icons">
                    <a href="https://www.facebook.com/"><img src="./imgs/Facebook.png" alt="Facebook"></a>
                    <a href="https://www.youtube.com/"><img src="./imgs/Youtube.png" alt="YouTube"></a>
                    <a href="https://www.instagram.com/"><img src="./imgs/Instagram.png" alt="Instagram"></a>
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