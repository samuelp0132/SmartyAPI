<?php
    // adding the necessary files
    require_once "../../../core/Database.php";
    require_once "../../../core/Config.php";
    require_once "../../../core/Validation.php";
    require_once "../User.php";

    // necessary headers

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset:UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    // Connecting to the database
    $db = new Database(new Config('users'));
    $dbconnect = $db->connect();


    $user = new User($dbconnect);

    //Receiving data
    $data = json_decode(file_get_contents('php://input'));

    //Passing data to the user model

    $user->usuario = $data->usuario;
    $user->contrasena = $data->contrasena;
    $user->nombre = $data->nombre;
    $user->apellido = $data->apellido;
    $user->email= $data->email;
    $user->telefono = $data->telefono;

    // validating parameters

    Validation::validateParameter("usuario",$user->usuario,STRING,TRUE);
    Validation::validateParameter("contrasena",$user->contrasena,STRING,TRUE);
    Validation::validateParameter("nombre",$user->nombre,STRING,TRUE);
    Validation::validateParameter("apellido",$user->apellido,STRING,TRUE);
    Validation::validateParameter("telefono",$user->telefono,STRING,TRUE);
    Validation::validateParameter("email",$user->email,STRING,TRUE);


    if($user->create()){
        echo json_encode(array('message' => 'User succesfully created!'));
    }else{
        echo json_encode(array('message' => 'User couldnt be created!'));
    }

