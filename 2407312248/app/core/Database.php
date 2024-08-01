<?php

namespace app\core;

use PDO;

class Database extends PDO {
  private $DB_HOST = 'localhost';
  private $DB_PORT = 3306;
  private $DB_NAME = 'db_store';
  private $DB_USER = 'root';
  private $DB_PASSWORD = '';
  
  private $conn;

  public function __construct() {
    $this->conn = new PDO("mysql:host=".$this->DB_HOST.";dbname=".$this->DB_NAME.";port=".$this->DB_PORT, $this->DB_USER, $this->DB_PASSWORD);
    $this->conn->exec("set names utf8");
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }

  private function setParameters($stmt, $key, $value) {
    $stmt->bindParam($key, $value);
  }

  private function mountQuery($stmt, $parameters) {
    foreach( $parameters as $key => $value ) {
      $this->setParameters($stmt, $key, $value);
    }
  }

  public function executeQuery(string $query, array $parameters = []) {
    $stmt = $this->conn->prepare($query);
    $this->mountQuery($stmt, $parameters);
    $stmt->execute();
    return $stmt;
  }

}

