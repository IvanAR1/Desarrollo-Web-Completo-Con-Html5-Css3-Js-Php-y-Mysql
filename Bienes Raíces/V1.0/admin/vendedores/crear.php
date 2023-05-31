<?php 
    require '../../includes/app.php';
    use App\Vendedor;
    
    esAutenticado();
    includeTemplate('header');

    $vendedor = new Vendedor();

    $errores = Vendedor::getErrores();

    /* Ejecutar un código después de que el usuario envía el formulario y sea tipo POST*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $vendedor = new Vendedor($_POST['vendedor']);
        $errores = $vendedor->validate();

        if(empty($errores))
        {
            $vendedor->save();
        }
    }

?>

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

        <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
            <?php include '../../includes/templates/formulario.vendedores.php'?>
            <input type="submit" value="Crear Vendedor(a)" class ="boton boton-verde">
        </form>
    </main>

<?php 
    includeTemplate('footer');
?>