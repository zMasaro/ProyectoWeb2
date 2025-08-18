<?php
session_start();
require_once __DIR__ . '/../includes/conexion.php';

$propiedadEncontrada = null;
$usuarioPropietario = null;
if (isset($_GET['id'])) {
    $propiedadId = (int)$_GET['id'];
    if ($stmt = mysqli_prepare($conexion, 'SELECT p.*, u.nombre AS agente_nombre FROM propiedades p INNER JOIN usuario u ON u.id = p.id_usuario WHERE p.id = ? LIMIT 1')) {
        mysqli_stmt_bind_param($stmt, 'i', $propiedadId);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $propiedadEncontrada = mysqli_fetch_assoc($res) ?: null;
    }
    if (!$propiedadEncontrada) {
        http_response_code(404);
        echo 'Propiedad no encontrada';
        exit;
    }
} else {
    http_response_code(400);
    echo 'No se proporcionó un ID de propiedad.';
    exit;
}
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($propiedadEncontrada['titulo']); ?></title>
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
                <a href="#Contactanos">CONTACTANOS</a>
            </nav>
        </section>
    </Header>


    <section class="product-container">
        <div class="product-img-container">
            <img class="product-img" src="../<?= htmlspecialchars($propiedadEncontrada['img_link']) ?>" alt="Foto Propiedad">
        </div>
        <div class="product-details">
            <h3><?= htmlspecialchars($propiedadEncontrada['titulo']) ?></h3>


            <?php
            if ((int)$propiedadEncontrada['id_tipo'] == 1) {
                echo '<p>Tipo: Alquiler</p>';
            } else {
                echo '<p>Tipo: Venta</p>';
            }

            if ((int)$propiedadEncontrada['destacada']) {
                echo '<p>Destacada</p>';
            }
            ?>
            <p>Descripcion breve: <?= htmlspecialchars($propiedadEncontrada['descripcion_breve']) ?></p>
            <p>Precio: $<?= htmlspecialchars($propiedadEncontrada['precio']) ?></p>
            <p>Agente: <?= htmlspecialchars($propiedadEncontrada['agente_nombre']) ?></p>
            <p>Descripcion completa: <?= htmlspecialchars($propiedadEncontrada['descripcion_larga']) ?></p>
            <p>Ubicacion: <?= htmlspecialchars($propiedadEncontrada['ubicacion']) ?></p>
            <?php if (!empty($propiedadEncontrada['mapa_link'])): ?>
                <img class="product-map" src="../<?= htmlspecialchars($propiedadEncontrada['mapa_link']) ?>" alt="Foto Mapa">
            <?php endif; ?>


        </div>



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