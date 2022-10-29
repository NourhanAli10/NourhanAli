<?php

namespace App\database;


class Connect
{
  private $dbhostName = "localhost";
  private $dbhostUserName = "root";
  private $dbhostPassword = "";
  private $dbName = "ecommerce";
  public \mysqli $conn;
  public function __construct()
  {
    $this->conn = new \mysqli($this->dbhostName, $this->dbhostUserName, $this->dbhostPassword, $this->dbName);
    // Check connection
    //  if ($this->conn->connect_error) {
    //      die("Connection failed: " . $this->conn->connect_error);
    //  }
    // echo "Connected successfully";
  }

  public function __destruct()
  {
    $this->conn->close();
  }
}
