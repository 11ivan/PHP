<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 15/11/2017
 * Time: 23:22
 */

require_once "GestoraConexionEquipos.php";
require_once "Equipo.php";

$gestoraConexionEquipos=new GestoraConexionEquipos();
$equipo = new Equipo();

//echo $_POST["nombreEquipo"] . $_POST["nombreEstadio"];

//if (empty($_POST["nombreEstadio"]) && empty($_POST["nombreEquipo"])) {
    $equipo->setNombre($_POST["nombreEquipo"]);
    $equipo->setEstadio($_POST["nombreEstadio"]);
    $gestoraConexionEquipos->addEquipo($equipo);
    //echo 'Hola';
    //header('EquiposNBA.php');
//}else{
   //header('AñadirEquipos.html');
 //   echo 'adios';
 //   }

