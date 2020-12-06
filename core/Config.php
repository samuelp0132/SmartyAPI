<?php

class Config
{

    /**
     * app enviroment
     * @var [string]
     */
    private $environment = 'development';

    /**
     * database credentials
     * @var [const array]
     */

    const databaseCredentials = [
        "username" => 'root',
        "password" => '',
        "host" => 'localhost',
        "database" => ''
    ];


    public function  __construct($database){

        $databaseCredentials['database'] = $database;

        switch ($this->environment){
            case 'development':
                error_reporting(E_ALL);
                break;

            case 'qa':
            case 'production':
                error_reporting(0);
                break;
            default :
               throw new Exception("This is not a valid enviroment!");
        }
}





}