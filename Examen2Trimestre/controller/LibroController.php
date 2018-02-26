<?php

require_once "Controller.php";


class LibroController extends Controller
{
    public function manageGetVerb(Request $request)
    {
        ///libro?minpag=0&maxpag=500
        $listaLibrosConAutores = null;
        $minpag = null;
        $maxpag=null;
        $response = null;
        $code = null;
        $queryString=null;
        $queryString=$request->getQueryString();
        //if the URI refers to a libro entity, instead of the libro collection
        //if (isset($request->getQueryString()[0])) {
            //$minpag = $request->getQueryString()[0];
        $minpag = 0;
        //}
        //if (isset($request->getQueryString()[1])) {
            //$maxpag = $request->getQueryString()[1];
        $maxpag = 100;
        //}

        $listaLibrosConAutores = LibroHandlerModel::getLibrosConAutores($minpag, $maxpag);

        if ($listaLibrosConAutores != null) {
            $code = '200';
        } else {
            $code = '400';
        }
        $response = new Response($code, null, $listaLibrosConAutores, $request->getAccept());
        $response->generate();
    }




}