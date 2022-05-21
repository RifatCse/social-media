<?php
class DbConnection{

    private $host = '127.0.0.1';
    private $username = 'root';
    private $password = 'password';
    private $database = 'social_media';

    protected $connection;

    public function __construct(){

        if(!isset($_SESSION)) {
            session_start();
        }

        if (!isset($this->connection)) {

            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }
            else {
                // echo '-----Connected to DB-----';
            }
        }

        return $this->connection;
    }
}
?>
