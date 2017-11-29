<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 29/11/17
 * Time: 8:57
 */

/*
 * Propiedades Básicas:
 *      Codigo: Entero, Consultable, Modificable
 *      Nombre: Cadena, Consultable, Modificable
 *      Descripcion: Cadena, Consultable, Modificable
 *      Precio: Double, Consultable, Modificable
 *
 * */

class Producto
{
    //Propiedades
    private $codigo;
    private $nombre;
    private $descripcion;
    private $precio;

    //Contructor
    public function __construct()
    {
        $codigo=0;
        $nombre="";
        $descripcion="";
        $precio=0.0;
    }


    //Getters and Setters

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }






}