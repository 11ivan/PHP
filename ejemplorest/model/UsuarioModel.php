<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 19/01/18
 * Time: 9:46
 */
class UsuarioModel implements JsonSerializable
{
    private $id;
    private $nombre;
    private $password;
    private $tipoUsuario;

    public function __construct($nombre, $password, $tipoUsuario, $id="No visible")
    {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->password=$password;
        $this->tipoUsuario=$tipoUsuario;
    }


    function jsonSerialize()
    {
        return array(
            'ID' => $this->id,
            'Nombre' => $this->nombre,
            'Password' => $this->password,
            'TipoUsuario'=>$this->tipoUsuario
        );
    }

    public function __sleep(){
        return array('ID' , 'Nombre' , 'Password', 'TipoUsuario' );
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    /**
     * @param mixed $tipoUsuario
     */
    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }



}