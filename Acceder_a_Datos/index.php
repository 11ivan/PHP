<?php

require_once "DataBase.php";
require_once "TablaProductos.php";
require_once "GestoraDataBase.php";

//We also could have done:
//use \Constantes_DB\tabla1;
// And now we can use the class without preceding it with the namespace:
// echo tabla1::COD;

$db = Database::getInstance();
$mysqli = $db->getConnection();


$gestoraDB=new GestoraDataBase();
$gestoraDB->showProducts($mysqli);

?>

