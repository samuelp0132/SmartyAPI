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

// passing data to the user model
$user->_id = $data->id;

Validation::validateParameter("id",$user->_id,STRING,TRUE);

// if the user was deleted
if($user->delete()){
    echo json_encode(array('message' => 'Post deleted.'));

}

else{
    echo json_encode(array('message' => 'Post not deleted.'));
}





?>