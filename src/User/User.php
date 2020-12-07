<?php
    // including the necessary files
    require "../../../vendor/autoload.php";
    require "../../../core/Sanatize.php";

    use User\Contracts\ICrudUsers;
    use Smarty\Core\Sanatize;

    class User implements ICrudUsers{


    private $_dbtable = "smartyapi.users";

    // properties Users object

    /**
     * id number contact
     * @var [int]
     */
    public $id;

    /**
    * @var
    */
    public $usuario;

    /**
    * @var
    */
    public $contrasena;

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
            $this->_query = "INSERT INTO ". $this->_dbtable ." SET usuario = :usuario,contrasena = :contrasena,nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono";

            // preparing statement
            $statement = $this->_conn->prepare($this->_query);

            // sanitizing parameters

            $this->usuario = Sanatize::xss_cleaner($this->usuario);
            $this->contrasena = Sanatize::xss_cleaner($this->contrasena);
            $this->nombre = Sanatize::xss_cleaner($this->nombre);
            $this->apellido = Sanatize::xss_cleaner($this->apellido);
            $this->email = Sanatize::xss_cleaner($this->email);
            $this->telefono = Sanatize::xss_cleaner($this->telefono);

            // binding params

            $statement->bindParam(':usuario', $this->usuario);
            $statement->bindParam(':contrasena', $this->contrasena);
            $statement->bindParam(':nombre', $this->nombre);
            $statement->bindParam(':apellido' ,$this->apellido);
            $statement->bindParam(':email', $this->email);
            $statement->bindParam(':telefono', $this->telefono);

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
            $this->_query = "UPDATE " . $this->_dbtable . " SET usuario = :usuario, contrasena = :contrasena, nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono WHERE id=:id";

            //preparing statement
            $statement = $this->_conn->prepare($this->_query);

            // binding params
            $statement->bindParam(':id', $this->id, PDO::PARAM_STR);
            $statement->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
            $statement->bindParam(':contrasena', $this->contrasena, PDO::PARAM_STR);
            $statement->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $statement->bindParam(':apellido', $this->apellido, PDO::PARAM_STR);
            $statement->bindParam(':email', $this->email, PDO::PARAM_STR);
            $statement->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);

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
            $userid = $this->id;

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