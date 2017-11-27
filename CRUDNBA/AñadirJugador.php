<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 27/11/2017
 * Time: 0:00
 */
require_once "GestoraConexionEquipos.php";
require_once "Equipo.php";


$gestoraConexionEquipos=new GestoraConexionEquipos();
$arrayEquipos=$gestoraConexionEquipos->getEquipos();

echo '<form action="addJugador.php" method="post">';

echo    '<label>Nombre: </label><input type="text" name="nombreJugador" required>';
echo    '<label>Apellidos: </label><input type="text" name="apellidosJugador" required></br>';
echo    '<label>Fecha Nacimiento: </label><input type="date" name="fechaNacimiento" required></br>';

echo    '<select name="nombreEquipo">';
            for($i=0;$i<count($arrayEquipos);$i++){
                $equipo=$arrayEquipos[$i];
                echo'<option>'. $equipo->getNombre() .'</option>';
            }
echo    '</select>';

echo    '<input type="submit" value="Submit">';
echo    '</form>';
