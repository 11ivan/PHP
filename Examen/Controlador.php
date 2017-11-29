<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 29/11/17
 * Time: 10:44
 */

require_once "ListadoProductos.php";
require_once "GestoraProductos.php";
require_once "Producto.php";


class Controlador
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
        $resultado=-1;
        switch ($verbo){

            case "PUT":
                $resultado=0;
                break;

            case "POST":
                $resultado=1;
                break;

            case "GET":
                $resultado=2;
                break;

            case "DELETE":
                $resultado=3;
                break;
        }
        return $resultado;
    }



    public function action($arrayConsulta, $arrayCampos){

        $gestoraProductos=new GestoraProductos();
        $respuesta=Array();

        switch ($this->compruebaVerbo($arrayConsulta[0])){

            case 0:
                    //put

                break;

            case 1:
                    //post
                    $producto=new Producto();
                    $producto->setNombre($arrayCampos[0]);
                    $producto->setDescripcion($arrayCampos[1]);
                    $producto->setPrecio($arrayCampos[2]);
                    //rellenar arrayCampos en DataReception.php
                    $gestoraProductos->addProducto($producto);

                    $respuesta[0]="HTTP/1.1 201 Created";
                    $respuesta[1]=$arrayCampos[0];
                    $respuesta[2]=$arrayCampos[1];
                    $respuesta[3]=$arrayCampos[2];

                echo '<meta http-equiv="refresh" content="1;VistaResultado.php?respuesta='.$respuesta[0].'">';
                //echo '<meta http-equiv="refresh" content="1;InfoEquipo.php?equipo='.$nombreEquipo.'">';
                break;

            case 2:
                    //get

                break;

            case 3:
                    //delete

                break;
        }

        //return $respuesta;
    }

}