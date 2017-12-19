<?php

/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 19.12.2017
 * Time: 9:06
 */
use test\components\Input;
use test\components\Token;
use test\components\Redirect;
use test\components\Validate;
use test\model\User;


class UserController
{
    public function actionRegister()
    {
        if (Input::exists() && Input::get_value('full_name') !=''
            && Input::get_value('email') !=''
            && Input::get_value('region') !=''
            && Input::get_value('city') !=''
            && Input::get_value('district') !='') {
            if (Token::check_token(Input::get_value('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'full_name' => array(
                        'name' => 'ФИО',
                        'required' => true,
                        'min' => 10,
                        'max' => 35
                    ),
                    'email' => array(
                        'name' => 'email',
                        'required' => true,
                        'validate_email' => true,
                    ),
                    'region' => array(
                        'name' => 'Область',
                        'required' => true,
                    ),
                    'city' => array(
                        'name' => 'Город',
                        'required' => true,
                    ),
                    'district' => array(
                        'name' => 'Район',
                        'required' => true,
                    )
                ));

                if ($validation->passed()) {
                    $user = new User();
                    if ($user->find(Input::get_value('email'))){
                        $user->get_info(Input::get_value('email'));
                        $info = $user->data();
                        require_once ROOT . '/views/site/card.php';
                    }else{
                        $user->register(array(
                            'name' => Input::get_value('full_name'),
                            'email' => Input::get_value('email'),
                            'territory' => Input::get_value('district'),
                        ));
                        Redirect::to('/');
                    }
                } else {
                    $errors = $validation->get_errors();
                }
            }
            return true;
        }
        Redirect::to('/');
        return false;
    }

}