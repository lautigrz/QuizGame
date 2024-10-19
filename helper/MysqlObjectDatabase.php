<?php
class MysqlObjectDatabase
{
    private $conn;
    public function __construct($host, $port, $username, $password, $database)
    {
        $this->conn = new mysqli($host, $username, $password, $database, $port);
    }
    /*class MysqlObjectDatabase {
    private $connection;

    public function __construct($host, $user, $password, $database) {
        $this->connection = new mysqli($host, $user, $password, $database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }


}*/

    public function query($sql){
        $result = $this->conn->query($sql);
        return $result;
    }


    public function execute($sql){
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
