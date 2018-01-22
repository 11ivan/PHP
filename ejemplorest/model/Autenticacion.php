<?php

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 22/01/18
 * Time: 10:34
 */
class Autenticacion
{

    private $user;
    private $password;


    function __construct($user, $password)
    {
        $this->user=$user;
        $this->password=$password;
    }

    public static function validarUsuario($password){
        UsuarioHandlerModel::exists();
    }

}