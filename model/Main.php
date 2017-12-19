<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 17.12.2017
 * Time: 20:36
 */

namespace test\model;


use test\components\DB;

class Main {

	public static function get_regions(){

		$db = DB::get_instance();
//		$db->db_select('*','t_koatuu_tree', array('ter_type_id', '=', '0'));
		$db->query('SELECT * FROM `t_koatuu_tree` WHERE ter_type_id = ?',array('0'));
		return $db->get_results();
	}

	public static function get_city($id, $type_id = null){
		$db = DB::get_instance();
		$db->query("SELECT * FROM `t_koatuu_tree` WHERE (ter_name LIKE 'м.%')AND reg_id = ?",array($id));
		return $db->get_results();

	}



	public static function get_district($id){
		$db = DB::get_instance();
		$db->query("SELECT * FROM `t_koatuu_tree` WHERE ter_pid = ? AND ter_type_id = ?", array($id, 3));
		return $db->get_results();

	}

}