<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 26/02/18
 * Time: 11:34
 */
class AutorModel implements JsonSerializable
{

    private $id;
    private $nombre;
    private $apellidos;

    /**
     * AutorModel constructor.
     * @param $id
     * @param $nombre
     * @param $apellidos
     */
    public function __construct($id, $nombre, $apellidos)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }


    function jsonSerialize()
    {
        return array(
            'ID' => $this->id,
            'Nombre' => $this->nombre,
            'Apellidos' => $this->apellidos,
        );
    }

    public function __sleep(){
        return array('ID' , 'Nombre' , 'Apellidos' );
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }



}