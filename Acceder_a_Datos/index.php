<?php

require_once "DataBase.php";
require_once "TablaProductos.php";

//We also could have done:
//use \Constantes_DB\tabla1;
// And now we can use the class without preceding it with the namespace:
// echo tabla1::COD;

$db = Database::getInstance();
$mysqli = $db->getConnection();
$sql_query = "SELECT ". \Constantes_DB\TablaProductos::ID . " , " . \Constantes_DB\TablaProductos::NOMBRE . " , " . \Constantes_DB\TablaProductos::PRECIO ." FROM ". \Constantes_DB\TablaProductos::TABLE_NAME;


$result = $mysqli->query($sql_query);

if ($result->num_rows > 0) {
    echo '<table border=\"1\">';
    echo '<tr>';
    echo '<td>' . \Constantes_DB\TablaProductos::ID  . '</td><td>' . \Constantes_DB\TablaProductos::NOMBRE  . '</td><td>' . \Constantes_DB\TablaProductos::PRECIO . '</td>';
    echo '</tr>';
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row[\Constantes_DB\TablaProductos::ID]  . '</td>td>' . $row[\Constantes_DB\TablaProductos::NOMBRE]  . '</td><td>' . $row[\Constantes_DB\TablaProductos::PRECIO] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}


?>

