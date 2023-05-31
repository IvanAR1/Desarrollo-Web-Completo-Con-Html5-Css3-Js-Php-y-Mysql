{% extends 'layout.view.php' %}
{% block content %}
<h1 class="page-name">¡Regístrate!</h1>

<form class="form" id="register" action="/signup" method="POST">
    <fieldset>
        <legend><p class="page-description">Registrar usuario</p></legend>
        <div id="alerts">
            
        </div>
        <div class="field">
            <label for="rname">Nombre</label>
            <input 
                type="text" 
                name="register[name]"
                id="rname" 
                placeholder="Nombre(s)">
        </div>
        <div class="field">
            <label for="rlname">Apellidos</label>
            <input 
                type="text" 
                name="register[father_lname]" 
                id="rlname"
                aria-describedby="rmotherLname"
                placeholder="Paterno">
            <input 
                type="text" 
                name="register[mother_lname]" 
                id="rmotherLname"
                placeholder="Materno">
        </div>
        <div class="field">
            <label for="rtel">Teléfono</label>
            <input 
                type="tel" 
                name="register[cellphone]" 
                id="rtel" 
                placeholder="Teléfono">
        </div>
        <div class="field">
            <label for="remail">Correo electrónico</label>
            <input 
                type="email" 
                name="register[email]" 
                id="remail" 
                placeholder="Correo">
        </div>
        <div class="field">
            <label for="rpassword">Contraseña</label>
            <input 
                type="password" 
                name="register[password]" 
                id="rpassword" 
                placeholder="Contraseña">
        </div>
        <div class="actions">
            <button type="submit" class="btn">Crear cuenta</button>
            <a href="/forgout">¿Olvidaste tu contraseña? ¡Recupérala!</a>
            <a href="/">¿Ya tienes una cuenta? ¡Accede ya!</a>
        </div>
    </fieldset>
</form>
{% endblock %}