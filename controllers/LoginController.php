<?php 

    namespace Controllers;

    use Classes\Email;
    use Model\Usuario;
    use MVC\Router;

    class LoginController{
        public static function login(Router $router){
            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $auth = new Usuario($_POST);
                $alertas = $auth->validarLogin();

                if(empty($alertas)){
                    $usuario = Usuario::where('email', $auth->email);

                    if($usuario){
                        if($usuario->comprobarPasswordAndVerificado($auth->password)){

                            session_start();

                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['login'] = $usuario->login = true;

                            if($usuario->admin === '1'){
                                $_SESSION['admin'] = $usuario->admin ?? null;
                                header('Location: /admin');
                            } 
                            
                            else{
                                header('Location: /cita');
                            }

                        }
                    }

                    else{
                        Usuario::setAlerta('error', 'Usuario no encontrado');
                    }
                }
            }
            $alertas = Usuario::getAlertas();
            $router->render('auth/login', [
                'alertas' => $alertas,

            ]);
        }  

        public static function logout(){
            session_start();
            $_SESSION = [];

            header('Location: /');
        }

        public static function olvide(Router $router){
            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $auth = new Usuario($_POST);
                $alertas = $auth->validarEmail();

                if(empty($alertas)):

                    $usuario = Usuario::where('email', $auth->email);

                    if($usuario && $usuario->confirmado === "1"){
                        //Generar nuevo token
                        $usuario->generarToken();
                        $usuario->guardar();

                        //Enviar token 

                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarInstrucciones();
                        //Alerta de confirmacion
                        Usuario::setAlerta('exito','Un token de confirmacion fue enviado a su email');
                        $alertas = Usuario::getAlertas();                    

                    } else{
                        Usuario::setAlerta('error','El usuario no fue encontrado');
                        $alertas = Usuario::getAlertas();
                    }
                
                endif;
            }

            $router->render('auth/olvide', [
                'alertas' => $alertas,
            ]);
        
        }   

        public static function recuperar(Router $router){
            $alertas = [];
            $error = false;
            $token = s($_GET['token']);

            //Buscar usuario por token
            
            $usuario = Usuario::where('token', $token);
            
            if(empty($usuario)){
                Usuario::setAlerta('error', 'Token invalido');
                $error = true;
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $password = new Usuario($_POST);
                $alertas = $password->validarPassword();
                
                if(empty($alertas)){
                    $usuario->password = null;

                    $usuario->password = $password->password;
                    $usuario->hashPassword();
                    $usuario->token = null;

                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /');
                    }

                }
            }

            $alertas = Usuario::getAlertas();
            $router->render('auth/recuperar-cuenta',[
                'alertas' => $alertas,
                'error' => $error
            ]);
        
        }

        public static function crear(Router $router){
            $usuario = new Usuario($_POST);
            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarNuevaCuenta();
                
                if(empty($alertas)){
                    //Verificar que el usuario no este registrado
                    $resultado = $usuario->existeUsuario();

                    if($resultado->num_rows){
                        $alertas = Usuario::getAlertas();
                    }else{
                        //no esta registrado
                        $usuario->hashPassword();
                        
                        //Generar token unico
                        $usuario->generarToken();

                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
                        

                        //Crear usuario con el metodo de ActiveRecord 

                        $resultado = $usuario->guardar();

                        if($resultado){
                            
                            header('Location: /mensaje');

                        }
                    }
                }
            }   

            $router->render('auth/crear-cuenta',[
                'usuario' => $usuario,
                'alertas' => $alertas,
            ]);
        }   

        public static function mensaje(Router $router){

            $router->render('auth/mensaje');
        }      

        public static function confirmar(Router $router){
            $alertas = [];

            $token = s($_GET['token']);

            $usuario = Usuario::where('token', $token);

            if(empty($usuario)){
                //agregar alertas
                Usuario::setAlerta('error','El token no e valido');
            }else{
                //modificar usuario confirmado
                $usuario->confirmado = '1';
                $usuario->token = null;
                $usuario->guardar();
                Usuario::setAlerta('exito','Cuenta creada correctamente');

            }
            //traer alertas
            $alertas = Usuario::getAlertas();
            //crear vista
            $router->render('auth/confirmar-cuenta',[
                'alertas' => $alertas,
            ]);
        }   
    }