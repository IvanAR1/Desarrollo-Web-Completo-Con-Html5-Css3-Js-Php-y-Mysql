<?php 
    require '../../includes/app.php';
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    esAutenticado();
    includeTemplate('header');

    $propiedad = new Propiedad;
    $vendedores = Vendedor::all();

    $errores = Propiedad::getErrores();

    /* Ejecutar un código después de que el usuario envía el formulario y sea tipo POST*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $propiedad = new Propiedad($_POST['propiedad']);
        $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";
        if($_FILES['propiedad']['tmp_name']['imagen'])
        {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        $errores = $propiedad->validate();
        if(empty($errores))
        {
            if(!is_dir(CARPETA_IMAGENES))
            {
                mkdir(CARPETA_IMAGENES);
            }

            $image->save(CARPETA_IMAGENES . $nombreImagen);

            $resultado = $propiedad->save();
        }
    }

?>

    <main class="contenedor seccion">
        <h1>Registrar propiedad</h1>
        <div class="error">
        <?php foreach($errores as $error): ?>
            <br>
                <?php echo $error; ?>
            </br>
        <?php endforeach; ?>
        </div>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario.propiedades.php'?>
            <input type="submit" value="Crear propiedad" class ="boton boton-verde">
        </form>
    </main>

<?php 
    includeTemplate('footer');
?>