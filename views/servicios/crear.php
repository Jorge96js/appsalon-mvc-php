<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llenar todos los campos para añadir un nuevo servicio</p>

<?php include_once __DIR__ . '/../templates/nav.php'?>
<?php include_once __DIR__ . '/../templates/alertas.php'?>
 <form action="/crear" method="post" class="formulario">
    <?php include_once __DIR__ . '/form.php'?>
    <input type="submit" value="Guardar" class="boton">
</form>