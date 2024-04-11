<h1 class="nombre-pagina">crear cuenta</h1>
<p class="descripcon-pagina">Completa el formulario para crear una cuenta!</p>

<?php
include_once __DIR__ . "/../templates/alertas.php";

?>

<form action="/crear-cuenta" method="POST" class="formulario">
    <div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text"
        id="nombre"
        name="nombre"
        placeholder="tu nombre"
        value="<?php s($usuario->nombre); ?>"
    />
    </div>

    <div class="campo">
    <label for="apellido">Apellido</label>
    <input type="text"
        id="apellido"
        name="apellido"
        placeholder="tu apellido"
        value="<?php s($usuario->apellido); ?>"
    />
    </div>

    <div class="campo">
    <label for="telefono">Telefono</label>
    <input type="tel"
        id="telefono"
        name="telefono"
        placeholder="tu telefono"
        value="<?php s($usuario->telefono); ?>"
    />
    </div>

    <div class="campo">
    <label for="email">E-mail</label>
    <input type="email"
        id="email"
        name="email"
        placeholder="tu E-mail"
        value="<?php s($usuario->email); ?>"
    />
    </div>

    <div class="campo">
    <label for="password">Contraseña</label>
    <input type="password"
        id="password"
        name="password"
        placeholder="tu Contraseña"
    />
    </div>

    <input type="submit" value="Registrar cuenta" class="boton">
</form>

<div class="acciones">
    <a href="/">Ya tienes una cuenta? Inicia sesion!</a>
    <a href="/olvide">Recuperar contraseña</a>
</div>