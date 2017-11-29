<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 29/11/17
 * Time: 9:47
 */
class GestoraDataReception
{

    /*
    * Proposito: Comprueba que una cadena sea PUT, POST, GET o DELETE
    * Precondiciones: No hay
    * Entradas: Una cadena
    * Salidas: Un entero
    * Postcondiciones: El entero será 0 en caso de PUT, 1 en caso de POST, 2 en caso de GET,
    *                   3 en caso de DELETE y -1 sino es niguno
    * */
    public function compruebaVerbo($verbo){
        $resultado=false;
        switch (strtolower($verbo)){

            case "put":
            case "post":
            case "get":
            case "delete":
                    $resultado=true;
                break;
        }
    }


    /*
    * Proposito: Comprueba que una cadena sea cod, nombre, descripcion o precio
    * Precondiciones: la cadena no está vacía
    * Entradas: Una cadena
    * Salidas: Un booleano
    * Postcondiciones: El booleano será verdadero si la cadena coincide con cod, nombre, descripcion o precio
    * */
    public function compruebaColumna($columna){
        $vale=false;

        switch (strtolower($columna)){
            case "cod":
            case "nombre":
            case "descripcion":
            case "precio":
                    $vale=true;
                break;
        }
        return $vale;
    }

}