<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 19.12.2017
 * Time: 10:04
 */
namespace test\model;
use test\components\DB;

class User{
    private  $_db,
             $_data;

    public function __construct($user = null)
    {
        $this->_db = DB::get_instance();
    }

    public function register($items)
    {
        $this->_db->query('CREATE TABLE IF NOT EXISTS `testPHP`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , 
            `name` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
             `email` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
              `territory` CHAR(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
               PRIMARY KEY (`id`), FOREIGN KEY `fkterritory` (`territory`)
                REFERENCES `testPHP`.`t_koatuu_tree` (`ter_id`)) ENGINE = InnoDB ');
        if ($this->_db->db_insert('users', $items)) {
            return true;
        }
        return false;
    }

    public function find($email)
    {
            $data = $this->_db->query('SELECT `email` FROM `users` WHERE `email` = ?', array($email));
            if ($data->get_count()) {
                $this->_data = $data->first_result();
                return true;
            }
        return false;

    }

    public function get_info($field){
        $data = $this->_db->query('SELECT t1.name, t1.email, t1.territory, t2.ter_address,t2.ter_id
  FROM users t1
  LEFT JOIN t_koatuu_tree t2 ON t1.territory = t2.ter_id
  WHERE `email` = ?;', array($field));
        $this->_data = $data->first_result();
        return true;
    }

    public function data()
    {
        return $this->_data;
    }
}