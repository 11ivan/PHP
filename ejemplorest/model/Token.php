<?php

use Firebase\JWT\JWT as JWT;
//require_once "Firebase\JWT";
$upOne = realpath(__DIR__ . '/..');
require_once  $upOne.'/phpjwtmaster/src/JWT.php';
$upOne2 = realpath(__DIR__ . '/..');
require_once  $upOne2.'/phpjwtmaster/src/SignatureInvalidException.php';

/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 7/02/18
 * Time: 8:43
 */
class Token
{

    private static $secret_key = 'Sdw1s9x8@';
    private static $encrypt = ['HS256'];
    private static $aud = null;

    /**
     *
     */
    /*function generateToken(){
        $time = time();
        $key = 'my_secret_key';
        $token = array(
            'iat' => $time, // Tiempo que inició el token
            'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
            'data' => [ // información del usuario
                'id' => 1,
                'name' => 'Eduardo'
            ]
        );
        return $jwt = JWT::encode($token, $key);
        $data = JWT::decode($jwt, $key, array('HS256'));
        var_dump($data);
    }*/

    /*function generateToken(){
        $time = time();
        $key = 'my_secret_key';
        $token = array(
            'iat' => $time, // Tiempo que inició el token
            'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
        );
        return $jwt = JWT::encode($token, $key);
        //$data = JWT::decode($jwt, $key, array('HS256'));
        //var_dump($data);
    }*/

    function generateToken()
    {
        $time = time();

        $token = array(
            'exp' => $time + (60*60),
            'aud' => self::Aud(),
        );
        return JWT::encode($token, self::$secret_key);
    }

    function Check($token)
    {
        $valido=true;
        if(empty($token))
        {
            //throw new Exception("Invalid token supplied.");
            $valido=false;
        }

        if($valido) {
            try {
                $decode = JWT::decode(
                    $token,
                    self::$secret_key,
                    self::$encrypt
                );
            }catch (Exception $e){
                $valido=false;
            }

            if($valido && $decode->aud !== self::Aud())
            {
                //throw new Exception("Invalid user logged in.");
                $valido=false;
            }
        }
        return $valido;
    }

    public static function GetData($token)
    {
        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    private static function Aud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }



}