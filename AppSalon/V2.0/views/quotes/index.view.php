{% extends 'layout.view.php' %}
{% block content %}
<h1 class="name-page">App Peluqueria</h1>
<p class="page-description">Elije tus servicios y coloca tus datos.</p>

<div class="app">
    <nav class="tabs">
        <button class="btn btn-tab actual" type="button" data-step="1">Servicios</button>
        <button class="btn btn-tab" type="button" data-step="2">Información Cliente</button>
        <button class="btn btn-tab" type="button" data-step="3">Resumen</button>
    </nav>
    <div id="step-1" class="section">
        <h2>Servicios</h2>
        <p class="text-center">Elije tus servicios a continuación.</p>
        <div id="quotes" class="list-services"></div>
    </div>
    <div id="step-2" class="section">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita.</p>

        <form class="form">
            <div class="field">
                <label for="name">Nombre</label>
                <input id="name" type="text" placeholder="Coloca tu nombre" value="{{username}}" disabled>
            </div>
            <div class="field">
                <label for="date">Fecha</label>
                <input id="date" type="date" min="{{min_date}}">
            </div>
            <div class="field">
                <label for="time">Hora</label>
                <input id="time" type="time">
            </div>
        </form>
    </div>
    <div id="step-3" class="section">
        <div id="title-summary">
            <h2>Resumen</h2>
            <p class="text-center">Verifica que la información sea correcta.</p>
        </div>
        <div class="content-summary"></div>
    </div>
    <div class="pagination">
        <button class="btn btn-page" id="before">&laquo; Anterior</button>
        <button class="btn btn-page" id="after">Siguiente &raquo;</button>
    </div>
</div>
{% endblock %}