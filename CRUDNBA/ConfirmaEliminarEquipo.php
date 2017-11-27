<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 27/11/17
 * Time: 12:40
 */

$nombreEquipo=$_GET['equipo'];

echo '<form action="DeleteEquipo.php" method="post">';

    echo 'Se procederá a eliminar al equipo '.$nombreEquipo;
    echo "<input type='hidden' name='nombreEquipo' value='$nombreEquipo'>";
    echo '<input type="submit" name="boton" value="Si"></br>';
    echo '<input type="submit" name="boton" value="No">';

echo '</form>';