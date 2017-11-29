<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 29/11/17
 * Time: 8:57
 */
require_once "Util.php";

$util=new Util();
$respuesta=$_GET['respuesta'];


echo $respuesta[0];

if($util->compruebaCadena($respuesta[1])) {
    echo 'Nombre';
    echo $respuesta[1];

    echo 'Descripcion';
    echo $respuesta[2];

    echo 'Precio';
    echo $respuesta[3];
}

echo '<a href="index.php"> Ir a inicio</a>';