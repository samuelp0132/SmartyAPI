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


// requiring the necessary files


// Connecting to the database
$db = new Database(new Config('users'));
$dbconnect = $db->connect();

// User instance
$user = new User($dbconnect);

// Getting user data
$statement = $user->read();

// Count records
$rowCounts = $statement->rowCount();

//if there a records
if($rowCounts > 0){

    // variables  to store users_list
    $user_array = array();
    $user_array["data"] = array();



    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $users_list = array(
            "id" => $id,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "email" => $email,
            "telefono" => $telefono,
            "fechacreacion" => $fechacreacion

        );


        array_push($user_array["data"], $users_list);
    }


    echo json_encode($user_array);

}

else{

    $message = array("message" => "0 Users Found.");
    echo json_encode($message);



}



?>