<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 19/01/18
 * Time: 10:01
 */
class UsuarioHandlerModel
{
    public static function getUsario($id)
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
            $query = "SELECT id, nombre, password, tipousuario FROM usuarios";

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
                $prep_query->bind_param('s', $id);
            }

            $prep_query->execute();
            $listaUsuarios = array();

            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

            $prep_query->bind_result($id, $nombre, $password, $tipoUsuario);
            while ($prep_query->fetch()) {
                //$nombre = utf8_encode($tit);
                $usuario = new UsuarioModel($nombre, $password, $tipoUsuario, $id);
                $listaUsuarios[] = $usuario;
            }

//            $result = $prep_query->get_result();
//            for ($i = 0; $row = $result->fetch_object(LibroModel::class); $i++) {
//
//                $listaLibros[$i] = $row;
//            }
        }
        $db_connection->close();

        if ($id!=null){
            $devolucion=$listaUsuarios[0];
        } else {
            $devolucion=$listaUsuarios;
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

    /*
     * Proposito: Inserta un Libro en la tabla Libros
     * Precondiciones: Todos los datos del libro son correctos
     * Entradas: Un LibrosModel
     * Salidas: Un booleano
     * Postcondiciones: El booleano será verdadero si el libro se ha insertado correctamente
     * */
    public static function insertUsuario(UsuarioModel $usuario){
        $insertado=false;
        $conexion=DatabaseModel::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Insert INTO Usuarios (Nombre, Password, TipoUsuario) values(?, ?, ?)";
        $preparedStatement=$mySqlConnection->prepare($query);
        $nombre=$usuario->getNombre();
        $password=crypt($usuario->getPassword());
        //$password->crypt
        $tipoUsuario=$usuario->getTipoUsuario();
        $preparedStatement->bind_param('ssi', $nombre, $password, $tipoUsuario);
        $preparedStatement->execute();
        if($preparedStatement->affected_rows>0){
            $insertado=true;
        }
        return $insertado;
    }

    /*
    * Proposito: Actualiza un Libro en la tabla Libros
    * Precondiciones: Todos los datos del libro son correctos
    * Entradas: Un LibrosModel
    * Salidas: Un booleano
    * Postcondiciones: El booleano será verdadero si el libro se ha insertado correctamente
    * */
    public static function updateUsuario(UsuarioModel $usuario){
        $actualizado=false;
        $conexion=DatabaseModel::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Update Usuarios set Nombre=?, Password=? TipoUsuario=? where ID=?";
        $preparedStatement=$mySqlConnection->prepare($query);

        $nombre=$usuario->getNombre();
        $password=$usuario->getPassword();
        $tipoUsuario=$usuario->getTipoUsuario();
        $preparedStatement->bind_param('ssi', $nombre, $password, $tipoUsuario);

        if($preparedStatement->execute()){
            $actualizado=true;
        }
        /*if($preparedStatement->affected_rows>0){
            $actualizado=true;
        }*/
        return $actualizado;
    }

    /*
    * Proposito: Elimina un Libro en la tabla Libros
    * Precondiciones: El id es correcto
    * Entradas: Un LibrosModel
    * Salidas: Un booleano
    * Postcondiciones: El booleano será verdadero si el libro se ha insertado correctamente
    * */
    public static function deleteUsuario(int $id){
        $eliminado=false;
        $conexion=DatabaseModel::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Delete from Usuarios where ID=?";
        $preparedStatement=$mySqlConnection->prepare($query);

        $preparedStatement->bind_param('i', $id);

        if($preparedStatement->execute()){
            $eliminado=true;
        }
        return $eliminado;
    }


}