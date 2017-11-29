<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 29/11/17
 * Time: 8:38
 */

require_once "Util.php";
require_once "GestoraDataReception.php";
require_once "Controlador.php";

$verbo=$_POST['verb'];//GET
$url1=$_POST['url1'];// producto
$url2=$_POST['url2'];// cod
$url3=$_POST['url3'];// ?
$body1=$_POST['body1'];//
$body2=$_POST['body2'];
$body3=$_POST['body3'];
$body4=$_POST['body4'];
$body5=$_POST['body5'];
$value1=$_POST['value1'];//supuesto valor nombre
$value2=$_POST['value2'];//supuesto valor descripcion
$value3=$_POST['value3'];//supuesto valor precio
$value4=$_POST['value4'];
$value5=$_POST['value5'];

$controlador=new Controlador();
$util=new Util();
$gestoraDataReception=new GestoraDataReception();
$consulta=Array();//este campo lo usaré para concatenar los campos que me lleguen para la consulta o inserción
$campos=Array();
$campos[0]=$value1;
$campos[1]=$value2;
$campos[2]=$value3;

if($util->compruebaCadena($verbo)){
    //$tipoVerbo=$gestoraDataReception->compruebaVerbo($verbo);

    /*switch ($tipoVerbo){

        case -1:
                echo 'No se encontró el verbo';
                echo '<meta http-equiv="refresh" content="1;index.php">';

            break;

        case 0:
                //put
                //consulta[0]=""
            break;

        case 1:
                //post
                $consulta[0]="post";
            break;

        case 2:
                //get

            break;

        case 3:
                //delete
                echo 'Aun nada';
            break;

    }*/

    if($gestoraDataReception->compruebaVerbo($verbo)===false){
        echo 'No se encontró el verbo';
        echo '<meta http-equiv="refresh" content="0.5;index.php">';
    }else {

        $consulta[0]=$verbo;
        if ($util->compruebaCadena($url1) /*&& strtolower($url1) == "producto"*/) {
            $consulta[1] = $url1;

            if ($util->compruebaCadena($url2) && $gestoraDataReception->compruebaColumna($url2)) {
                $consulta[2] = $url2;

                if ($util->compruebaCadena($url3)) {
                    $consulta[3] = $url3;
                }
            }

            //con que tengamos el verbo y la primera url ya podremos enviar la consulta al controlador
            //echo '<meta http-equiv="refresh" content="1;Controlador.php?consulta=' . $consulta . '">';

            ////cambio por llamada a metodo de clase controlador
            $controlador->action($consulta, $campos);
        } else {
            echo 'No se pudo realizar la acción';
            echo '<meta http-equiv="refresh" content="1;index.php">';
        }
    }
}else{
    echo 'No se encontró el verbo';
    echo '<meta http-equiv="refresh" content="1;index.php">';
}




