<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 26/11/2017
 * Time: 20:25
 */
require_once "Jugador.php";
require_once "GestoraConexionEquipos.php";
require_once "Equipo.php";
require_once "GestoraConexionJugadores.php";


$nombreEquipo=$_GET['equipo'];
$gestoraConexioEquipos=new GestoraConexionEquipos();
$gestoraConexionJugadores=new GestoraConexionJugadores();
$equipo=$gestoraConexioEquipos->getEquipo($nombreEquipo);
$arrayJugadores=$gestoraConexionJugadores->getJugadores($nombreEquipo);

echo '<h1>'. $equipo->getNombre() .'</h1>';
echo '<h2>'. $equipo->getEstadio() .'</h2>';

if(count($arrayJugadores)>0) {

    echo '<table border="1" border-collapse="collapse">';
    echo '<tbody>';
    //echo '<th>';
    echo '<tr><td >Nombre</td><td>Apellidos</td><td>Edad</td></tr>';
    //echo '</th>';
    for ($i=0;$i<count($arrayJugadores);$i++) {
        $jugador=$arrayJugadores[$i];
        $nombre=$jugador->getNombre();
        echo '<tr>';
        echo '<td>'.$jugador->getNombre().'</td><td>'.$jugador->getApellidos().'</td><td>'.$jugador->getAge().'</td>';
        echo '<td>'. "<a href='DeleteJugador.php?jugador=$nombre'><img src=\"images/delete.png\" style=\"width:20px;height:20px;border:0;\"/></a>" .'</td>';
        echo '<td>'. "<a href='EditJugador.php?jugador=$nombre'> <img src=\"images/info.png\" style=\"width:20px;height:20px;border:0;\" /></a>" .'</td>';
        echo '</tr>';
        // echo '<a href="#" target="_blank" ><img src="images/delete.png" style="width:40px;height:40px;border:0;"/></a>';
    }
    echo '</tbody>';
    echo '</table>';

    echo '</br><a href="AñadirJugador.php" target="_blank" ><img src="images/iconoadd.png" style="width:20px;height:20px;border:0;"/></a>';
    echo '</br><a href="Index.php"><img src="images/home.png" style="width:20px;height:20px;border:0;" /></a>';
}
