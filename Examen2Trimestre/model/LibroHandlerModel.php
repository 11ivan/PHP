<?php

require_once "ConsLibrosModel.php";


class LibroHandlerModel
{

    public static function getLibro($id)
    {
        $listaLibros = null;
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
            $query = "SELECT " . \ConstantesDB\ConsLibrosModel::COD . ","
                . \ConstantesDB\ConsLibrosModel::TITULO . ","
                . \ConstantesDB\ConsLibrosModel::PAGS . " FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME;

            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";
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
            $listaLibros = array();

            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

            $prep_query->bind_result($cod, $tit, $pag);
            while ($prep_query->fetch()) {
                $tit = utf8_encode($tit);
                $libro = new LibrosModel($tit, $pag, $cod);
                $listaLibros[] = $libro;
            }

//            $result = $prep_query->get_result();
//            for ($i = 0; $row = $result->fetch_object(LibroModel::class); $i++) {
//
//                $listaLibros[$i] = $row;
//            }
        }
        $db_connection->close();

        if ($id!=null){
            $devolucion=$listaLibros[0];
        } else {
            $devolucion=$listaLibros;
        }
        return $devolucion;
    }


    public static function getLibrosConAutores($minpag, $maxpag)
    {
        //$listaLibrosConAutores = null;
        $devolucion=null;
        $libroConAutores=new LibroConAutoresModel();
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "Select L.ID, L.Nombre, L.NumeroPaginas, A.ID, A.Nombre, A.Apellidos From Libros as L inner join LibrosAutores as LA
                  on L.ID=LA.IDLibro inner join Autores as A 
                  on A.ID=LA.IDAutor where L.NumeroPaginas between $minpag and $maxpag";

        $prep_query = $db_connection->prepare($query);

        $prep_query->execute();
        $listaLibrosConAutores = array();

        $prep_query->bind_result($cod, $tit, $pag, $idAutor, $nombreAutor, $apellidosAutor);
        while ($prep_query->fetch()) {
            $tit = utf8_encode($tit);
            $libroConAutores->setCodigo($cod);
            $libroConAutores->setTitulo($tit);
            $libroConAutores->setNumpag($pag);

            $autor=new AutorModel($idAutor, $nombreAutor, $apellidosAutor);

            $libroConAutores->autores[]=$autor;

            $listaLibrosConAutores[] = $libroConAutores;
        }

        $db_connection->close();

        return $listaLibrosConAutores;
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
    public static function insertLibro(LibrosModel $libro){
        $insertado=false;
        $conexion=DatabaseModel::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Insert INTO Libros (titulo, NumeroPaginas) values(?, ?)";
        $preparedStatement=$mySqlConnection->prepare($query);
        $titulo=$libro->getTitulo();
        $paginas=$libro->getNumpag();
        $preparedStatement->bind_param('si', $titulo, $paginas);
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
    public static function updateLibro(LibrosModel $libro){
        $actualizado=false;
        $conexion=DatabaseModel::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Update Libros set Titulo=?, NumeroPaginas=? where Codigo=?";
        $preparedStatement=$mySqlConnection->prepare($query);

        $titulo=$libro->getTitulo();
        $paginas=$libro->getNumpag();
        $codigo=$libro->getCodigo();
        $preparedStatement->bind_param('sii', $titulo, $paginas, $codigo);

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
    public static function deleteLibro(int $id){
        $eliminado=false;
        $conexion=DatabaseModel::getInstance();
        $mySqlConnection=$conexion->getConnection();
        $query="Delete from Libros where Codigo=?";
        $preparedStatement=$mySqlConnection->prepare($query);

        $preparedStatement->bind_param('i', $id);

        if($preparedStatement->execute()){
            $eliminado=true;
        }
        return $eliminado;
    }


}