<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 15/11/2017
 * Time: 21:04
 */

require_once "GestoraConexionEquipos.php";
require_once "TablaEquipos.php";
require_once "Equipo.php";
require_once "GestoraConexionJugadores.php";


    $gestoraConexioEquipos=new GestoraConexionEquipos();
    $gestoraConexionJugadores=new GestoraConexionJugadores();
    //$arrayEquipos=new ArrayObject($gestoraConexioEquipos->getEquipos());
    $arrayEquipos=$gestoraConexioEquipos->getEquipos();
    //$gestoraConexioEquipos->muestraEquipos();
    //$arrayEquipos=$gestoraConexioEquipos->getEquipos();

    if(count($arrayEquipos)>0) {

        echo '<table border="1" border-collapse="collapse">';
        echo '<tbody>';
        //echo '<th>';
        echo '<tr><td >'.\Constantes\TablaEquipos::NOMBRE.'</td><td>'.Constantes\TablaEquipos::ESTADIO.'</td><td>Cantidad de Jugadores</td></tr>';
        //echo '</th>';
        for ($i=0;$i<count($arrayEquipos);$i++) {
            $equipo=$arrayEquipos[$i];
            $nombre=$equipo->getNombre();
            echo '<tr>';
            echo '<td>'.$equipo->getNombre().'</td><td>'.$equipo->getEstadio().'</td><td>'.$gestoraConexionJugadores->countJugadoresEquipo($nombre).'</td>';
            echo '<td>'. "<a href='ConfirmaEliminarEquipo.php?equipo=$nombre'><img src=\"images/delete.png\" style=\"width:20px;height:20px;border:0;\"/></a>" .'</td>';
            echo '<td>'. "<a href='InfoEquipo.php?equipo=$nombre'> <img src=\"images/info.png\" style=\"width:20px;height:20px;border:0;\" /></a>" .'</td>';
            echo '</tr>';
           // echo '<a href="#" target="_blank" ><img src="images/delete.png" style="width:40px;height:40px;border:0;"/></a>';
        }
        echo '</tbody>';
        echo '</table>';

    }

    /*function callDelete(string $nombre){
        $gestoraConexioEquipos=new GestoraConexionEquipos();
        $gestoraConexioEquipos->deleteEquipo($nombre);
    }*/

    //echo '<a href="AñadirEquipo.html" target="_blank" ><button type="button"> </button></a>';
    echo '<a href="AñadirEquipo.html" target="_blank" ><img src="images/iconoadd.png" style="width:40px;height:40px;border:0;"/></a>';
