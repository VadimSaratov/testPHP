<?php
namespace test\components;

class Validate{

    private $_result = false,
            $_errors = [],
            $_field_name = '';

    public function check($source,$items = []){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $rule_value){
                $value = htmlentities(trim($source[$item]), ENT_QUOTES);
               if (isset($rules['name'])){
                   $this->_field_name = $rules['name'];
               }
               if ($rule === 'required' && empty($value)){
                   $error = 'Поле ' . $this->_field_name . ' должно быть заполнено!';
                   $this->add_error($item, $error);
               }elseif(!empty($value)){
                   switch ($rule){
                       case 'min':
                           if (mb_strlen($value) < $rule_value){
                               $error = 'Поле ' . $this->_field_name . ' должно быть не меньше ' . $rule_value . ' символов!';
                               $this->add_error($item, $error);
                           }
                           break;
                       case 'max':
                           if (mb_strlen($value) > $rule_value){
                               $error = 'Поле' . $this->_field_name . 'должно быть не больше ' . $rule_value . ' символов!';
                               $this->add_error($item, $error);
                           }
                           break;
                       case 'validate_email':
                           if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
                               $error = 'Некорректно введен ' . $this->_field_name . '!';
                               $this->add_error($item, $error);
                           }
                           break;
                   }
               }
            }
        }
        if (empty($this->_errors)){
            $this->_result = true;
        }
        return $this;
    }

    private function add_error($field, $error){
        $this->_errors[$field] = $error;
    }

    public function get_errors(){
        return $this->_errors;
    }
    public function passed(){
        return $this->_result;
    }


}