<?php

namespace Core\Database;

class Database {

    protected $db_name;
    protected $db_user;
    protected $db_host;
    protected $db_pass;
    protected $base;

    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost') {
        $this->db_pass = $db_pass;
        $this->db_user = $db_user;
        $this->db_name = $db_name;
        $this->db_host = $db_host;
    }


}