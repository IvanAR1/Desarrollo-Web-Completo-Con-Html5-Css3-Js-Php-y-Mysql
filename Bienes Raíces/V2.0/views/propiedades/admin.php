<main class="contenedor seccion">
        <h1>Administrador de bienes raíces</h1>
        <?php
        if($resultado)
        {
            $mensaje = Notification(intval($resultado));
            if($mensaje['title'] != null)
            {
                echo
                "<script>
                    Swal.fire(
                        '".$mensaje['title']."',
                        '".$mensaje['message']."',
                        'success'
                    );
                </script>
                ";
            }
        }
        ?>
        <a href="/propiedades/crear" class="boton boton-verde boton-admin">Crear Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-verde boton-admin">Crear Vendedor(a)</a>

        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody><!-- Mostrar los resultados -->
                <?php foreach($propiedades as $propiedad):?>
                <tr>
                    <td class="modificar"><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td><?php echo "$",$propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name = "id" value = "<?php echo $propiedad->id;?>">
                            <input type="hidden" name = "tipo" value = "propiedades">
                            <button type="submit" onclick="validateForm(event)" class="boton-rojo-block">Eliminar</button>
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody><!-- Mostrar los resultados -->
                <?php foreach($vendedores as $vendedor):?>
                <tr>
                    <td class="modificar"><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre; ?></td>
                    <td><?php echo $vendedor->apellido;?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name = "id" value = "<?php echo $vendedor->id;?>">
                            <input type="hidden" name = "tipo" value = "vendedores">
                            <button type="submit" onclick="validateForm(event)" class="boton-rojo-block">Eliminar</button>
                        </form>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
</main>