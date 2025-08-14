<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTN Real State</title>
</head>

<body>
    <Header>

        <section class="logo-container">
            <img class="logo-principal" src="" alt="">
        </section>

        <div class="social-icons">
            <a href=""><img src="facebook.png" alt="Facebook"></a>
            <a href=""><img src="youtube.png" alt="YouTube"></a>
            <a href=""><img src="instagram.png" alt="Instagram"></a>
        </div>

        <nav>
            <a href="">INICIO</a>
            <a href="">QUIENES SOMOS</a>
            <a href="">ALQUILERES</a>
            <a href="">VENTAS</a>
            <a href="">CONTACTANOS</a>
        </nav>

        <section class="icon-cuenta">
            <img class="logo-cuenta" src="" alt="">
        </section>

        <div class="buscador">
            <input type="text" placeholder="Ingrese su busqueda">
            <button type="submit">Buscar</button>
        </div>

    </Header>

    <main>

        <section class="banner">
            <img class="banner-principal" src="" alt="">
            <article class="texto-banner">
                <p>TEXTO DEL BANNER AQUI</p>
            </article>
        </section>

        <section class="quienes-somos">
            <article class="quienes-somos-img-container">
                <img class="quienes-somos-img" src="" alt="">
            </article>

            <article class="texto-quienes-somos">
                <p>QUIENES SOMOS AQUI</p>
            </article>
        </section>

        <section class="propiedades-destacadas">
            <?php { //un map que se recorre printando todas las tarjetas de las propiedades Destacadas (Nombre, Descripcion, Precio, Imagen)  DEBAJO DEJO EL EJEMPLO DE LAS TARJETA
            } ?>
            <section class="card">

                <section class="card-img-container">
                    <img class="card-img" src="" alt="">
                </section>

                <section class="card-titulo">
                    <h3>Nombre de la propiedad</h3>
                </section>

                <section class="card-descripcion">
                    <p>Descripcion de la propiedad</p>
                    <p>Precio 2.99</p>
                </section>

            </section>
            <button>VER MAS...</button>
        </section>

        <section class="propiedades-en-venta">
            <?php { //un map que se recorre printando todas las tarjetas de las propiedades Destacadas (Nombre, Descripcion, Precio, Imagen)  DEBAJO DEJO EL EJEMPLO DE LAS TARJETA
            } ?>
            <section class="card">

                <section class="card-img-container">
                    <img class="card-img" src="" alt="">
                </section>

                <section class="card-titulo">
                    <h3>Nombre de la propiedad</h3>
                </section>

                <section class="card-descripcion">
                    <p>Descripcion de la propiedad</p>
                    <p>Precio 2.99</p>
                </section>

            </section>
            <button>VER MAS...</button>
        </section>

        <section class="propiedades-en-alquiler">
            <?php { //un map que se recorre printando todas las tarjetas de las propiedades Destacadas (Nombre, Descripcion, Precio, Imagen)  DEBAJO DEJO EL EJEMPLO DE LAS TARJETA
            } ?>
            <section class="card">

                <section class="card-img-container">
                    <img class="card-img" src="" alt="">
                </section>

                <section class="card-titulo">
                    <h3>Nombre de la propiedad</h3>
                </section>

                <section class="card-descripcion">
                    <p>Descripcion de la propiedad</p>
                    <p>Precio 2.99</p>
                </section>

            </section>
            <button>VER MAS...</button>
        </section>

    </main>

    <footer>
        <section class="footer-amarillo">
            <article class="footer-izquierda">
                <h3>Direccion</h3>
                <p>Telefono: 123456789</p>
                <p>Email: info@utnrealstate.com</p>
            </article>

            <article class="footer-central">

                <article>
                    <img src="" alt="">
                </article>

                <article class="social-icons-footer">
                    <a href=""><img src="facebook.png" alt="Facebook"></a>
                    <a href=""><img src="youtube.png" alt="YouTube"></a>
                    <a href=""><img src="instagram.png" alt="Instagram"></a>
                </article>

            </article>

            <article>
                <h3>Contactanos</h3>
                <form action="">
                    <label for="Nombre">Nombre:</label>
                    <input type="text" placeholder="Nombre"><br>
                    <label for="Telefono">Telefono:</label>
                    <input type="int" placeholder="Telefono"><br>
                    <label for="Email">Email:</label>
                    <input type="email" placeholder="Email"><br>
                    <label for="Mensaje">Mensaje:</label>
                    <textarea placeholder="Mensaje"></textarea><br>
                    <button type="submit">Enviar</button>
                </form>
            </article>
        </section>

        <section class="footer-final">
            <p>UTN Real State - Todos los derechos reservados 2024</p>
        </section>

    </footer>
</body>

</html>