{% extends 'layout.view.php' %}
{% block content %}
<h1 class="page-name">Login</h1>
<form class="form" action="/" id="login" method="POST">
    <fieldset>
        <legend><p class="page-description">Iniciar sesión</p></legend>
        <div id="alerts">
            
        </div>
        <div class="field">
            <label for="email">Correo electrónico</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="example@example.com"
                require>
        </div>
        <div class="field">
            <label for="password">Contraseña</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                placeholder="Contraseña..."
                require>
        </div>
        <div class="actions">
            <button type="submit" class="btn">Iniciar sesión</button>
            <a href="/forgout">¿Olvidaste tu contraseña? ¡Recupérala!</a>
            <a href="/signup">¿Aún no tienes una cuenta? ¡Crea una!</a>
        </div>
    </fieldset>
</form>
{% endblock %}