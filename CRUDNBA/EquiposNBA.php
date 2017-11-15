<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 15/11/2017
 * Time: 21:04
 */

require_once "GestoraConexionEquipos.php";


    $gestoraConexioEquipos=new GestoraConexionEquipos();

    $gestoraConexioEquipos->muestraEquipos();

    //echo '<a href="AñadirEquipo.html" target="_blank" ><button type="button"> </button></a>';
    echo '<a href="AñadirEquipo.html" target="_blank" ><img src="images/iconoadd.png" style="width:40px;height:40px;border:0;"/></a>';
