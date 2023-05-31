<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>
        <div class="error">
            <?php foreach($errores as $error): ?>
                <br>
                    <?php echo $error; ?>
                </br>
            <?php endforeach; ?>
        </div>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario" method="POST">
            <?php include __DIR__ . '/formulario.php'?>
            <input type="submit" value="Crear Vendedor(a)" class ="boton boton-verde">
        </form>
</main>