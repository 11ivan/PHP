<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 28/11/2017
 * Time: 19:55
 */

require_once "GestoraConexionJugadores.php";
require_once "Util.php";

$btnPulsado=$_POST['boton'];
$nombreJugador=$_POST['nombreJugador'];
$gestoraConexionJugadores=new GestoraConexionJugadores();
$util=new Util();

if($btnPulsado=="Si" && $util->compruebaCadena($nombreJugador)){
    if($gestoraConexionJugadores->exists($nombreJugador)){
        if($gestoraConexionJugadores->deleteJugador($nombreJugador)) {
            echo 'Se ha eliminado el jugador';
        }else{
            echo 'No se pudo eliminar el jugador';
        }
    }
    echo '<meta http-equiv="refresh" content="1;Index.php">';
}else{
    echo 'Operación cancelada';
    echo '<meta http-equiv="refresh" content="1;Index.php">';
}