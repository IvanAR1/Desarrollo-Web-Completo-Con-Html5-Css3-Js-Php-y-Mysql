{% extends 'layout.view.php' %}
{% block content %}
<h1 class="page-name">Reestablece tu contraseña</h1>
<form class="form" action="/rescue" id="rescue">
    <fieldset>
        <legend><p class="page-description">Reestablecer contraseña</p></legend>
        <div id="alerts"></div>
        <div class="field">
            <label for="password">Contraseña</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                placeholder="Contraseña..."
                require>
        </div>
        <div class="field">
            <label for="v-password">Confirma tu contraseña</label>
            <input 
                type="password" 
                name="v-password" 
                id="v-password" 
                placeholder="Validar contraseña..."
                require>
        </div>
        <div class="actions">
            <button type="submit" class="btn">Reestablecer contraseña</button>
            <a href="/signup">¿Aún no tienes una cuenta? ¡Crea una!</a>
            <a href="/">¿Ya tienes una cuenta? ¡Accede ya!</a>
        </div>
    </fieldset>
</form>
{% endblock %}