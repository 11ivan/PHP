<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 15/11/2017
 * Time: 19:26
 */
/*
 * Propiedades básicas:
 *      -Nombre: Cadena, Consultable, Modificable, Longtitud Máxima 25 caracteres
 *      -Estadio: Cadena, Consultable, Modificable, Longtitud Máxima 25 caracteres
 *      [-Ruta Imagen: Cadena, Consultable, Modificable]
 *
 * Propiedades agregadas:
 *
 *
 * */


class Equipo
{
    public $_nombre;
    public $_estadio;

    public function __construct(){

    }

    public function Equipo(Equipo $equipo){
       $this->_nombre=$equipo->getNombre();
       $this->_estadio=$equipo->getEstadio();
    }


    /*public function Equipo(Equipo $equipo){
        $this->_nombre=$equipo->getNombre();
        $this->_estadio=$equipo->getEstadio();
    }*/


    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->_nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getEstadio()
    {
        return $this->_estadio;
    }

    /**
     * @param string $estadio
     */
    public function setEstadio($estadio)
    {
        $this->_estadio = $estadio;
    }


    public function __toString(){
        return $this->_nombre.",".$this->_estadio;
    }


}