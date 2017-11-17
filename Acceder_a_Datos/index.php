<html>
    <head>
        <title>
            Home
        </title>
    </head>
    <body>
        <ul>
            <li><a href="AddProduct.html" >Ver producto</a> </li>
            <li><a href="" >Añadir producto</a> </li>
            <li><a href="" >Eliminar producto</a> </li>
            <li><<a href="" >Modificar producto</a> </li>
        </ul>
    </body>

</html>

<?php

require_once "DataBase.php.php";
require_once "TablaProductos.php";
require_once "GestoraDataBase.php";


$db = Conexion::getInstance();
$mysqli = $db->getConnection();
$gestoraDB=new GestoraDataBase();
//$gestoraDB->showProducts($mysqli);
//$gestoraDB->insertProduct($mysqli);


?>

