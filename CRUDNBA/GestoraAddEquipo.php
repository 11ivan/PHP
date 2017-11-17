<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 16/11/2017
 * Time: 20:37
 */

class GestoraAddEquipo
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

         if (is_numeric($cadena)===false && strlen($cadena)>0 ) {
            $valida=true;
         }
        return $valida;
     }


}