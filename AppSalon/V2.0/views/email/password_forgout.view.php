<html>

<head>
    <title>¡Valida tu correo!</title>
    <style>
        body {
            margin: 2rem;
            background-color: #1a1b15;
            display: flex;
            align-items: center;
            flex-direction: column;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #999;
        }
        h1 {
            color: #00bfff;
            margin-bottom: 20px;
        }
        li
        {
            list-style-type: decimal;
        }
        section, h1, h2
        {
            text-align: center;
            width: 100%;
        }

        ul, p
        {
            margin-left: 1rem;
            text-align: left;
        }
        section.img {
            background-color: #00bfff;
            background-size: 100%;
            max-height: 50%;
        }
        section.body
        {
            border: 2px solid azure;
            border-top-color: transparent;
        }
        section img
        {
            max-width: 15rem;
            max-height: 15rem;
            height: auto;
        }
        a
        {
            text-decoration: underline;
            color: inherit;
        }
    </style>
</head>
<body>
    <section class="img">
        <img src="cid:logo" alt="Logotipo">
    </section>
    <section class="body">
        <h1>¡Estimado/a {{RecipientUser}}!</h1>
        <h2>¡Te hemos enviado el email de recuperación de contraseña!</h2>
        <p>Si no realizaste esta solicitud, ignora este mensaje. Si fuiste tú quien solicitó el cambio, sigue las instrucciones a continuación:</p>
        <ul>
            <li> Haz click en el enlace que se te proporcionó a continuación: <a href="{{URL}}/rescue?token={{RecipientToken}}" type="button">Recuperar</a>.</li>
            <li> Se te redirigirá a una página para obtener una nueva contraseña. Asegúrate de elegir una contraseña segura que incluya una combinación de letras, números y caracteres especiales.</li>
        </ul>
        <p>Si tienes algún problema para restablecer tu contraseña o si necesitas ayuda adicional, no dudes en contactarnos.</p>
        <h3>Atte.</h3>
        <h3>El equipo de TI de App Salón</h3>
    </section>
</body>
</html>