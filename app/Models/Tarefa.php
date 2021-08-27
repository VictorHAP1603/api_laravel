<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tarefa extends Model
{
    protected $fillable = ['titulo', 'resolvido', 'corpo'];
    public $timestamps = false;


    public static function getAll() {
        $sql = "SELECT * FROM tarefas";
        return DB::select($sql);
    }

    public static function getOne($id) {
        $sql = "SELECT * FROM tarefas WHERE id = :id";
        return DB::select($sql, [':id' => $id]);
    }

    public static function create($title, $body) {
        $sql = "INSERT INTO tarefas (titulo, corpo) VALUES (:title, :body)";
        return DB::insert($sql, [":title" => $title, ":body" => $body]) ;
    }

    public static function edit($title, $body, $id) {
        $sql = "UPDATE tarefas SET titulo = :title, corpo = :body WHERE id = :id";
        return DB::update($sql, [":title" => $title, ":body" => $body, ':id' => $id]);
    }

    public static function remove($id) {
        $sql = "DELETE FROM tarefas WHERE id = :id";
        return DB::update($sql, [':id' => $id]);
    }

}
