<h1 class="nombre-pagina">Recuperar password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password en el sigueinte campo</p>
<?php include_once __DIR__ . '/../templates/alertas.php';?>


<form method="POST" class="formulario">

    <div class="campo">
        <label for="password">password</label>
        <input
             type="password"
             id="password"
             name="password"
             placeholder="Tu nueva contraseña"
        />
    </div>

    <input type="submit" class="boton" value="Cambiar contraseña">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Aun no tienes una cuenta? Registrate</a>
    <a href="/">Recordaste tu contraseña</a>
</div>