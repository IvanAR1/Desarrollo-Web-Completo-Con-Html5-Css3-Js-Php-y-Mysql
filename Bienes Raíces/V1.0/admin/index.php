<?php
    require '../includes/app.php';
    esAutenticado();

use App\Propiedad;
use App\Vendedor;

$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

    /* Mostrar mensaje condicional */
    $resultado = $_GET['resultado']  ?? null;


    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id)
        {
            $tipo = $_POST['tipo'];
            if(validarTipoContenido($tipo))
            {
                if($tipo === 'propiedades')
                {
                    $propiedad = Propiedad::find($id);
                    $propiedad->delete();
                }
                elseif($tipo === 'vendedores')
                {
                    $vendedor = Vendedor::find($id);
                    $vendedor->delete();
                }
            }
        }
    }

    /* Incluye un template */
    includeTemplate('header');
?>
    
    <main class="contenedor seccion">
        <h1>Administrador de bienes raíces</h1>
        <?php $mensaje = Notification(intval($resultado));
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
        }?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde boton-admin">Crear Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-verde boton-admin">Crear Vendedor(a)</a>

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
                        <form method="POST" class="w-100">
                            <input type="hidden" name = "id" value = "<?php echo $propiedad->id;?>">
                            <input type="hidden" name = "tipo" value = "propiedades">
                            <button type="submit" onclick="validateForm(event)" class="boton-rojo-block">Eliminar</button>
                        </form>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
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
                        <form method="POST" class="w-100">
                            <input type="hidden" name = "id" value = "<?php echo $vendedor->id;?>">
                            <input type="hidden" name = "tipo" value = "vendedores">
                            <button type="submit" onclick="validateForm(event)" class="boton-rojo-block">Eliminar</button>
                        </form>
                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </main>
<?php
    includeTemplate('footer');
?>