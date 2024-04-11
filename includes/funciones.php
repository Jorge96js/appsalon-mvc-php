<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

    //mostrar errores
    function phpErrores(){
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    }

    //Verificar que el usuario este logeado

    function isAuth() : void {

        if(!isset($_SESSION['login'])){
            header('Location: /');
        }
    }

    function esUltimo(string $actual, string $proximo) : bool{
        if($actual !== $proximo){
            return true;
        }
        return false;
    }

    function isAdmin(): void{
        if(!isset($_SESSION['admin'])){
            header('Location: /');
        }
    }