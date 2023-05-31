{% extends 'layout.view.php' %}
{% block content %}
<h1 class="page-name">Olvide contraseña</h1>
<p class="page-description">Reestablece tu contraseña, ingresando tu email.</p>
<form class="form" id="forgout" action="/forgout" method="POST">
        <div id="alerts">
            
        </div>
        <div class="field">
            <label for="email">Correo electrónico</label>
            <input 
                type="email" 
                name="login[email]" 
                id="email" 
                placeholder="example@example.com">
        </div>
        <div class="actions">
            <button type="submit" class="btn">Enviar instrucciones</button>
            <a href="/signup">¿Aún no tienes una cuenta? ¡Crea una!</a>
            <a href="/">¿Ya tienes una cuenta? ¡Accede ya!</a>
        </div>
</form>
{% endblock %}