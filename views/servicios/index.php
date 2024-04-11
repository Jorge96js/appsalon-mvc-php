<h1 class="nombre-pagina">Servicios</h1><p class="descripcion-pagina">Administracion de servicios</p>

<?php
    include_once  __DIR__ . '/../templates/nav.php';
?>

<?php foreach($servicios as $servicio):?>
    <ul class="servicios">
        <li><p>Nombre: <span><?php echo $servicio->nombre?></span></p>
        <p>Precio: $<span><?php echo $servicio->precio?></span></p>
            <div class="acciones">
                <a class="boton" href="servicios/actualizar?id=<?php echo $servicio->id?>">Actualizar</a>
                
                <form action="/servicios/eliminar" method="post">
                    <input type="hidden" name="id" value="<?php echo $servicio->id?>">
                    <input type="submit" value="Borrar" class="boton-eliminar">
                </form>
            </div>
        </li>
</ul>
<?php endforeach;?>