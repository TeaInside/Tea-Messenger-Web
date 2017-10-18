<?php

namespace System\Database;

use PDO;
use System\Hub\Singleton;
use System\Contracts\Database\QueryBuilder;
use System\Foundation\Database\DatabaseFactory;

/**
 * @author arbiyanto <arbiyantowijaya17@gmail.com>
 */

class DB extends DatabaseFactory implements QueryBuilder
{
    use Singleton;

    /**
     *
     * @var bool
     */
    private $showErrorQuery;

    /**
     *
     * @var array
     */
    protected $optionWhere     = [];

    /**
     *
     * @var array
     */
    protected $optionWhereData = [];

    /**
     *
     * @var array
     */
    protected $optionJoin      = [];

    /**
     *
     * @var string
     */
    protected $optionOrder;

    /**
     *
     * @var int
     */
    protected $optionLimit;

    /**
     *
     * @var string
     */
    protected $optionSelect;

    /**
     *
     * @var string
     */
    protected $table_name;

    public static function getInstance()
    {
        if (self::$instance === null || !((self::$instance)->pdo  instanceof \PDO)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->showErrorQuery = true;
        try {
            $this->pdo = new \PDO(
                DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME,
                DB_USER,
                DB_PASS,
                [
                    \PDO::ATTR_PERSISTENT => false
                ]
            );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    /**
     * Execute Override
     *
     * @param  string $statement
     * @param  array  $data
     * @return \PDO
     */
    protected static function exec($statement, $data)
    {
        $self      = self::getInstance();

        $statement = $self->makeStatement($statement);

        $make      = $self->pdo->prepare($statement);
        $data      = array_merge($data, $self->optionWhereData);
        $make->execute($data);
        $self->makeEmpty();

        $error  = $make->errorInfo();
        if ($error[1] and $self->showErrorQuery) {
            var_dump(
                array(
                    "Error" => $error
                )
            );
        }

        return $make;
    }

    /**
     * Make Query Statement
     *
     * @param  string $statement
     * @return string
     */
    protected static function makeStatement($statement)
    {
        $self  = self::getInstance();

        $optionWhere = (!empty($self->optionWhere)) ? " WHERE ". substr(implode("", $self->optionWhere), 4) : null;
        $optionJoin  = implode("", $self->optionJoin);
        $optionOrder = $self->optionOrder;
        $optionLimit = $self->optionLimit;

        return $statement.$optionJoin.$optionWhere.$optionOrder.$optionLimit;
    }

    /**
     * Make Insert Parameter
     *
     * @param  array $data
     * @return array
     */
    protected static function makeInsertParameter($data)
    {
        foreach ($data as $field => $value) {
            $newData[":{$field}"] = $value;
        }

        return $newData;
    }

    /**
     * Make Multiple Insert Parameter
     *
     * @param  string $table
     * @param  array  $data
     * @return array
     */
    protected static function makeMultipleInsert($table, $data)
    {
        $insert_values = array();

        foreach ($data as $d) {
            $insert_values = array_merge($insert_values, array_values($d));

            $count = count($d);
            $array = array_fill(0, $count, '?');

            $placeholder[] = '('.implode(',', $array).')';
        }

        $column = implode(',', array_keys($data[0]));
        $values = implode(',', $placeholder);

        $query  = "INSERT INTO {$table} ({$column}) VALUES {$values}";

        return [$query, $insert_values];
    }

    /**
     * Make Update Parameter
     *
     * @param  array $data
     * @return array
     */
    protected static function makeUpdateParameter($data)
    {
        foreach ($data as $field => $value) {
            $newData[] = "{$field}=:{$field}";
        }

        $newData = implode(",", $newData); // override new data

        return $newData;
    }

    /**
     * Make Select Query
     *
     * @return string
     */
    protected static function makeSelect()
    {
        $self   = self::getInstance();
        $select = (!empty($self->optionSelect)) ? $self->optionSelect : "*";

        return "SELECT {$select} FROM {$self->table_name} ";
    }

    /**
     * Empty All Option
     *
     * @return Instance
     */
    protected static function makeEmpty()
    {
        $self  = self::getInstance();

        $self->optionWhere     = [];
        $self->optionWhereData = [];
        $self->optionJoin      = [];
        $self->optionLimit     = null;
        $self->optionSelect    = null;
        $self->table_name      = null;

        return $self;
    }

    /**
     * Make Where Statement Valid
     *
     * @param  string        $param
     * @param  string        $column
     * @param  string        $operator
     * @param  string || int $value
     * @return Instance
     */
    protected function makeWhere($param, $column, $operator, $value)
    {
        return empty($value) ? "{$column}=:where_{$param}" : "{$param} {$operator} :where_{$param}";
    }

    /**
     * Make Option Where Value
     *
     * @param  string        $param
     * @param  string        $column
     * @param  string        $operator
     * @param  string || int $value
     * @return Instance
     */
    protected function makeOptionWhere($param, $column, $operator, $value)
    {
        return (empty($value)) ? $operator : $value;
    }

    /**
     * Make Where Array
     *
     * @param  array  $array
     * @param  string $type
     * @return Instance
     */
    protected function makeArrayOfWhere($array, $type)
    {
        $self = self::getInstance();

        if (array_key_exists(0, $array)) :
            foreach ($array as $a) :
                $make = [
                    'parameter' => str_replace(".", "_", $a[0]),
                    'column'    => $a[0],
                    'operator'  => $a[1],
                    'value'     => (isset($a[2])) ? $a[2] : null,
                ];


        $where = $self->makeWhere(
                    $make['parameter'],
                    $make['column'],
                    $make['operator'],
                    $make['value']
                );

        $whereData = $self->makeOptionWhere(
                    $make['parameter'],
                    $make['column'],
                    $make['operator'],
                    $make['value']
                );

        array_push($self->optionWhere, $type.$where);

        $self->optionWhereData = array_merge(
                    $self->optionWhereData,
                    [":where_{$make['parameter']}" => $whereData]
                );
        endforeach; else :
            foreach ($array as $a => $v) :
                $param     = str_replace(".", "_", $a);
        $where     = $self->makeWhere($param, $a, '=', $v);
        $whereData = $self->makeOptionWhere($param, $a, '=', $v);

        array_push($self->optionWhere, $type.$where);
        $self->optionWhereData = array_merge($self->optionWhereData, [":where_{$param}" => $whereData]);
        endforeach;

        endif;

        return $self;
    }

    /**
     * Make String Where
     *
     * @return Instance
     */
    protected function makeStringOfWhere($column, $operator = null, $value = null, $type)
    {
        $self = self::getInstance();

        $param     = str_replace(".", "_", $column); // remove table seperator for parameter
        $where     = $self->makeWhere($param, $column, $operator, $value);
        $whereData = $self->makeOptionWhere($param, $column, $operator, $value);

        array_push($self->optionWhere, $type.$where);
        $self->optionWhereData = array_merge($self->optionWhereData, [":where_{$param}" => $whereData]);

        return $self;
    }

    /**
     * Check Where
     *
     * @return Instance
     */
    protected static function whereExecute($column, $operator, $value, $type)
    {
        $self      = self::getInstance();

        if (is_array($column)) {
            return $self->makeArrayOfWhere($column, $type);
        } else {
            return $self->makeStringOfWhere($column, $operator, $value, $type);
        }

        return $self;
    }

    /**
     * Check Where
     *
     * @return Boolean
     */
    protected function makeIncreDecrement($column, $value = null, $where = [], $operator)
    {
        $self = self::getInstance();

        $table = $self->table_name;

        $val = (!empty($value)) ? (int) $value : 1;

        if (!empty($where)) {
            $self = $self->where($where);
        }

        $statement = "UPDATE {$table} SET {$column} =  {$column} {$operator} {$val}";

        return $self->exec($statement, []);
    }



    /**
     * Set Table
     *
     * @param  string $table
     * @return Instance
     */
    public static function table($table)
    {
        $self             = self::getInstance();
        $self->table_name = $table;

        return $self;
    }

    /**
     * Insert & Multiple Insert
     *
     * @param  array $data
     * @return boolean
     */
    public static function insert($data)
    {
        $self  = self::getInstance();
        $table = $self->table_name;

        if (isset($data[0])) {
            $make      = $self->makeMultipleInsert($table, $data);
            $statement = $make[0];
            $value     = $make[1];
        } else {
            $newData    = $self->makeInsertParameter($data);
            $column     = implode(",", array_keys($data));
            $paramValue = implode(",", array_keys($newData));
            $statement  = "INSERT INTO {$table} ({$column}) VALUES({$paramValue});";
            $value      = $newData;
        }

        $execute   = $self->exec($statement, $value);

        return $execute;
    }
   
    /**
     * Update Record
     *
     * @param  array $data
     * @return boolean
     */
    public static function update($data)
    {
        $self      = self::getInstance();

        $table     = $self->table_name;
        $param     = $self->makeUpdateParameter($data);
        $value     = $self->makeInsertParameter($data);

        $statement = "UPDATE {$table} SET {$param} ";
        $execute   = $self->exec($statement, $value);

        return $execute;
    }

    /**
     * Delete Record
     *
     * @return boolean
     */
    public static function delete()
    {
        $self  = self::getInstance();
        $table = $self->table_name;

        $query = "DELETE FROM {$table} ";

        return $self->exec($query, []);
    }

    /**
     * Join Option
     *
     * @param  string $table
     * @param  string $foreignKey1
     * @param  string $foreignKey2
     * @param  string $relation
     * @return boolean
     */
    public function join($table, $foreignKey1, $operator, $foreignKey2, $relation = "INNER")
    {
        $self               = self::getInstance();
        $self->optionJoin[] = " {$relation} JOIN {$table} ON {$foreignKey1}{$operator}{$foreignKey2}";
        return $self;
    }

    public function rightJoin($table, $foreignKey1, $operator, $foreignKey2, $relation = "RIGHT")
    {
        $self               = self::getInstance();
        $self->optionJoin[] = " {$relation} JOIN {$table} ON {$foreignKey1}{$operator}{$foreignKey2}";
        return $self;
    }

    public function leftJoin($table, $foreignKey1, $operator, $foreignKey2, $relation = "LEFT")
    {
        $self               = self::getInstance();
        $self->optionJoin[] = " {$relation} JOIN {$table} ON {$foreignKey1}{$operator}{$foreignKey2}";
        return $self;
    }

    /**
     * Where Option
     *
     * @param  string $column
     * @param  string $operator
     * @param  string $value
     * @param  string $type
     * @return Instance
     */

    public static function where($column, $operator = null, $value = null, $type = " AND ")
    {
        return self::getInstance()->whereExecute($column, $operator, $value, $type);
    }

    public static function orWhere($column, $operator = null, $value = null, $type = " OR ")
    {
        return self::getInstance()->whereExecute($column, $operator, $value, $type);
    }

    public static function like($column, $value)
    {
        return self::getInstance()->where($column, 'LIKE', $value);
    }

    public static function orLike($column, $value)
    {
        return self::getInstance()->orWhere($column, 'LIKE', $value);
    }

    /**
     * Increment & Decrement
     *
     * @param  string         $column
     * @param  string/integer $value
     * @param  array          $where
     * @param  string         $operator
     * @return Instance
     */

    public function increment($column, $value = null, $where = [], $operator = "+")
    {
        return self::getInstance()->makeIncreDecrement($column, $value, $where, $operator);
    }

    public function decrement($column, $value = null, $where = [], $operator = "-")
    {
        return self::getInstance()->makeIncreDecrement($column, $value, $where, $operator);
    }

    /**
     * Limit Option
     * @param   string || integer $limit
     * @param   string || integer $offset
     * @return  Instance
     */
    public function limit($limit, $offset = null)
    {
        $self              = self::getInstance();
        $offset            = (!empty($offset)) ? 'OFFSET '.$offset : null;
        $self->optionLimit = " LIMIT {$limit} ".$offset;

        return $self;
    }

    /**
     * Offset Option
     * @param   string || integer $offset
     * @return  Instance
     */
    public function offset($offset)
    {
        $self              = self::getInstance();
        $self->optionLimit .= " OFFSET ".$offset;

        return $self;
    }

    /**
     * Order By Column Option
     * @param   string || integer $column
     * @param   string || integer $sort
     * @return  Instance
     */
    public function orderBy($column, $sort)
    {
        $self              = self::getInstance();
        $self->optionOrder = " ORDER BY {$column} {$sort}";

        return $self;
    }

    /**
     * Select Option
     * @return  Instance
     */
    public static function select()
    {
        $self         = self::getInstance();
        $self->optionSelect = implode(",", func_get_args());

        return $self;
    }

    /**
     * Get All Record
     * @return  Array
     */
    public static function get()
    {
        $self      = self::getInstance();

        $statement = $self->makeSelect();
        $execute   = $self->exec($statement, []);

        return $execute->fetchAll(\PDO::FETCH_CLASS);
    }

    /**
     * Get All Record Alias
     * @return  Array
     */
    public static function all()
    {
        return self::getInstance()->get();
    }

    /**
     * Get First Record
     * @return  Array
     */
    public static function first()
    {
        $self      = self::getInstance();

        $statement = $self->makeSelect();
        $execute   = $self->exec($statement, []);

        return $execute->fetchObject();
    }

    /**
     * Count Record
     * @return  Array
     */
    public static function count()
    {
        $self      = self::getInstance();

        $statement = $self->makeSelect();
        $execute   = $self->exec($statement, []);

        return $execute->rowCount();
    }

    /**
     * Max Record
     * @return  StdClass
     */
    public static function max($column)
    {
        $self      = self::getInstance();
        
        if (empty($self->optionSelect)) {
            $self->optionSelect = "MAX({$column})";
        } else {
            $self->optionSelect .= ",MAX({$column})";
        }
        

        $statement = $self->makeSelect();
        $execute   = $self->exec($statement, []);

        return $execute->fetchObject();
    }

    /**
     * Min Record
     * @return  StdClass
     */
    public static function min($column)
    {
        $self      = self::getInstance();
        
        if (empty($self->optionSelect)) {
            $self->optionSelect = "MIN({$column})";
        } else {
            $self->optionSelect .= ",MIN({$column})";
        }
        

        $statement = $self->makeSelect();
        $execute   = $self->exec($statement, []);

        return $execute->fetchObject();
    }

    /**
     * Avg Record
     * @return  StdClass
     */
    public static function avg($column)
    {
        $self      = self::getInstance();
        
        if (empty($self->optionSelect)) {
            $self->optionSelect = "AVG({$column})";
        } else {
            $self->optionSelect .= ",AVG({$column})";
        }
        

        $statement = $self->makeSelect();
        $execute   = $self->exec($statement, []);

        return $execute->fetchObject();
    }

    /**
     * Get Last Insert ID
     * @return  Integer
     */
    public function lastId()
    {
        return $this->pdo->lastInsertId();
    }

    public static function pdoInstance()
    {
        return self::getInstance()->pdo;
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    /**
     * @todo Close \PDO Connection.
     */
    public static function close()
    {
        $self   = self::getInstance();
        $self->pdo = null;
    }

    public function __debugInfo()
    {
    }
}
