<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 15/11/2017
 * Time: 23:22
 */

require_once "GestoraConexionEquipos.php";
require_once "Equipo.php";
require_once "Util.php";

$gestoraConexionEquipos=new GestoraConexionEquipos();
$util=new Util();
$equipo = new Equipo();
//echo $_POST["nombreEquipo"] . $_POST["nombreEstadio"];
$nombre=$_POST["nombreEquipo"];
$estadio=$_POST["nombreEstadio"];

/*if (empty($_POST["nombreEstadio"]) && empty($_POST["nombreEquipo"])) {
    $equipo->setNombre($_POST["nombreEquipo"]);
    $equipo->setEstadio($_POST["nombreEstadio"]);
    $gestoraConexionEquipos->addEquipo($equipo);

    echo '<meta http-equiv="refresh" content="5;Index.php">';
}else{
    echo '<meta http-equiv="refresh" content="5;AñadirEquipo.html">';
}*/

if ($util->compruebaCadena($nombre)===true && $util->compruebaCadena($estadio)===true) {
    $equipo->setNombre($nombre);
    $equipo->setEstadio($estadio);
    $gestoraConexionEquipos->addEquipo($equipo);
    echo '<meta http-equiv="refresh" content="0;Index.php">';
}else{
    echo '<meta http-equiv="refresh" content="0;AñadirEquipo.html">';
}

