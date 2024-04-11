<?php

    namespace Model;

    class Cita extends ActiveRecord{
        protected static $tabla = 'citas';
        protected static $columnasDB = ['id', 'usuarioId', 'hora', 'fecha'];

        public $id;
        public $usuarioId;
        public $hora;
        public $fecha;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->fecha = $args['fecha'] ?? '';
            $this->hora = $args['hora'] ?? '';
            $this->usuarioId = $args['usuarioId'] ?? '';
        }

        public function guardar() {
            // Formatear la fecha antes de guardarla en la base de datos
            $this->fecha = date('Y-m-d', strtotime($this->fecha));
    
            // Llamar al método guardar() de la clase padre
            return parent::guardar();
        }
    }