<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 19/11/2017
 * Time: 18:55
 */
require_once "GestoraConexionEquipos.php";


//echo $_GET['equipo'];
$gestoraConexionEquipos=new GestoraConexionEquipos();
$nombreEquipo=$_GET['equipo'];
//$gestoraDelete=new GestoraDeleteEquipos();

if($gestoraConexionEquipos->exists($nombreEquipo)){

    //Confirmar si desea eliminar
    echo '<script>if(confirm("El equipo se eliminará de la base de datos")){ <?php $gestoraConexionEquipos->deleteEquipo($nombreEquipo);  ?> }</script> ';


    /*if($gestoraConexionEquipos->deleteEquipo($nombreEquipo)){
        echo 'El equipo se ha eliminado de la base de datos';
    }else{
        echo 'No se ha podido eliminar el equipo de la base de datos';
    }*/
    echo '<meta http-equiv="refresh" content="1;Index.php">';
}



