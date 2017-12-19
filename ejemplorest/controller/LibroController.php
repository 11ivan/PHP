<?php

require_once "Controller.php";


class LibroController extends Controller
{
    public function manageGetVerb(Request $request)
    {
        $listaLibros = null;
        $id = null;
        $response = null;
        $code = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        $listaLibros = LibroHandlerModel::getLibro($id);

        if ($listaLibros != null) {
            $code = '200';
        } else {
            //We could send 404 in any case, but if we want more precission,
            //we can send 400 if the syntax of the entity was incorrect...
            if (LibroHandlerModel::isValid($id)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }
        $response = new Response($code, null, $listaLibros, $request->getAccept());
        $response->generate();
    }


    public function managePostVerb(Request $request)
    {
        $parameters=$request->getBodyParameters();
        $libro=new LibrosModel($parameters->titulo, $parameters->numpag);

        //Realizar insercion del libro
        if(LibroHandlerModel::insertLibro($libro)){
            $code="201";
        }else{
            $code="400";
            $libro=null;
        }
        $response = new Response($code, null, $libro, $request->getAccept());
        $response->generate();
    }


    public function managePutVerb(Request $request){
        $parameters=$request->getBodyParameters();
        $id=null;
        $libro=null;
        $code=400;

        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        if($id!=null){
            $libro=new LibrosModel($parameters->titulo, $parameters->numpag, $id);
            if (LibroHandlerModel::updateLibro($libro)) {
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
            if (LibroHandlerModel::deleteLibro($id)) {
                $code=200;
            }
        }

        $response=new Response($code, null, null, $request->getAccept());
        $response->generate();
    }

}