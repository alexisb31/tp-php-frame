<?php

namespace Core;

use PDO;

class QueryBuilder 
{
    protected $model = null;
    protected $where = [];
    protected $orderBy = [];

    public function model($model)
    {
        $this->model = $model;
        return $this;
    }



    public function orderBy($column, $order = 'ASC')
    {
        $this->orderBy[] = compact('column', 'order');
        return $this;
    }

    public function where($column,$operator, $value = null)
    {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        $this->where[] = compact('column', 'operator', 'value');

        return $this;
    }

    public function first(){
        return $this->get(first:true);
    }

    public function get($first = false)
    {
        $db = $this->dbConnect();

        $sql = "SELECT * FROM " . $this->model::getTableName() . ' WHERE 1';

        $values = [];

        foreach ($this->where as $index => $condition) {
            $sql .= ' AND ' . $condition['column'] . ' ' . $condition['operator'] . ' :' . $condition['column'] . $index;
            $values[$condition['column'] . $index] = $condition['value'];
        }

        if (!empty($this->orderBy)) {
            $orderByClauses = array_map(function ($order) {
                return $order['column'] . ' ' . $order['order'];
            }, $this->orderBy);
            $sql .= ' ORDER BY ' . implode(', ', $orderByClauses);
        }

        $query = $db->prepare($sql);

        $query->execute($values);

        $query->setFetchMode(PDO::FETCH_CLASS, $this->model);

        return $first ? $query->fetch() : $query->fetchAll();
    }

    protected function dbConnect()
    {
        return new PDO('mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));
    }

}
