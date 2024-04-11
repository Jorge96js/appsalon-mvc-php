<?php 

    namespace Controllers;

    use Model\Servicios;
    use Model\Cita;
    use Model\CitaServicio;

    class APIController{
        
        public static function index(){
            $servicios = Servicios::all();
            
            echo json_encode($servicios);
        }

        public static function guardar(){
            //Almacena y devuelve el id
            $cita = new Cita($_POST);
            $resultado = $cita->guardar();

            $id = $resultado["id"];
            //Almacena la cita y el servicios
            $serviciosId = explode(",", $_POST['servicios']);
            foreach($serviciosId as $servicioId){
                $args = [
                    "citaId" => $id,
                    "servicioId" => $servicioId
                ];

                $CitaServicio = new CitaServicio($args);
                $CitaServicio->guardar();
            }
            $respuesta = [
                'resultado' => $resultado
            ];

            echo json_encode($respuesta);
        }

        public static function eliminar(){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $id = $_POST['id'];
                $cita = Cita::find($id);
                $cita->eliminar();
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }