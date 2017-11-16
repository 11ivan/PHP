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
require_once "Collection.php";


    $gestoraConexioEquipos=new GestoraConexionEquipos();
    //$arrayEquipos=new ArrayObject($gestoraConexioEquipos->getEquipos());
    $arrayEquipos=$gestoraConexioEquipos->getEquipos();
    $collecion=new Collection();
    //$collecion=$gestoraConexioEquipos->getEquipos();
    //$equipo=null;
    //$gestoraConexioEquipos->muestraEquipos();
    //$arrayEquipos=$gestoraConexioEquipos->getEquipos();

    if($arrayEquipos!=null) {

        echo '<table>';
        echo '<tr>';
        echo '<td>'.\Constantes\TablaEquipos::NOMBRE.'</td><td>'.Constantes\TablaEquipos::ESTADIO.'</td>';
        echo '<tr>';
        for ($i=0;$i<count($arrayEquipos);$i++) {
            $equipo=$arrayEquipos[$i];

            echo '<tr>';
            echo '<td>'.$equipo->getNombre().'</td><td>'.$equipo->getEstadio().'</td>';
            echo '<tr>';
        }
        echo '</table>';

    }


    //echo '<a href="AñadirEquipo.html" target="_blank" ><button type="button"> </button></a>';
    echo '<a href="AñadirEquipo.html" target="_blank" ><img src="images/iconoadd.png" style="width:40px;height:40px;border:0;"/></a>';
