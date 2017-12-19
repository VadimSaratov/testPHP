<?php

use \test\model\Main;
use \test\components\Input;
use \test\components\Redirect;

class MainController {

	public function actionMain(){
		$regions = Main::get_regions();
		require_once(ROOT . '/views/site/main.php');

		return true;
	}

	public function actionAjax(){

	    if (Input::exists() && Input::get_value('action') != ''){
	    	switch (Input::get_value('action')){
			    case 'showCity':
			    	$results = Main::get_city(Input::get_value('pid'));
				    foreach ($results as $result){
				 echo  '<option value="'. $result['ter_id'] .'">'. $result['ter_name'] .'</option>';
		        };
				    break;
			    case 'showDistrict':
				    $results = Main::get_district(Input::get_value('pid'));
				    foreach ($results as $result){
					    echo  '<option value="'. $result['ter_id'] .'">'. $result['ter_name'] .'</option>';
				    };
				    break;
		    }
		    return true;
        }
		Redirect::to('/');
	    return false;
    }

}