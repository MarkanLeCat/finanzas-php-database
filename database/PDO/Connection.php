<?php

namespace Database\PDO;

class Connection {
  
  private static $instance;
  private $connection;
  private $server = "localhost";
  private $database = "finanzas_personales";
  private $username = "root";
  private $password = "";

  private function __construct() {
    $this->make_connection();
  }

  public static function getInstance() {
    if (!self::$instance instanceof self) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public function get_database_instance() {
    return $this->connection;
  }

  private function set_names($connection) {
    // Esto nos ayuda a poder usar cualquier caracter en nuestras consultas
    $setnames = $connection->prepare("SET NAMES 'utf8'");
    $setnames->execute();
  }

  private function make_connection() {
    $connection = new \PDO("mysql:host=$this->server;dbname=$this->database", $this->username, $this->password);

    // Posible refactorización del código
    // $this->set_names($connection);

    // Esto nos ayuda a poder usar cualquier caracter en nuestras consultas
    $setnames = $connection->prepare("SET NAMES 'utf8'");
    $setnames->execute();

    $this->connection = $connection;
  }

}
