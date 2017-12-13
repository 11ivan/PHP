<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 26/11/2017
 * Time: 19:42
 */
require_once "Jugador.php";
require_once "Conexion.php";

class GestoraConexionJugadores
{

    /*
 * Proposito: Cuenta los jugadores de un equipo
 * Precondiciones: El equipo existe en la base de datos
 * Entradas: Una cadena que será el nombre del equipo
 * Salidas: Un entero
 * Postcondiciones: El entero será la cantidad de jugadores del equipo
 * */
    public function countJugadoresEquipo(string $nombreEquipo){
        $cantidad=0;
        $conexion=Conexion::getInstance();
        $mySqlConnection=$conexion->getConnection();
        /*select COUNT(J.ID) from equipos as E INNER JOIN
            jugadores as J ON E.ID=J.ID_Equipo WHERE E.Nombre*/
        $query="SELECT J.ID from Equipos as E INNER JOIN Jugadores as J ON E.ID=J.ID_Equipo WHERE E.Nombre=?";
        $preparedStatement=$mySqlConnection->prepare($query);
        $preparedStatement->bind_param('s', $nombreEquipo);
        $preparedStatement->execute();
        $result=$preparedStatement->get_result();
        $cantidad=$result->num_rows;

        return $cantidad;
    }


    /*
     * Proposito: Recibe el nombre de un equipo y devuelve un array con los jugadores que forman ese equipo
     * Precondiciones: El equipo existe en la base de datos
     * Entradas: Una cadena que será el nombre del equipo
     * Salidas: Un array de Jugadores
     * Postcondiciones: El array contendrá los jugadores del equipo
     * */
    public function getJugadores(string $nombreEquipo){
        $conexion=Conexion::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="SELECT J.Nombre, J.Apellidos, J.FechaNacimiento from Equipos as E INNER JOIN Jugadores as J ON E.ID=J.ID_Equipo WHERE E.Nombre=?";
        $preparedStatement=$mySqlConnection->prepare($query);
        $preparedStatement->bind_param('s', $nombreEquipo);
        $preparedStatement->execute();
        $result=$preparedStatement->get_result();
        $i=0;
        $arrayJugadores=Array();

        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $jugador=new Jugador();
                $jugador->setNombre($row['Nombre']);
                $jugador->setApellidos($row['Apellidos']);
                $date=new DateTime($row['FechaNacimiento']);
                $jugador->setFechaNac($date);
                $arrayJugadores[$i]=$jugador;
                $i++;
            }
        }
        return $arrayJugadores;
    }

    /*
     * Proposito: Inserta un jugador en la tabla Jugadores
     * Precondiciones: Todos los datos del jugador son correctos
     * Entradas: Un Jugador
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si el Jugador se ha insertado correctamente
     * */
    public function insertJugador(Jugador $jugador){
        /*FROM_UNIXTIME(?))");
        $stmt->bind_param("i", $your_date_parameter);*/
        $insertado=false;
        $conexion=DatabaseModel::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Insert INTO Jugadores (Nombre, Apellidos, Id_Equipo, FechaNacimiento) values(?, ?, ?, ?)";
        $preparedStatement=$mySqlConnection->prepare($query);
        $nombre=$jugador->getNombre();
        $apellidos=$jugador->getApellidos();
        $fechaNac=$jugador->getFechaNac()->format('Y-m-d');
        $idEquipo=$jugador->getIdEquipo();
        $preparedStatement->bind_param('ssis', $nombre, $apellidos, $idEquipo, $fechaNac);
        $preparedStatement->execute();
        if($preparedStatement->affected_rows>0){
            $insertado=true;
        }
        return $insertado;
    }

    /*
     * Proposito: Elimina un jugador de la tabla Jugadores
     * Precondiciones: El jugador existe en la base de datos
     * Entradas: Una cadena que será el nombre del jugador
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si el Jugador se ha eliminado correctamente
     * */
    public function deleteJugador(string $nombreJugador){
        $eliminado=false;

        $conexion=Conexion::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Delete from jugadores WHERE Nombre=?";
        $preparedStatement=$mySqlConnection->prepare($query);
        $preparedStatement->bind_param('s', $nombreJugador);
        $preparedStatement->execute();
        if($preparedStatement->affected_rows>0){
            $eliminado=true;
        }
        return $eliminado;
    }


    /*
     * Proposito: Dado un nombre de jugador comprueba si existe en la base de datos
     * Precondiciones: El nombre no puede estar vacío
     * Entradas: Una cadena
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si el Jugador existe en la base de datos, false sino
     * */
    public function exists(string $nombreJugador){
        $existe=false;
        $conexion=Conexion::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="SELECT Nombre from jugadores WHERE Nombre=?";
        $preparedStatement=$mySqlConnection->prepare($query);
        $preparedStatement->bind_param('s', $nombreJugador);
        $preparedStatement->execute();
        $result=$preparedStatement->get_result();
        if($result->num_rows>0){
            $existe=true;
        }
        //$conexion->closeConnection();
        return $existe;
    }



}