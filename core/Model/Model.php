<?php


namespace Core\Model;


use Core\Database\MysqlDatabase;

class Model {

    protected $id;
    protected $table;
    protected $entity;

    protected $base;

    public function __construct(MysqlDatabase $db) {
        $this->base = $db;
        $table = get_class($this);
        $parts = explode('\\', $table);
        $table = end($parts);
        $table = str_replace('Model', '', $table);
        $this->entity = $this->entity === null ? $table . 'Entity' : $this->entity;
        $this->entity = 'App\Entity\\' . $this->entity;
        $this->id = $this->id === null ? $this->id = 'id' . $table : $this->id;
        $table = strtolower($table);
        $this->table = $this->table === null ? $this->table = $table : $this->table;
    }

    public function all () {
        return $this->base->prepare("select * from {$this->table}", $this->entity);
    }

    public function lastId () {
        return $this->base->lastInsertId();
    }

    public function delete ($id) {
        return $this->base->query("delete from {$this->table} where {$this->id}=?", [$id]);
    }

    public function insert(...$args) {

    }

    public function update ($id, ...$args) {

    }

}