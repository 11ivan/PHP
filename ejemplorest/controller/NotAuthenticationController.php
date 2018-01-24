<?php
require_once "Controller.php";


/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 24/01/18
 * Time: 8:53
 */
class NotAuthenticationController extends Controller
{
    public function manage(Request $req)
    {
        $response = new Response('401', null, null, $req->getAccept());
        $response->generate();
    }
}