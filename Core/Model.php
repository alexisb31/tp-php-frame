<?php

namespace Core;

abstract class Model
{

    protected static $table = null;

    protected $attributes = [];

    public static function query()
    {
        return (new QueryBuilder())->model(get_called_class());
    }

    public static function find($id)
    {

        return static::query()
            ->where('id', $id)
            ->first();

        // $db = self::dbConnect();

        // $table = self::getTableName();

        // $sql = "SELECT * FROM $table WHERE id = :id";
        // $query = $db->prepare($sql);
        // $query->execute(['id' => $id]);

        // $query-> setFetchMode(PDO::FETCH_CLASS, get_called_class());

        // return $query->fetch();
    }

    public static function get()
    {
        return static::query()
            ->get();
    }

    
    public static function getTableName()
    {

        if (isset(static::$table)) {
            return static::$table;
        }
        
        $singular = strtolower(getClassBasename(get_called_class()));

        switch (substr($singular, -1)) {
            case 'y':
                return substr($singular, 0, -1) . 'ies';
            case 's':
            case 'o':
                return $singular . 'es';
            default:
                return $singular . 's';
        }

        
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }
}