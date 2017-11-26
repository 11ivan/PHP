<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 26/11/2017
 * Time: 23:22
 */

require_once "Jugador.php";
require_once "GestoraAddJugador.php";

$gestoraAddJugador=new GestoraAddJugador();
$nombre=$_POST['nombreJugador'];
$apellidos=$_POST['apellidosJugador'];
$fechaNacimiento=$_POST['fechaNacimiento'];
$nombreEquipo=$_POST['nombreEquipo'];

if($gestoraAddJugador->compruebaCadena($nombre) && $gestoraAddJugador->compruebaCadena($apellidos)){

}else{
    echo '<meta http-equiv="refresh" content="1;AñadirJugador.html">';
}