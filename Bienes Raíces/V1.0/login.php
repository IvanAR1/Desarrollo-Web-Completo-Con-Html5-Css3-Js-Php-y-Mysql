<?php 
    $email = null;

    require 'includes/app.php';
    $db = conectarDB();

    //Autenticar usuarios

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email or !$password): $errores[] = "El email y la contraseña son obligatorios o no son válidos";endif;
    }

    if(empty($errores) and $email <> null)
    {
        $query = "SELECT * FROM login Where email = '${email}'";
        $resultado = mysqli_query($db, $query);

        if($resultado->num_rows): $usuario = mysqli_fetch_assoc($resultado);
            $auth = password_verify($password, $usuario['password']);
            if($auth): session_start();
            $_SESSION['usuario'] = $usuario['email'];
            $_SESSION['login'] = true;
            header('Location: /admin');
            var_dump($_SESSION);
            else: $errores[]= 'La contraseña es incorrecta';
            endif;
        else: $errores[] = "El usuario no existe";
        endif;
    }

    includeTemplate('header');
?>

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
            <input type="email" name="email" placeholder="E-mail" id="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Contraseña" id="password">
            <input class="boton-verde input" type="submit" value="Iniciar sesión">
        </fieldset>
    </form>
    </main>
<?php 

    includeTemplate('footer');

?>