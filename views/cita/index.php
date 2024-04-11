<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<?php include_once __DIR__ . '../templates/nav.php'?>

<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1">Seccion 1</button>
        <button type="button" data-paso="2">Seccion 2</button>
        <button type="button" data-paso="3">Seccion 3</button>
    </nav>
    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus datos y cita</h2>
        <p>coloca tus datos y fecha de tu cita</p>
        <form action="" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text"
                    id="nombre"
                    value="<?php echo $nombre?>"
                    placeholder="Tu nombre"
                    disabled
                />
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date"
                    id="fecha"
                    min="<?php echo Date('Y-m-d')?>"
                />
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time"
                    id="hora"
                />
                <input type="hidden" id="id" value="<?php echo $id?>">
            </div>
        </form>
    </div>
    <div id="paso-3" class="seccio contenido-resumen">
        <h2>Resumen</h2>
        <p>Verifica que la informacion sea correcta</p>
    </div>

    <div class="paginacion">
        <button class="boton" id="anterior">
            &laquo; Anterior
        </button>
        <button class="boton" id="siguiente">
        Siguiente &raquo;
        </button>
    </div>
</div>

<?php

    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    <script src='build/js/app.js'></script> "
?>