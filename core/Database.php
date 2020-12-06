<?php
class Database
{

    /**
     * database username
     * @var [string]
     */
    private $username;

    /**
     * database password
     * @var [int]
     */
    private $password;

    /**
     * database password
     * @var [int]
     */
    private $dsn;

    /**
     * @var |null
     */
    private $conn;

    /**
     * database name
     * @var [int]
     */
    private $database;


    /**
     * Database constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->username = $config::databaseCredentials['username'];;
        $this->password = $config::databaseCredentials['password'];
        $this->dsn = "mysql:host=". $config::databaseCredentials['host'] .';database='. $config::databaseCredentials['database'];
    }


    /**
     *  property options
     *  turn on errors
     *  @var [string]
     */

    private $_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => FALSE,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    ];


    /**
     * database connection
     * @access    public
     * @return    PDO
     * @throws Exception
     */
    public function connect(){
        $this->conn = null;

        try {
            $this->conn = new PDO($this->dsn, $this->username , $this->password , $this->_options);
        }catch (PDOException $exception){
             throw new Exception("Failed to connect database" . $exception);
        }

        return $this->conn;
    }


}