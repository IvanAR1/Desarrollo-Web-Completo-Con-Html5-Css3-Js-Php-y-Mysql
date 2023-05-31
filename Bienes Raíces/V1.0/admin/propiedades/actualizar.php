<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';
    esAutenticado();

    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);

    if (!$id): header('Location: /admin'); endif;

    /* Consultar propiedades */
    $propiedad = Propiedad::find($id);
    $vendedores = Vendedor::all();

    $errores = Propiedad::getErrores();

    /* Ejecutar un código después de que el usuario envía el formulario y sea tipo POST*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);
        $errores = $propiedad->validate();

        //Revisar que el arreglo de errores quede vacío
        if(empty($errores))
        {
            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen'])
            {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $resultado = $propiedad->save();
        }
    }

    includeTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>
        <div class="error">
            <?php foreach($errores as $error): ?>
                <?php echo $error; ?>
            <?php endforeach; ?>
        </div>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario.propiedades.php'?>
            <input type="submit" value="Actualizar propiedad" class ="boton boton-verde">
        </form>
    </main>
<?php 

    includeTemplate('footer');

?>