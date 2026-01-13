<?php

namespace Ejemplos\escuelas\controller;
use Ejemplos\escuelas\core\Request;
use Ejemplos\escuelas\model\MunicipioModel;
use Ejemplos\escuelas\model\vo\MunicipioVO;
class MunicipioController{

    public function index(){
        //Obtener todos los municipios
        $municipios = MunicipioModel::getFilter();
        $json = [];
        foreach($municipios as $municipio){
            $json[] = $municipio->toArray();
        }
        //Devolver los municipios en formato json (HTTP RESPONSE).
        http_response_code(200);
        echo json_encode($json);
    }

    public function show(int $id){
        //Obtener todos los municipios
        $municipio = MunicipioModel::getById($id);
        if(!isset($municipio)){
            http_response_code(404);
            echo json_encode(['error' => 'Recurso no encontrado.']);
            return;
        }

        $json= $municipio->toArray();
        //Devolver los municipios en formato json (HTTP RESPONSE).
        http_response_code(200);
        echo json_encode($json);
    }

    public function store(){
        //Obtener el MunicipioVO de la petición
        $request = new Request();
        $municipio = MunicipioVO::fromArray($request->body());
        $municipio = MunicipioModel::add($municipio);
        //Devolver los municipios en formato json (HTTP RESPONSE).
        $json = $municipio->toArray();
        http_response_code(201);
        echo json_encode($json);
    }

    public function update(int $id){
        //Obtener el MunicipioVO de la petición
        $request = new Request();
        $municipio = MunicipioModel::getById($id);
        if(!isset($municipio)){
            http_response_code(404);
            echo json_encode(['error' => 'Recurso no encontrado.']);
            return;
        }
        $municipio->updateVoParams(MunicipioVO::fromArray($request->body()));

        $municipio->setCodMunicipio($id);
        $municipio = MunicipioModel::update($municipio);
        //Devolver los municipios en formato json (HTTP RESPONSE).
        $json = $municipio->toArray();
        http_response_code(200);
        echo json_encode($json);
    }

    public function destroy(int $id){
       
        if(MunicipioModel::delete($id)) {
            http_response_code(204);
            echo json_encode(['mensaje'=> "Municipio $id eliminado."]);
        }else{
            http_response_code(401);
            echo json_encode(['error'=> "Municipio con id = $id no existe."]);
        }            
        
       
    }

}