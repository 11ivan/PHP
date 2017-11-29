<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 28/11/2017
 * Time: 20:11
 */

class Util
{

    /*
     * Proposito: Comprueba que una cadena no contenga números y su longitud sea mayor que 0
     * Precondiciones:
     * Entradas: Una cadena
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si la cadena es valida, sino false
     * */
    public function compruebaCadena($cadena){
        $valida=false;
        $cadenaSinEspacios=str_replace(" ", "", $cadena);
        if (is_numeric($cadenaSinEspacios)===false && strlen($cadenaSinEspacios)>0 ) {
            $valida=true;
        }
        return $valida;
    }



}