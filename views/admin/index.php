<h1 class="nombre-pagina">Panel de administrador</h1>
<?php include_once __DIR__ . '/../templates/nav.php'?>

<h2>Buscar citas</h2>
<div class="busqueda">
    <form action="" method="post" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha;?>">
        </div>
    </form>
</div>

<?php
    if(count($citasAdmin) === 0){
        echo "<h2 class='alerta error'>No haya citas</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php 
        $idCita = 0;
            foreach($citasAdmin as $key => $cita):
                if($idCita != $cita->id):
                    $total = 0;
        ?>
            <li>
                <p>ID: <span><?php echo $cita->id; ?></span></p>
                <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                <p>E-mail: <span><?php echo $cita->email; ?></span></p>
                <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <h3>Servicios</h3>
                <?php
                $idCita = $cita->id;
                endif;?>
                <?php $total += $cita->precio; ?>

                <p class="servicio"><span><?php echo $cita->servicio . " " . $cita->precio; ?></span></p>
                <?php
                    $actual = $cita->id;
                    $porximo = $citas[$key + 1]->id ?? 0;
                    
                    if(esUltimo($actual, $porximo)):  ?>    
                    <p>Total: <span>$<?php echo $total; ?></span></p>

                    <form action="/api/eliminar" method="post">
                        <input type="hidden" value="<?php echo $cita->id;?>" name="id">
                        <input type="submit" class="boton boton-eliminar" value="Eliminar">
                    </form>
                <?php endif;?>
        <?php endforeach; ?>
    </ul>
</div>

<?php echo "
    <script src='build/js/buscador.js'></script>
";?>