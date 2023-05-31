<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesión</h1>
    
    <?php foreach($errores as $error):?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Incorrecto',
                text: '<?php echo $error ?>',
            })
        </script>"
    <?php endforeach;?>

    <form class="formulario" method="POST">
        <fieldset class="form-login">
            <div class="imagen-contraseña">
                <img src="build/img/contraseña.png" alt = "icono de contraseña" loading ="lazy">
            </div>
            <legend class="legend">Correo y Contraseña</legend>
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="E-mail" id="email" required>

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Contraseña" id="password">
            <input class="boton-verde input" type="submit" value="Iniciar sesión" required>
        </fieldset>
    </form>
</main>