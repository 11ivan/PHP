<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 29/11/17
 * Time: 8:54
 */

require_once "Conexion.php";
require_once "Producto.php";

class ListadoProductos
{
    /*
     * Proposito: Devuelve un array con los productos de la base de datos
     * Precondiciones: Debe haber algún producto en la base datos
     * Entradas: No hay
     * Salidas: Un array de prouctos
     * Postcondiciones: El array se ha cargado con los productos de la base de datos
     * */
    /**
     * @return array
     */
    public function getProductos(){
        $arrayProductos=Array();
        $conexion = Conexion::getInstance();
        $mysqlConnection = $conexion->getConnection();
        $i=0;

        $sql_query = "SELECT cod, nombre, descripcion, precio From productos";

        $result = $mysqlConnection->query($sql_query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //$arrayObject->append(new Equipo($row[\Constantes\TablaEquipos::NOMBRE], $row[\Constantes\TablaEquipos::ESTADIO]));
                $producto=new Producto();
                $producto->setCodigo($row['cod']);
                $producto->setNombre($row['nombre']);
                $producto->setDescripcion($row['descripcion']);
                $producto->setPrecio($row['precio']);
                //$arrayEquipos[$i]=new Equipo($row[\Constantes\TablaEquipos::NOMBRE], $row[\Constantes\TablaEquipos::ESTADIO]);
                $arrayProductos[$i]=$producto;
                $i++;
            }
        }
        $conexion->closeConnection();
        return $arrayProductos;
    }

}