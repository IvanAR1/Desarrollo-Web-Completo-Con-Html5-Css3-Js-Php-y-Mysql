<?php 
    require '../../includes/app.php';
    use App\Vendedor;

    esAutenticado();

    $errores = Vendedor::getErrores();
    $id=$_GET['id'];
    $id=filter_var($id, FILTER_VALIDATE_INT);
    if(!$id)
    {
        header('Location: /admin');
    }
    $vendedor = Vendedor::find($id);
    $errores = Vendedor::getErrores();
    /* Ejecutar un código después de que el usuario envía el formulario y sea tipo POST*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $args = $_POST['vendedor'];
        $vendedor->sincronizar($args);
        $errores = $vendedor->validate();
        if(empty($errores))
        {
            $vendedor->save();
        }

    }
    includeTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>
        <div class="error">
        <?php foreach($errores as $error): ?>
            <br>
                <?php echo $error; ?>
            </br>
        <?php endforeach; ?>
        </div>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario.vendedores.php'?>
            <input type="submit" value="Actualizar Vendedor(a)" class ="boton boton-verde">
        </form>
    </main>

<?php 
    includeTemplate('footer');
?>