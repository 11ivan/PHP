<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 26/02/18
 * Time: 11:37
 */
class AutorHandlerModel
{

    public static function getAutor($id)
    {
        $listaUsuarios = null;
        $devolucion=null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //IMPORTANT: we have to be very careful about automatic data type conversions in MySQL.
        //For example, if we have a column named "cod", whose type is int, and execute this query:
        //SELECT * FROM table WHERE cod = "3yrtdf"
        //it will be converted into:
        //SELECT * FROM table WHERE cod = 3
        //That's the reason why I decided to create isValid method,
        //I had problems when the URI was like libro/2jfdsyfsd

        $valid = self::isValid($id);

        //If the $id is valid or the client asks for the collection ($id is null)
        if ($valid === true || $id == null) {
            $query = "SELECT ID, Nombre, Apellidos FROM Autores";

            if ($id != null) {
                $query = $query . " WHERE ID = ?";
            }

            $prep_query = $db_connection->prepare($query);

            //IMPORTANT: If we do not want to expose our primary keys in the URIS,
            //we can use a function to transform them.
            //For example, we can use hash_hmac:
            //http://php.net/manual/es/function.hash-hmac.php
            //In this example we expose primary keys considering pedagogical reasons

            if ($id != null) {
                $prep_query->bind_param('i', $id);
            }

            $prep_query->execute();
            $listaUsuarios = array();

            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

            $prep_query->bind_result($id, $nombre, $apellidos);
            while ($prep_query->fetch()) {
                //$nombre = utf8_encode($tit);
                $autor = new AutorModel($id, $nombre, $password);
                $listaAutores[] = $autor;
            }

//            $result = $prep_query->get_result();
//            for ($i = 0; $row = $result->fetch_object(LibroModel::class); $i++) {
//
//                $listaLibros[$i] = $row;
//            }
        }
        $db_connection->close();

        /*if ($id!=null){
            $devolucion=$listaUsuarios[0];
        } else {
            $devolucion=$listaUsuarios;
        }*/

        if (count($listaAutores)==0){
            $devolucion=$listaAutores[0];
        } else {
            $devolucion=$listaAutores;
        }

        return $devolucion;
    }

    //returns true if $id is a valid id for a book
    //In this case, it will be valid if it only contains
    //numeric characters, even if this $id does not exist in
    // the table of books
    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }

    public static function validateUser($nombre, $password){
        $conexion=DatabaseModel::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Select Nombre, Password From Usuarios where Nombre=?";
        $preparedStatement=$mySqlConnection->prepare($query);

        $preparedStatement->bind_param('s', $nombre);
        $preparedStatement->execute();
        $result=$preparedStatement->get_result();

        return $result;
    }


}