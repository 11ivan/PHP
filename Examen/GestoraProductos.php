<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 29/11/17
 * Time: 9:09
 */

require_once "Producto.php";
require_once "Conexion.php";

class GestoraProductos
{

    /*
 * Proposito: Dado un id de producto devuelve el producto asociado en la base de datos
 * Precondiciones: Debe haber algún producto en la base datos
 * Entradas: No hay
 * Salidas: Un producto
 * Postcondiciones: Se ha devuelto el producto
 * */
    /**
     * @return Producto
     */
    public function getProducto(int $idProducto)
    {
        $conexion = Conexion::getInstance();
        $mysqlConnection = $conexion->getConnection();
        $sql_query = "SELECT cod, nombre, descripcion, precio From productos WHERE cod=?";
        $preparedStatement=$mysqlConnection->prepare($sql_query);
        //$result = $mysqlConnection->query($sql_query);
        $preparedStatement->bind_param('i', $idProducto);
        $preparedStatement->execute();
        $result=$preparedStatement->get_result();
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            $producto = new Producto();
            $producto->setCodigo($row['cod']);
            $producto->setNombre($row['nombre']);
            $producto->setDescripcion($row['descripcion']);
            $producto->setPrecio($row['precio']);
        }
        $conexion->closeConnection();
        return $producto;
    }

        /*
     * Proposito: Añade un producto a la base de datos
     * Precondiciones: Los datos del producto son correctos
     * Entradas: Un producto
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si el equipo se ha insertado correctamente en la base de datos
     * */
    public function addProducto(Producto $producto){
        $conexion = Conexion::getInstance();
        $mysqlConnection = $conexion->getConnection();
        $ok=false;

        //$cod=$producto->getCodigo();
        $nombre=$producto->getNombre();
        $descripcion=$producto->getDescripcion();
        $precio=$producto->getPrecio();
        $result=null;
        $preparedStatement= $mysqlConnection->prepare("INSERT INTO productos (nombre, descripcion, precio) values (?, ?, ?)");
        $preparedStatement->bind_param('ssi', $nombre, $descripcion, $precio);

        if($preparedStatement->execute()===TRUE){
            $ok=true;
            echo 'Insertado';
        }else{
            echo 'No insertado';
        }
        //$result=$preparedStatement->get_result();

        /* if($mysqlConnection->query($sql_query)===TRUE){
             $ok=true;
             echo 'Insertado';
         }else{
             echo 'No insertado';
         }*/
        $conexion->closeConnection();

        return $ok;
    }



}