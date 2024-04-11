<div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text"
        id="nombre"
        name="nombre"
        placeholder="Añade un nombre al servicio"
        value="<?php echo $servicio->nombre?>"
    />
</div>

<div class="campo">
    <label for="precio">Precio</label>
    <input type="number"
        id="precio"
        name="precio"
        placeholder="Añade un precio al servicio"
        value="<?php echo $servicio->precio?>"
    />
</div>

