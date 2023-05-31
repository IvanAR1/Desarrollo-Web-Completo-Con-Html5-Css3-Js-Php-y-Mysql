{% extends 'layout.view.php' %}
{% block content %}
<h1 class="name-page">Confirmar cuenta</h1>
<p class="alert ok">
    {% for key,alert in alerts.exito %}
        {{ alert }}
    {% endfor %}
</p>
<a href="/"><button class="btn">Iniciar sesión</button></a>
{% endblock %}