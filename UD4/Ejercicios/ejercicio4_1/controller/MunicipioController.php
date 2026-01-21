<?php

namespace Ejercicios\ejercicio4_1\controller;
use Ejercicios\ejercicio4_1\core\Request;
use Ejercicios\ejercicio4_1\model\MunicipioModel;
use Ejercicios\ejercicio4_1\model\vo\MunicipioVO;
use Ejercicios\ejercicio4_1\core\Response;

class MunicipioController{

    public function index(){
        //Obtener todos los municipios
        $municipios = MunicipioModel::getFilter();
        $json = [];
        foreach($municipios as $municipio){
            $json[] = $municipio->toArray();
        }
        //Devolver los municipios en formato json (HTTP RESPONSE).
        Response::json($json, 200);
    }

    public function show(int $id){
        //Obtener todos los municipios
        $municipio = MunicipioModel::getById($id);
        if(!isset($municipio)){
            Response::notFound();
            return;
        }
        Response::json($municipio->toArray(), 200);
    }

    public function store(){
        //Obtener el MunicipioVO de la petición
        $request = new Request();
        $municipio = MunicipioVO::fromArray($request->body());
        $municipio = MunicipioModel::add($municipio);
        //Devolver los municipios en formato json (HTTP RESPONSE).
        Response::json($municipio->toArray(), 201);
    }

    public function update(int $id){
        //Obtener el MunicipioVO de la petición
        $request = new Request();
        $municipio = MunicipioModel::getById($id);
        if(!isset($municipio)){
            Response::notFound();
            return;
        }
        $municipio->updateVoParams(MunicipioVO::fromArray($request->body()));

        $municipio->setCodMunicipio($id);
        $municipio = MunicipioModel::update($municipio);
        //Devolver los municipios en formato json (HTTP RESPONSE).
        Response::json($municipio->toArray(),200);
    }

    public function destroy(int $id){
       
        if(MunicipioModel::delete($id)) {
            Response::json(['mensaje'=> "Municipio $id eliminado."],200);
        }else{
            Response::notFound();
        }            
        
       
    }

}