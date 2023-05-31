<fieldset>
    <legend>Información general</legend>
    <label for="nombre">Nombre:</label>
    <input type="text"
    id="nombre"
    name="vendedor[nombre]"
    placeholder="Nombre del vendedor(a)"
    value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido(s):</label>
    <input type="text"
    id="apellido"
    name="vendedor[apellido]"
    placeholder="Apellidos del vendedor(a)"
    value="<?php echo s($vendedor->apellido); ?>">

    <label for="telefono">Teléfono:</label>
    <input type="tel"
    id="telefono"
    name="vendedor[telefono]"
    placeholder="Teléfono del vendedor(a)"
    value="<?php echo s($vendedor->telefono); ?>">
</fieldset>