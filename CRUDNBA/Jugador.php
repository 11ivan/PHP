<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 26/11/2017
 * Time: 19:29
 */

/*
 * Propiedades básicas:
 *      ID: Entero, consultable, modificable
 *      Nombre: Cadena, Consultable, Modificable
 *      Apellidos: Cadena, Consultable, Modificable
 *      FechaNacimiento: Date, Consultable, Modificable
 *      IDEquipo: Entero, Consultable, Modificable
 *
 * */

class Jugador
{
    private $_id;
    private $_nombre;
    private $_apellidos;
    private $_fechaNac;
    private $_idEquipo;

    public function __construct(){
        $this->_id=0;
        $this->_nombre="";
        $this->_apellidos="";
        $this->_fechaNac=new DateTime();
        $this->_idEquipo=0;
    }

    /*public function Jugador($id, $nombre, $apellidos, $fechaNac, $idEquipo){
        $this->_id=$id;
        $this->_nombre=$nombre;
        $this->_apellidos=$apellidos;
        $this->_fechaNac=$fechaNac;
        $this->_idEquipo=$idEquipo;
    }*/

    public function Jugador(Jugador $jugador){
        $this->_id=$jugador->getId();
        $this->_nombre=$jugador->getNombre();
        $this->_apellidos=$jugador->getApellidos();
        $this->_fechaNac=$jugador->getFechaNac();
        $this->_idEquipo=$jugador->getIdEquipo();
    }

    //Getters and Setters
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->_nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre)
    {
        $this->_nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->_apellidos;
    }

    /**
     * @param string $apellidos
     */
    public function setApellidos(string $apellidos)
    {
        $this->_apellidos = $apellidos;
    }

    /**
     * @return DateTime
     */
    public function getFechaNac(): DateTime
    {
        return $this->_fechaNac;
    }

    /**
     * @param DateTime $fechaNac
     */
    public function setFechaNac(DateTime $fechaNac)
    {
        $this->_fechaNac = $fechaNac;
    }

    /**
     * @return int
     */
    public function getIdEquipo(): int
    {
        return $this->_idEquipo;
    }

    /**
     * @param int $idEquipo
     */
    public function setIdEquipo(int $idEquipo)
    {
        $this->_idEquipo = $idEquipo;
    }


    public function getAge(){
        $age=0;
        $dateNow=new DateTime("now");
        $interval=$this->_fechaNac->diff($dateNow);
        $age=$interval->y;
        return $age;
    }


}