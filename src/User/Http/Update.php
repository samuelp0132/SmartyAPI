<?php

require "../../../vendor/autoload.php";
require_once "../../../core/Database.php";
require_once "../../../core/Config.php";
require_once "../../../core/Validation.php";
require_once "../User.php";

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

    $user->id = $data->id;
    $userData = $user->read_by_id();


    if($userData->rowCount() > 0) {
        $row = $userData->fetch(PDO::FETCH_ASSOC);

        // passing data to the user model
        $user->id = isset($data->id) ?  $data->id : $row['id'];
        $user->usuario = isset($data->usuario) ? $data->usuario  : $row['usuario'];
        $user->contrasena = isset($data->contrasena) ? $data->contrasena  : $row['contrasena'];
        $user->nombre = isset($data->nombre) ? $data->nombre  : $row['nombre'];
        $user->apellido = isset($data->apellido) ? $data->apellido : $row['apellido'];
        $user->email = isset($data->email) ? $data->email : $row['email'];
        $user->telefono = isset($data->telefono) ? $data->telefono : $row['telefono'];

    }
    // if the user was updated
    if($user->update() == TRUE){
        echo json_encode(array('message' => 'User Update.'));

    }
    else{
        echo json_encode(array('message' => 'User Not Update.'));
    }









