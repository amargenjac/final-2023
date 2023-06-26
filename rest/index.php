<?php

require "../vendor/autoload.php";
require "./services/MidtermService.php";
require "./services/FinalService.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::register('midtermService', 'MidtermService');
Flight::register('finalService', 'FinalService');

require 'routes/MidtermRoutes.php';
require 'routes/FinalRoutes.php';

/** TODO
* Add middleware to protect routes rest/final/share_classes AND rest/final/share_class_categories
*/
Flight::route('/*', function(){
    $path = Flight::request()->url;
    if($path == "/final/share_classes" || $path == "/final/share_class_categories" ){
        $headers = getallheaders();
    if(!isset($headers['Authorization'])){
        Flight::json(["message" => "Unauthorized access"], 403);
        return false;
    }else{
        $token = null;
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            $token = $matches[1];
        }
        try {
            $decoded = (array)JWT::decode($token, new Key("jwt",'HS256'));
            Flight::set('validUser', $decoded);
            return true;
        } catch (Exception $e) {
            Flight::json(["message" => "Token authorization invalid"], 403);
            return false;
        }
    }
    }
    return true;
   
});


Flight::start();
 ?>
