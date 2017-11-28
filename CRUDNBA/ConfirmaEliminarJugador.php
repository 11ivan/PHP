<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 28/11/2017
 * Time: 19:52
 */


$nombreJugador=$_GET['jugador'];

echo '<form action="DeleteJugador.php" method="post">';

    echo 'Se procederá a eliminar al jugador '.$nombreJugador;
    echo "<input type='hidden' name='nombreJugador' value='$nombreJugador'>";
    echo '<input type="submit" name="boton" value="Si"></br>';
    echo '<input type="submit" name="boton" value="No">';

echo '</form>';