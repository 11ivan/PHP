<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 20/01/2018
 * Time: 16:00
 */
require_once "Controller.php";

class UsuarioController extends Controller
{

    public function manageGetVerb(Request $request)
    {
        $listaUsuarios = null;
        $id = null;
        $response = null;
        $code = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        $listaUsuarios = UsuarioHandlerModel::getUsario($id);

        if ($listaUsuarios != null) {
            $code = '200';
        } else {
            //We could send 404 in any case, but if we want more precission,
            //we can send 400 if the syntax of the entity was incorrect...
            if (UsuarioHandlerModel::isValid($id)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }
        $response = new Response($code, null, $listaUsuarios, $request->getAccept());
        $response->generate();
    }


    public function managePostVerb(Request $request)
    {
        $parameters=$request->getBodyParameters();
        $usuario=new UsuarioModel($parameters->Nombre, $parameters->Password, $parameters->TipoUsuario);

        //Realizar insercion del libro
        if(UsuarioHandlerModel::insertUsuario($usuario)){
            $code="201";
        }else{
            $code="400";
            $usuario=null;
        }
        $response = new Response($code, null, $usuario, $request->getAccept());
        $response->generate();
    }


    public function managePutVerb(Request $request){
        $parameters=$request->getBodyParameters();
        $id=null;
        $usuario=null;
        $code=400;

        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        if($id!=null){
            $usuario=new UsuarioModel($parameters->Nombre, $parameters->Password, $parameters->TipoUsuario, $id);
            if (UsuarioHandlerModel::updateUsuario($usuario)) {
                $code=204;
            }
        }

        $response=new Response($code, null, null, $request->getAccept());
        $response->generate();
    }

    public function manageDeleteVerb(Request $request)
    {
        $id=null;
        $code=400;

        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        if($id!=null){
            if (UsuarioHandlerModel::deleteUsuario($id)) {
                $code=200;
            }
        }

        $response=new Response($code, null, null, $request->getAccept());
        $response->generate();
    }

}