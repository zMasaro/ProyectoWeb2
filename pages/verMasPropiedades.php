<?php
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);


    $propiedades = "";
    switch ($id) {
        case 1:
            $tipo = "propiedadesDestacadas";
            $titulo = "Propiedades Destacadas";
            break;
        case 2:
            $tipo = "propiedadesAlquiler";
            $titulo = "Propiedades en Alquiler";
            break;
        case 3:
            $tipo = "propiedadesVentas";
            $titulo = "Propiedades en Venta";
            break;
        default:
            echo "Tipo de propiedad no válido.";
            exit;
    }
} else {
    echo "No se ha especificado el tipo de propiedad.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades</title>
    <link rel="stylesheet" href="../styles/index.css">
</head>

<body>

    <Header>
        <section class="header-left">
            <div class="logo-container">
                <img class="logo-principal" src="../imgs/logo2.png" alt="logo">
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

            <div class="buscador">
                <input type="text" placeholder="Ingrese su busqueda">
                <button type="submit">Buscar</button>
            </div>
        </section>
    </Header>

    <section class="card-container">
        <h1 class="titulos"><?php echo $titulo?></h1>

        <?php

        $propiedades = $_SESSION[$tipo];

        foreach ($propiedades as $propiedad) {
        ?>
            <article class="card" onclick="location.href='propiedad.php?id=<?= $propiedad['id']?>'">
                <div class="card-img-container">
                    <img class="card-img" src="../<?= htmlspecialchars($propiedad['img_link']) ?>" alt="Foto Propiedad">
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
    </section>
</body>

</html>