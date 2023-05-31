<?php 
    require 'includes/app.php';
    includeTemplate('header');

?>
    <main class="contenedor">
        <h1>Anuncios</h1>
    </main>

    <section class ="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>
            <?php
                $limite = null;
                include 'includes/templates/anuncios.php';
            ?>
        </section>

<?php 

    includeTemplate('footer');

?>