<?php

namespace Core;

use PDO;

class QueryBuilder 
{
    protected $model = null;
    protected $where = [];
    protected $params = [];

    public function model($model)
    {
        $this->model = $model;
        return $this;
    }

    public function where($column,$operator, $value = null)
    {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        $this->where[] = "$column $operator :$column";
        $this->params[":$column"] = $value;

        return $this;
    }

    public function get()
    {
        $db = $this-> dbConnect();

        $sql = "SELECT * FROM " . $this->model::getTableName();
        $query = $db->prepare($sql);
        $query->execute();

        $query-> setFetchMode(PDO::FETCH_CLASS, $this->model);

        return $query->fetchAll();
    }

    protected function dbConnect()
    {
        return new PDO('mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));
    }

    
}