<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use Error;
use Exception;

class TarefaController extends Controller
{

    private $array = ["error" => "", "result" => []];

    public function getAll() {
        try {
            $tarefas = Tarefa::getAll();

            foreach($tarefas as $tarefa) {
                array_push($this->array['result'], [
                    'id' => $tarefa->id,
                    'title' => $tarefa->titulo,
                ]);
            }

            return $this->array;
        } catch (\Exception $exception) {
            return $this->array['error'] = "Não foi possível encontrar os dados, tente novamente";
        }
    }

    public function getIOne($id) {
        try {

            $tarefa = Tarefa::getOne($id);

            if ($tarefa) {
                $this->array['result'] = $tarefa;
            } else {
                $this->array['error'] = "A tarefa não existe";
            }
            return $this->array;
        } catch (\Exception $exception) {

        }
    }

    public function create(Request $request) {
        try {
            $title = $request->input('title');
            $body = $request->input('body');

            if ($title && $body) {
                $novaTarefa = Tarefa::create($title, $body);
                $this->array['result'] = $novaTarefa;
            } else {
                $this->array['error'] = "Campos não enviados";
            }

            return $this->array;
        } catch (\Exception $ex) {

        }
    }

    public function edit(Request $request, $id) {
        try {
            $isExists = Tarefa::getOne($id);

            $title = $request->input('title');
            $body = $request->input('body');

            if (!$isExists) {
                $this->array['error'] = "Não foi possível encontrar a tarefa, tente novamente";
                return response()->json($this->array);
            }

            if (!$title || !$body) {
                $this->array['error'] = "Campos não enviados!";
                return response()->json($this->array);
            }

            $updateTask = Tarefa::edit($title, $body, $id);
            $this->array['result'] = $updateTask;
            return $this->array;
        } catch (\Exception $exception) {
            $this->array['error'] = "Não foi possível editar o dado, tente novamente";
            return $this->array;
        }
    }

    public function remove($id) {
        try {

            $tarefa = Tarefa::getOne($id);

            if ($tarefa) {
                Tarefa::remove($id);
                $this->array['result'] = "Tarefa deletada com sucesso";
            } else {
                $this->array['error'] = "A tarefa não existe";
            }
            return $this->array;
        } catch (\Exception $exception) {

        }
    }


}
