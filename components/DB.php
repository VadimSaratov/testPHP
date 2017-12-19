<?php
namespace test\components;

class DB
{
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results = [],
            $_count = 0;

    private function __construct()
    {
            $paramsPath = ROOT . '/config/db_params.php';
            $params = include($paramsPath);
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $this->_pdo = new \PDO($dsn, $params['user'], $params['password']);
            $this->_pdo->exec("set names utf8");
    }

    public static function get_instance(){
        if (!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $values = []){
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if (count($values)){
                foreach ($values as $value){
                    $this->_query->bindValue($x,$value,\PDO::PARAM_STR);
                        $x++;
                }
            }
            if ($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(\PDO::FETCH_ASSOC);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }
        return $this;

    }

    public function db_insert($table, $fields = []){
            $keys = array_keys($fields);
            $values = '';
            //$x = 1;
            for ($i = 1; $i <= count($fields); $i++){
                $values .= '?';
                if ($i < count($fields)){
                    $values .= ', ';
                }
            }
            $sql = "INSERT INTO {$table} (`" . implode('`, `',$keys) . "`) VALUES({$values})";
            if (!$this->query($sql, $fields)->error()){
                return true;
            }
            return false;
    }

    public function error(){
        return $this->_error;
    }

    public function get_results(){
        return $this->_results;
    }
    public function first_result(){
        return $this->get_results()[0];
    }
    public function get_count(){
        return $this->_count;
    }


}
