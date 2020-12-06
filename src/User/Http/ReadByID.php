<?php
// requiring the necessary files

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

// User instance
$user = new User($dbconnect);

// Receiving data
$data = json_decode(file_get_contents('php://input'));

// Passing data to the user model
$user->_id = isset($data->id);

// validating parameters
Validation::validateParameter("id",$user->_id, STRING,TRUE);

// Getting user data
$statement = $user->read_by_id();

// Count records
$num = $statement->rowCount();

//if there a user
if($num == 1){

    // variables  to store users_list
    $user_array = array();
    $user_array["data"] = array();

    //fetching array
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

        // extracting to the symbol table
        extract($row);

        // array to store fetch results
        $user = array(
            "id" => $id,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "email" => $email,
            "telefono" => $telefono,
            "fechacreacion" => $fechacreacion
        );


        // pushing data to user array
        array_push($user_array["data"], $user);
    }


    // echo the response
    echo json_encode($user_array);

}

else{

    // not found response

    $message = array("message" => "No User Found.");
    echo json_encode($message);



}



?>