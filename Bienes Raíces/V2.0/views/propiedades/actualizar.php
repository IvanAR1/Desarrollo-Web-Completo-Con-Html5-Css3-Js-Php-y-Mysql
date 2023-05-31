<main class="contenedor seccion">
    <h1>Actualizar propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <div class="error">
        <?php foreach($errores as $error): ?>
            <br>
                <?php echo $error; ?>
            </br>
        <?php endforeach; ?>
    </div>
    
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'?>
        <input type="submit" value="Actualizar propiedad" class ="boton boton-verde">
    </form>
    
</main>