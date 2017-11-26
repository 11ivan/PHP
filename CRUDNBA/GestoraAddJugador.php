<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 26/11/2017
 * Time: 23:23
 */

class GestoraAddJugador
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

    /*
     * Proposito: Comprueba que la diferencia entre una fecha y la actual sea mayor o igual que 18
     * Precondiciones: No hay
     * Entradas: Una fecha
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si la diferencia entre las fechas es mayor o igual que 18 false sino
     * */
    public function compruebaFecha($fecha){


    }


}