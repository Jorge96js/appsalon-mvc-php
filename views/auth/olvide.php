<h1 class="nombre-pagina">Recuperar contraseña </h1>
<p class="descripcion-pagina">Restablece tu contraseña escribiendo tu email a continuacion</p>
<?php
include_once __DIR__ . "/../templates/alertas.php";

?>
<form class="formulario" aria-roledescription="/olvide" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email"
         name="email" id="email"/>
    </div>
    <input type="submit" value="Enviar instrucciones" class="boton">
</form>

<div class="acciones">
    <a href="/">Ya tienes una cuenta? Inicia sesion!</a>
    <a href="/crear-cuenta">Aùn no tienes una cuenta? Registrate!</a>
</div>