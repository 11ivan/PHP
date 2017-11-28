<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 26/11/2017
 * Time: 23:22
 */

require_once "Jugador.php";
require_once "GestoraAddJugador.php";
require_once "GestoraConexionJugadores.php";
require_once "GestoraConexionEquipos.php";

$gestoraConexionJugadores=new GestoraConexionJugadores();
$gestoraConexionEquipos=new GestoraConexionEquipos();
$gestoraAddJugador=new GestoraAddJugador();
$nombre=$_POST['nombreJugador'];
$apellidos=$_POST['apellidosJugador'];
$fechaNacimiento=$_POST['fechaNacimiento'];
$nombreEquipo=$_POST['nombreEquipo'];
$jugador=new Jugador();

if($gestoraAddJugador->compruebaDatosJugador($nombre, $apellidos, $fechaNacimiento) && $gestoraConexionEquipos->exists($nombreEquipo)){
    $jugador->setNombre($nombre);
    $jugador->setApellidos($apellidos);
    $fechaNac=new DateTime($fechaNacimiento);
    $jugador->setFechaNac($fechaNac);
    $jugador->setIdEquipo($gestoraConexionEquipos->getIdEquipo($nombreEquipo));

    if($gestoraConexionJugadores->insertJugador($jugador)===TRUE) {
        echo 'Jugador insertado';
        echo '<meta http-equiv="refresh" content="1;InfoEquipo.php?equipo='.$nombreEquipo.'">';
    }else{
        echo 'La inserción no se realizó';
        echo '<meta http-equiv="refresh" content="1;InfoEquipo.php?equipo='.$nombreEquipo.'">';
    }
}else{
    echo 'Algún dato no es correcto o el equipo ya existe';
    echo '<meta http-equiv="refresh" content="1;InfoEquipo.php?equipo='.$nombreEquipo.'">';
}