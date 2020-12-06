<?php

require_once "../../../core/Database.php";

require_once "../../../core/Config.php";


require_once "../../../core/Validation.php";

require_once "../User.php";

    // adding the necessary files

    // necessary headers

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset:UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    // Connecting to the database
    $db = new Database(new Config('users'));
    $dbconnect = $db->connect();

    // user instance
    $user = new User($dbconnect);

    //Receiving data
    $data = json_decode(file_get_contents('php://input'));

    //Passing data to the user model
    $user->_nombre = $data->nombre;
    $user->_apellido = $data->apellido;
    $user->_email = $data->email;
    $user->_telefono = $data->telefono;

    // validating parameters
    Validation::validateParameter("nombre",$user->_nombre,STRING,TRUE);
    Validation::validateParameter("apellido",$user->_apellido,STRING,TRUE);
    Validation::validateParameter("telefono",$user->_telefono,STRING,TRUE);
    Validation::validateParameter("email",$user->_email,STRING,TRUE);


    //if user has been created
    if($user->create()){
    echo json_encode(array('message' => 'User succesfully created!'));
    }else{
        echo json_encode(array('message' => 'User couldnt be created!'));
    }

