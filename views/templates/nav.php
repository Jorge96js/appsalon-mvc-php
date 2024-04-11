<nav class="barra">
        <div class="contenedor-usuario">
            <h4>Bienvenido: <?php echo $nombre?></h4>
        </div>

        <div class="sesion">
            <a class="boton" href="/logout">Cerrar sesion</a>
        </div>
</nav>

<?php 
    if(isset($_SESSION['admin'])){
    ?>

    <nav class="barra">
        <div class="barra-servicios">
        <a href="/citas" class="boton">Ver citas</a>
        <a href="/servicios" class="boton">Ver servicios</a>
        <a href="/crear" class="boton">Nuevo servicio</a>
        </div>
    </nav>

   <?php } ?>