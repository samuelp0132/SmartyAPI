<?php

require "../../../vendor/autoload.php";
require_once "../../../core/Database.php";
require_once "../../../core/Config.php";
require_once "../../../core/Validation.php";
require_once "../User.php";

/* adding the necessary files
use Smarty\core\Config;
use Smarty\core\Database;
use Smarty\User\User;
*/
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// Connecting to the database
$db = new Database(new Config('users'));
$dbconnect = $db->connect();


// Passing connection to the user model
$user = new User($dbconnect);

// getting raw data
$data = json_decode(file_get_contents("php://input"));

if(!isset($data->id)) {
    echo json_encode(array('message' => 'Parameter id is required.'));
    exit;
   }

    $user->_id = $data->id;
    $userData = $user->read_by_id();

    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if($userData->rowCount() > 0) {

        // FETCH POST FROM DATBASE
        $row = $userData->fetch(PDO::FETCH_ASSOC);


        // passing data to the user model
        $user->_id = isset($data->id) ?  $data->id : $row['id'];
        $user->_nombre= isset($data->nombre) ? $data->nombre  : $row['nombre'];
        $user->_apellido = isset($data->apellido) ? $data->apellido : $row['apellido'];
        $user->_email = isset($data->email) ? $data->email : $row['email'];
        $user->_telefono = isset($data->telefono) ? $data->telefono : $row['telefono'];

    }
    // if the user was deleted
    if($user->update()){
        echo json_encode(array('message' => 'Post Update.'));

    }

    else{
        echo json_encode(array('message' => 'Post Not Update.'));
    }









