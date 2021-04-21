<?php

namespace Core\Database;

use PDO;

class MysqlDatabase extends Database {

    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost') {
        parent::__construct($db_name, $db_user, $db_pass, $db_host);
    }

    public function getPDO () {
        if($this->base === null){
            $this->base = new PDO(
                "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8",
                $this->db_user,
                $this->db_pass
            );
            $this->base->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }
        return $this->base;
    }

    public function query ($statement, $attributes = null) {
        $req = $this->getPDO()->prepare($statement);
        return $req->execute($attributes);
    }

    public function prepare ($statement, $entity = null, $one = false, $attributes = null) {
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        if($entity === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $entity);
        }
        if($one){
            return $req->fetch();
        }
        return $req->fetchAll();
    }

    public function lastInsertId () {
        return $this->getPDO()->lastInsertId();
    }

}