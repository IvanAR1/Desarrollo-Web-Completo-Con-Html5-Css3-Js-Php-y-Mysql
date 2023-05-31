<?php 
    require 'includes/app.php';
    includeTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>


        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">

            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                <legend>Información personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Coloca tu nombre" id="nombre">

                <label for="email">Correo</label>
                <input type="email" placeholder="Coloca tu correo" id="email">

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Coloca tu teléfono" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" placeholder="Coloca tu mensaje"></textarea>
            </fieldset><!-- Formulario para información personal -->

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o compra</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccionar --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="Coloca precio o presupuesto" id="presupuesto">
        </fieldset>
            
            <fieldset>
                <legend>Contacto</legend>
                <p>¿Cómo desea ser contactado?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">Correo</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">

                </div>

            <p>Si eligió teléfono, elija la fecha y la hora</p>
            
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00">

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">

        </form>

    </main>

<?php 

    includeTemplate('footer');

?>