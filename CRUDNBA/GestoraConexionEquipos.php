<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 15/11/2017
 * Time: 19:54
 */

require_once "TablaEquipos.php";
require_once "Equipo.php";
require_once "Conexion.php";
require_once "Jugador.php";

class GestoraConexionEquipos
{

    function __construct()
    {
    }

    /*
     * Proposito: Devuelve un array con los equipos de la base de datos
     * Precondiciones: Debe haber algún equipo en la base datos
     * Entradas: No hay
     * Salidas: Un array de equipos
     * Postcondiciones: El array se ha cargado con los equipos de la base de datos
     * */
    /**
     * @return array
     */
    public function getEquipos(){
        $arrayEquipos=Array();
        //$arrayObject=new ArrayObject();
        $conexion = Conexion::getInstance();
        $mysqlConnection = $conexion->getConnection();
        $i=0;

        $sql_query = "SELECT " . \Constantes\TablaEquipos::NOMBRE . " , " . \Constantes\TablaEquipos::ESTADIO . " FROM " . \Constantes\TablaEquipos::TABLE_NAME;

        $result = $mysqlConnection->query($sql_query);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //$arrayObject->append(new Equipo($row[\Constantes\TablaEquipos::NOMBRE], $row[\Constantes\TablaEquipos::ESTADIO]));
                $equipo=new Equipo();
                $equipo->setNombre($row[\Constantes\TablaEquipos::NOMBRE]);
                $equipo->setEstadio($row[\Constantes\TablaEquipos::ESTADIO]);
                //$arrayEquipos[$i]=new Equipo($row[\Constantes\TablaEquipos::NOMBRE], $row[\Constantes\TablaEquipos::ESTADIO]);
                $arrayEquipos[$i]=$equipo;
                $i++;
            }
        }
        $conexion->closeConnection();
        return $arrayEquipos;
    }

    /*
     * Proposito: Dado un nombre de equipo devuelve el equipo asociado en la base de datos
     * Precondiciones: Debe haber algún equipo en la base datos
     * Entradas: No hay
     * Salidas: Un array de equipos
     * Postcondiciones: El array se ha cargado con los equipos de la base de datos
     * */
    /**
     * @return Equipo
     */
    public function getEquipo(string $nombre)
    {
        $conexion = Conexion::getInstance();
        $mysqlConnection = $conexion->getConnection();
        $sql_query = "SELECT " . \Constantes\TablaEquipos::NOMBRE . " , " . \Constantes\TablaEquipos::ESTADIO . " FROM " . \Constantes\TablaEquipos::TABLE_NAME .
                    " WHERE " . \Constantes\TablaEquipos::NOMBRE. "=?";
        $preparedStatement=$mysqlConnection->prepare($sql_query);
        //$result = $mysqlConnection->query($sql_query);
        $preparedStatement->bind_param('s', $nombre);
        $preparedStatement->execute();
        $result=$preparedStatement->get_result();
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            $equipo = new Equipo();
            $equipo->setNombre($row[\Constantes\TablaEquipos::NOMBRE]);
            $equipo->setEstadio($row[\Constantes\TablaEquipos::ESTADIO]);
        }
        $conexion->closeConnection();
        return $equipo;
    }


    /*
     * Proposito: Muestra una tabla con los equipos de la base de datos
     * Precondiciones: Debe haber algún equipo en la base datos
     * Entradas: No hay
     * Salidas: Un array de equipos
     * Postcondiciones: El array se ha cargado con los equipos de la base de datos
     * */
    public function muestraEquipos(){
        $arrayEquipos=null;
        $conexion = Conexion::getInstance();
        $mysqlConnection = $conexion->getConnection();

        $sql_query = "SELECT " . \Constantes\TablaEquipos::NOMBRE . " , " . \Constantes\TablaEquipos::ESTADIO . " FROM " . \Constantes\TablaEquipos::TABLE_NAME;

        $result = $mysqlConnection->query($sql_query);

        if ($result->num_rows > 0) {
            echo '<table border=\"1\">';
            echo '<tr>';
            echo '<td>' . \Constantes\TablaEquipos::NOMBRE . '</td><td>' . \Constantes\TablaEquipos::ESTADIO . '</td>';
            echo '</tr>';
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row[\Constantes\TablaEquipos::NOMBRE] . '</td><td>' . $row[\Constantes\TablaEquipos::ESTADIO] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        $conexion->closeConnection();
    }


    /*
     * Proposito: Añade un equipo a la base de datos
     * Precondiciones: Los datos del equipo son correctos
     * Entradas: Un equipo
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si el equipo se ha insertado correctamente en la base de datos
     * */
    public function addEquipo(Equipo $equipo){
        $conexion = Conexion::getInstance();
        $mysqlConnection = $conexion->getConnection();
        $ok=false;
        $nombre=$equipo->getNombre();
        $estadio=$equipo->getEstadio();
        $result=null;
        //$sql_query="insert into " . \Constantes\TablaEquipos::TABLE_NAME . "(". \Constantes\TablaEquipos::NOMBRE .",". \Constantes\TablaEquipos::ESTADIO  .") VALUES (". $equipo->getNombre() .",". $equipo->getEstadio() .")";
        $preparedStatement= $mysqlConnection->prepare("INSERT INTO ".\Constantes\TablaEquipos::TABLE_NAME. "(".\Constantes\TablaEquipos::NOMBRE.",".\Constantes\TablaEquipos::ESTADIO .") VALUES (?, ?)" );
        $preparedStatement->bind_param('ss', $nombre, $estadio);

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

    /*
     * Proposito: Borra un equipo a la base de datos
     * Precondiciones: El equipo debe existir en la base de datos
     * Entradas: Una cadena que será el nombre del euqipo
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si el equipo se ha eliminado de la base de datos y false sino
     * */
    public function deleteEquipo(string $nombre){
        $eliminado=false;
        $conexion=Conexion::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $preparedStatement=$mySqlConnection->prepare("DELETE FROM ". \Constantes\TablaEquipos::TABLE_NAME ." WHERE ". \Constantes\TablaEquipos::NOMBRE ."=?" );
        $preparedStatement->bind_param('s', $nombre);
        if($preparedStatement->execute()===true){
            $eliminado=true;
        }
        return $eliminado;
    }

    /*
     * Proposito: Comprueba si un equipo existe en la base de datos
     * Precondiciones: No hay
     * Entradas: Una cadena que será el nombre del equipo
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si el equipo existe y false sino
     * */
    public function exists(string $nombreEquipo){
        $existe=false;
        $conexion=Conexion::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $preparedStatement=$mySqlConnection->prepare("SELECT ". \Constantes\TablaEquipos::NOMBRE ." FROM ". \Constantes\TablaEquipos::TABLE_NAME .
                                                            " WHERE ". \Constantes\TablaEquipos::NOMBRE . "=?");
        $preparedStatement->bind_param('s', $nombreEquipo);
        $preparedStatement->execute();
        $result=$preparedStatement->get_result();

        if($result->num_rows>0){
            $existe=true;
        }
        return $existe;
    }

    /*
     * Proposito: Recibe el nombre de un equipo y devuelve el id del mismo
     * Precondiciones: El quipo existe en la base de datos
     * Entradas: Una cadena que será el nombre del equipo
     * Salidas: Un entero
     * Postcondiciones: El entero será el id del equipo, -1 si ocurre algún  problema
     * */
    public function getIdEquipo(string $nombreEquipo){
        $id=-1;
        $conexion=Conexion::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $preparedStatement=$mySqlConnection->prepare("SELECT id FROM equipos WHERE nombre=?");
        $preparedStatement->bind_param('s', $nombreEquipo);
        $preparedStatement->execute();
        $result=$preparedStatement->get_result();

        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $id=$row['id'];
        }
        return $id;
    }


}

