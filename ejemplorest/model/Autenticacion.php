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


    /*function __construct($user, $password)
    {
        $this->user=$user;
        $this->password=$password;
    }*/

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



    public function validarUsuario(){
        $result=usuarioHandlerModel::validateUser($this->user, $this->password);
        $valido=false;

        if($result->num_rows>0){
            while($row=$result->fetch_assoc()) {
                if(password_verify($password, $row['Password'])) {
                    $valido = true;
                }
            }
        }
      return $valido;
    }

}