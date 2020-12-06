<?php

// including the necessary files
require "../../../vendor/autoload.php";
require "../../../core/Sanatize.php";

use User\Contracts\ICrudUsers;
use Smarty\Core\Sanatize;




class User implements ICrudUsers{

    // db properties

    private $_dbtable = "smartycrud.users";

    // properties Contact object

    /**
     * id number contact
     * @var [int]
     */
    public $id;

    /**
     * contact name
     * @var [string]
     */

    public $nombre;

    /**
     * contact lastname
     * @var [string]
     */

    public $apellido;

    /**
     * contact email
     * @var [string]
     */

    public $email;

    /**
     * contact phonenumber
     * @var [string]
     */

    public $telefono;

    /**
     * holds query to execute
     * @var [string]
     */

    public $query;

    // construct Contact object


    /**
     * Constructor
     * @access	public
     * @param	Database connection result
     */

    public function __construct($db){
        $this->_conn = $db;
    }

    /**

     * Method to create a new contact
     * @access	public
     * @param	empty
     * @return	bool
     */

    public function create(){

        try {
            //mysql_real_escape_string($clean)
            $this->_query = "INSERT INTO ". $this->_dbtable ." SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono";

            // preparing statement
            $statement = $this->_conn->prepare($this->_query);

            // sanitizing parameters
            $this->_nombre = Sanatize::xss_cleaner($this->_nombre);
            $this->_apellido = Sanatize::xss_cleaner($this->_apellido);
            $this->_email = Sanatize::xss_cleaner($this->_email);
            $this->_telefono = Sanatize::xss_cleaner($this->_telefono);

            // binding params
            $statement->bindParam(':nombre', $this->_nombre);
            $statement->bindParam(':apellido' ,$this->_apellido);
            $statement->bindParam(':email', $this->_email);
            $statement->bindParam(':telefono', $this->_telefono);

            // executing statement
            if($statement->execute()){
                return true;
            }

            else{

                return false;
            }

        }

        catch (PDOException $ex) {
            echo "Error" . $ex->getMessage();
        }

    }

    /* Method to delete a contact
        * @access	public
         * @param	empty
         * @return	bool
     */

    public function delete(){
        try {
            // delete contact query
            $this->_query = "DELETE FROM " . $this->_dbtable . " WHERE id = :id";

            // preparing statement
            $statement = $this->_conn->prepare($this->_query);

            //binding params
            $statement->bindParam(':id', $this->_id, PDO::PARAM_INT);

            // executing statement
            $statement->execute();

            // count affected rows
            $deletedrow = $statement->rowCount();

            // check if a row has been affected
            if($deletedrow == 1 ) {
                return true;
            }
            return false;
            }

            catch(PDOException $ex){
                echo "Error" . $ex->getMessage();
            }
    }

    /* Method to update a contact
        * @access	public
         * @param	empty
         * @return	bool
     */


    public function update(){
        try {
            // update user query
            $this->_query = "UPDATE " . $this->_dbtable . " SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono";

            //preparing statement
            $statement = $this->_conn->prepare($this->_query);

            // binding params
            $statement->bindParam(':nombre', $this->_nombre, PDO::PARAM_INT);
            $statement->bindParam(':apellido', $this->_apellido, PDO::PARAM_INT);
            $statement->bindParam(':email', $this->_email, PDO::PARAM_INT);
            $statement->bindParam(':telefono', $this->_telefono, PDO::PARAM_INT);

            // executing statement
            $statement->execute();

            // count affected rows
            $updatedRow = $statement->rowCount();

            // check if a row has been affected
            if ($updatedRow == 1) {
                return true;
            }

            return false;
            }
            catch(PDOException $ex){
                echo "Error" . $ex->getMessage();
            }
        }



    /* Method to get all registed contacts
        * @access	public
         * @param	empty
         * @return	sql statment
     */


    public function read(){
        try {
            // query to get all users
            $this->_query = "SELECT * FROM " . $this->_dbtable;

            //preparing query
            $statement = $this->_conn->prepare($this->_query);

            // executing query
            $statement->execute();

            return $statement;
        }
        catch(PDOException $ex){
            echo "Error" . $ex->getMessage();
        }
    }

    /* Method to get one registed contact
        * @access	public
         * @param	empty
         * @return	sql statment
     */

    public function read_by_id(){
        try {
            $userid = $this->_id;

            // query to get specific users
            $this->_query = "SELECT * FROM " . $this->_dbtable . " WHERE id=:userid";


            // preparing query
            $statement = $this->_conn->prepare($this->_query);

            //binding params
            $statement->bindParam(":userid", $userid, PDO::PARAM_INT);

            // executing query
            $statement->execute();

            return $statement;
        }
        catch(PDOException $ex){
            echo "Error" . $ex->getMessage();
        }
    }


}

?>