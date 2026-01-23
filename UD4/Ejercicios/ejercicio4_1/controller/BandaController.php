<?php

namespace Ejercicios\ejercicio4_1\controller;

use Ejercicios\ejercicio4_1\core\Request;
use Ejercicios\ejercicio4_1\core\Response;
use Ejercicios\ejercicio4_1\model\BandaModel;
use Ejercicios\ejercicio4_1\model\vo\BandaVo;
use Exception;

class BandaController
{
    private Request $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function index()
    {
        try {
            $bandas = BandaModel::getFilter();
            $data = [];
            $data = array_map(fn($banda) => $banda->toArray(),$bandas);           
            Response::json($data, 200);
        } catch (\Throwable $th) {
            error_log("BandaController->index() " . $th->getMessage());
            Response::serverError();
        }
    }

    public function show(int $id)
    {
        try {
            $banda = BandaModel::get($id);
            if ($banda === null) {
                Response::notFound();
                return;
            }

            Response::json($banda->toArray(), 200);
        } catch (\Throwable $th) {
            error_log("BandaController->show() " . $th->getMessage());
            Response::serverError();
        }
    }

    public function store()
    {
        try {
            $this->request->validate([
                'nombre'=>'required|string|max:100',
                'num_integrantes'=>'required|int|max:99|min:1',
                'genero'=> 'required|string|max:50',
                'nacionalidad' => 'string|max:50'
            ]);
            $data = $this->request->body();

            $banda = BandaVo::fromArray($data);
            $banda = BandaModel::add($banda);
            if($banda === null){
                throw new Exception("No se ha agregado la banda ".implode(',',$data));
            }
            Response::json($banda->toArray(),201);
        } catch (\Throwable $th) {
            error_log("BandaController->store() " . $th->getMessage());
            Response::serverError();
        }
    }

    public function update(int $id)
    {
        try {

            $this->request->validate([
                'nombre'=>'string|max:100',
                'num_integrantes'=>'int|max:99|min:1',
                'genero'=> 'string|max:50',
                'nacionalidad' => 'string|max:50'
            ]);
            
            //Obtenemos banda actual.
            $banda = BandaModel::get($id);
            if($banda === null){
                Response::notFound();
                return;
            }

            $data = $this->request->body();
            $banda->updateVoParams(BandaVo::fromArray($data));
            
            if(!BandaModel::update($banda)){
                throw new Exception("No se ha actualizado la banda ".implode(',',$data));
            }

            Response::json($banda->toArray(),200);
            
        } catch (\Throwable $th) {
            error_log("BandaController->update() " . $th->getMessage());
            Response::serverError();
        }
    }

    public function destroy(int $id)
    {
        try {
            
            if(!BandaModel::delete($id)){
                throw new Exception("No se ha eliminado la banda $id");
            }

            Response::json(['message'=>"Banda $id eliminada."],200);
            
        } catch (\Throwable $th) {
            error_log("BandaController->update() " . $th->getMessage());
            Response::serverError();
        }
    }
}