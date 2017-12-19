<?php
namespace test\components;

class Redirect
{
    public static function to($location = null){
        if ($location){
            if (is_numeric($location)){
                switch ($location){
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        require_once ROOT . 'views/site/404.php';
                        exit;
                     break;
                }
            }
            header('Location: ' . $location);
            exit;
        }

    }
}