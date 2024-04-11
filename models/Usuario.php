<?php

    namespace Model;

use PHPMailer\PHPMailer\PHPMailer;

    class Usuario extends ActiveRecord{
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password','telefono','confirmado','token','admin'];

        public $id;
        public $nombre;
        public $apellido;
        public $email;
        public $password;
        public $telefono;
        public $confirmado;
        public $token;
        public $admin;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? '';
            $this->email = $args['email'] ?? '';
            $this->password = $args['password'] ?? '';
            $this->telefono = $args['telefono'] ?? '';
            $this->confirmado = $args['confirmado'] ?? '0';
            $this->token = $args['token'] ?? '';
            $this->admin = $args['admin'] ?? '0';

        }

        //mensajes de validacion para la creacion de la cueta

        public function validarNuevaCuenta(){
            
            if(!$this->nombre){
                self::$alertas['error'][] = 'El Nombre es obligatorio';

            }
            if(!$this->apellido){
                self::$alertas['error'][] = 'El Apellido es obligatorio';

            }
            if(!$this->telefono){
                self::$alertas['error'][] = 'El Telefono es obligatorio';

            }
            if(!$this->email){
                self::$alertas['error'][] = 'El E-mail es obligatorio';

            }
            if(!$this->password){
                self::$alertas['error'][] = 'El Password es obligatorio';

            }
            if(strlen($this->password) < 6){
                self::$alertas['error'][] = 'El Password debe contener almenos 6 caracteres';

            }

            return self::$alertas;
        }

        //Funcion para validar email en caso de que se haya olvidado la contraseña
        public function validarEmail(){
            if(!$this->email){
                self::$alertas['error'][] = 'El E-mail es obligatorio';
            }

            return self::$alertas;
        }

        public function validarPassword(){
            if(!$this->password){
                self::$alertas['error'][] = "El password es obligatorio";
            }
    
            if(strlen($this->password) < 6){
                self::$alertas['error'][] = "El password es demasiado corto";
            }
            
            return self::$alertas;
        }


        public function validarLogin(){
            if(!$this->email){
                self::$alertas['error'][] = 'El E-mail es obligatorio';
            }
            if(!$this->password){
                self::$alertas['error'][] = 'El Password es obligatorio';
            }

            return self::$alertas;
        }

        public function existeUsuario(){
            $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
            $resultado = self::$db->query($query);


            if($resultado->num_rows){
                self::$alertas['error'][] = 'El usuario ya se encuentra registrado';
            }
            
            return $resultado;
        }
        public function hashPassword(){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }

        public function generarToken(){
            $this->token = uniqid();
        }

        public function comprobarPasswordAndVerificado($password){
            $resultado = password_verify($password, $this->password);

            if(!$resultado || !$this->confirmado){
                self::$alertas['error'][] = 'Contraseña incorrecta o tu usuario no esta confirmado';
            }else{
                return true;
            }
}

    }