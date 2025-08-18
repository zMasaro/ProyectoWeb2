<?php
require_once __DIR__ . '/../includes/auth.php';
require_admin();

if (!isset($_SESSION['color-principal'])) $_SESSION['color-principal'] = '#10104b';
if (!isset($_SESSION['color-secundario'])) $_SESSION['color-secundario'] = '#c7c400';
if (!isset($_SESSION['color-terciario'])) $_SESSION['color-terciario'] = '#000000';
if (!isset($_SESSION['color-claro'])) $_SESSION['color-claro'] = '#ffffff';

if (!isset($_SESSION['icono-principal'])) $_SESSION['icono-principal'] = 'imgs/logo1.png'; // Ruta del icono principal
if (!isset($_SESSION['icono-blanco'])) $_SESSION['icono-blanco'] = 'imgs/logo2.png'; // Ruta del icono blanco


if (!isset($_SESSION['img-banner'])) $_SESSION['img-banner'] = 'imgs/banner.jpg'; // Ruta del icono principal
if (!isset($_SESSION['texto-banner'])) $_SESSION['texto-banner'] = "PERMITENOS AYUDARTE A CUMPLIR TUS SUEÑOS"; // Ruta del icono blanco

if (!isset($_SESSION['img-somos'])) $_SESSION['img-somos'] = 'imgs/QuienesSomos.jpg';
if (!isset($_SESSION['texto-somos'])) $_SESSION['texto-somos'] = "Somos una empresa dedicada a brindar soluciones inmobiliarias de calidad, con un equipo comprometido a ayudarte a encontrar el lugar perfecto para ti.";

if (!isset($_SESSION['url-yt'])) $_SESSION['url-yt'] = 'https://www.youtube.com/'; // URL de YouTube
if (!isset($_SESSION['url-fb'])) $_SESSION['url-fb'] = 'https://www.facebook.com/'; // URL de Facebook
if (!isset($_SESSION['url-ins'])) $_SESSION['url-ins'] = 'https://www.instagram.com/'; // URL de Instagram

if (!isset($_SESSION['texto-direccion'])) $_SESSION['texto-direccion'] = '300 metros norte y 200 este del liceo Maurilio Alvarado Vargas';
if (!isset($_SESSION['texto-telefono'])) $_SESSION['texto-telefono'] = '123456789';
if (!isset($_SESSION['texto-correo'])) $_SESSION['texto-correo'] = 'info@utnrealstate.com';






//algo asi la validacion que iria en index.php
/*verifica si el usuario ha iniciado sesión y si su rol es 'administrador'
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'administrador') {
    header('Location: ../index.php');
    exit();
}*/

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
                <img class="logo-principal" src="../<?php echo $_SESSION['icono-principal'] ?>" alt="logo">
            </div>
            <div class="social-icons">
                <a href="<?php echo $_SESSION['url-fb'] ?>"><img src="../imgs/Facebook.png" alt="Facebook"></a>
                <a href="<?php echo $_SESSION['url-yt'] ?>"><img src="../imgs/Youtube.png" alt="YouTube"></a>
                <a href="<?php echo $_SESSION['url-ins'] ?>"><img src="../imgs/Instagram.png" alt="Instagram"></a>
            </div>

        </section>

        <section class="header-right">
            <div class="social-icons">
                <img class="logo-cuenta" src="../imgs/cuenta.png" alt="cuenta">
            </div>

            <nav>
                <a href="../index.php">INICIO</a> |
                <a href="../index.php#QuienesSomos">QUIENES SOMOS</a> |
                <a href="verMasPropiedades.php?id=1">DESTACADAS</a> |
                <a href="verMasPropiedades.php?id=2">ALQUILERES</a> |
                <a href="verMasPropiedades.php?id=3">VENTAS</a> |
                <a href="mis_propiedades.php">MIS PROPIEDADES</a> |
                <a href="usuarios.php">USUARIOS</a> |
                <a href="perfil.php">MI PERFIL</a> |
                <a href="../logout.php">SALIR</a>
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
            <input type="color" name="color-terciario" value="<?= $_SESSION['color-terciario'] ?>"><br>
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
            <button type="submit">Actualizar</button><br><br><br>
        </form>
    </section>


    <section class="form-container">
        <form action="../includes/formularios/banner.php" method="post" enctype="multipart/form-data">
            <label for="nueva_imagen">Editar Banner Principal</label><br>
            <input type="file" name="nueva_imagen" required><br><br>
            <label for="texto-banner">Editar Mensaje Del Banner Principal</label><br>
            <input type="text" name="texto-banner" required><br>
            <button type="submit">Actualizar</button><br><br>
        </form>
    </section>

    <section class="form-container">
        <form action="../includes/formularios/somos.php" method="post" enctype="multipart/form-data">
            <label for="nueva_imagen">Editar Imagen Quienes Somos</label><br>
            <input type="file" name="nueva_imagen" required><br><br>
            <label for="texto-somos">Editar Mensaje Del Cuadro Quienes Somos</label><br>
            <textarea name="texto-somos" id="mensaje" require></textarea><br>
            <button type="submit">Actualizar</button><br><br>
        </form>
    </section>


    <section class="form-container">
        <form action="../includes/formularios/urls.php" method="post" enctype="multipart/form-data">
            <label for="texto-yt">URL de Youtube</label><br>
            <input type="text" name="texto-yt" required><br>
            <label for="texto-fb">URL de Facebook</label><br>
            <input type="text" name="texto-fb" required><br>
            <label for="texto-ins">URL de Instagram</label><br>
            <input type="text" name="texto-ins" required><br>

            <button type="submit">Actualizar</button><br><br>
        </form>
    </section>

    <section class="form-container">
        <form action="../includes/formularios/info.php" method="post" enctype="multipart/form-data">
            <label for="texto-direccion">Direccion</label><br>
            <input type="text" name="texto-direccion" required><br>
            <label for="texto-telefono">Numero de Telefono</label><br>
            <input type="text" name="texto-telefono" required><br>
            <label for="texto-correo">Correo electronico</label><br>
            <input type="text" name="texto-correo" required><br>

            <button type="submit">Actualizar</button><br><br>
        </form>
    </section>

    <footer>
        <section class="footer-amarillo">
            <article class="footer-left">
                <h3>Direccion: <?php echo htmlspecialchars($_SESSION['texto-direccion']); ?></h3>
                <p>Telefono: <?php echo htmlspecialchars($_SESSION['texto-telefono']); ?></p>
                <p>Email: <?php echo htmlspecialchars($_SESSION['texto-correo']); ?></p>
            </article>

            <article class="footer-center">

                <article class="logo-footer-container">
                    <img class="logo-footer" src="../<?php echo $_SESSION['icono-blanco'] ?>" alt="Logo oscuro">
                </article>

                <article class="social-icons">
                    <a href="<?php echo $_SESSION['url-fb'] ?>"><img src="../imgs/Facebook.png" alt="Facebook"></a>
                    <a href="<?php echo $_SESSION['url-yt'] ?>"><img src="../imgs/Youtube.png" alt="YouTube"></a>
                    <a href="<?php echo $_SESSION['url-ins'] ?>"><img src="../imgs/Instagram.png" alt="Instagram"></a>
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