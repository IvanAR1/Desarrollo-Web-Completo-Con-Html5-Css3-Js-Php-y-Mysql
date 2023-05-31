<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio))
    {
        $inicio = false;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raíces</title>
    <link rel="stylesheet" href="../build/css/app.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '';?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt ="Logo de bienes raices">
                        </a>
                        <div class="mobile-menu">
                            <img src="/build/img/barras.svg" alt="icono menu responsive">
                        </div>
    
                        <div class="derecha">
                            <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                            <nav class="navegacion mostrar">
                                <a href="/nosotros">Nosotros</a>
                                <a href="/anuncios">Anuncios</a>
                                <a href="/blog">Blog</a>
                                <a href="/contacto">Contacto</a>
                                <?php if($auth): ?>
                                    <a href="/logout">Cerrar Sesión</a>
                                <?php endif?> 
                            </nav>
                        </div>
                </div> <!-- Fin de clase barra -->
        <?php
            if($inicio): echo "<h1>Venta de casas y <span>departamentos de lujos</span></h1>"; endif;
        ?>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros">Nosotros</a>
                <a href="anuncios">Anuncios</a>
                <a href="blog">Blog</a>
                <a href="contacto">Contacto</a>
            </nav>
        </div>


    <p class="copyright">Todos los derechos reservados <?php echo date('Y');?> &copy;</p>
</footer>
<script src="../build/js/bundle.min.js"></script>
</body>
</html>