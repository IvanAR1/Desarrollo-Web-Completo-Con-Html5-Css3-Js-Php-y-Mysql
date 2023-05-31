<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php
        if($mensaje != null)
        {
            echo
            "<script>
                Swal.fire(
                    '".$mensaje['title']."',
                    '".$mensaje['message']."',
                    '".$mensaje['status']."',
                );
            </script>
            ";
        }
        ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">

        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form class="formulario" method="POST">
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Coloca tu nombre" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" placeholder="Coloca tu mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset><!-- Formulario para información personal -->

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o compra</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccionar --</option>
                <option value="Comprar">Comprar</option>
                <option value="Vender">Vender</option>
            </select>

        <label for="presupuesto">Precio o presupuesto</label>
        <input type="number" placeholder="Coloca precio o presupuesto" id="presupuesto" name="contacto[presupuesto]" required>
    </fieldset>
        
        <fieldset>
            <legend>Contacto</legend>
            <p>¿Cómo desea ser contactado?</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input for="telefono" type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                <label for="contactar-email">Correo</label>
                <input type="radio" value="correo" id="contactar-email" name="contacto[contacto]" required>
            </div>
        
        <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">

    </form>

</main>