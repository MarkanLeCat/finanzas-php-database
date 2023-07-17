<?php

namespace Database\MySQLi;

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

  private function test_connection($connection) {
    // Comprobar conexión de manera orientada a objetos
    if ($connection->connect_errno) {
      die("Falló la conexión: {$connection->connect_error}");
    }
  }

  private function set_names($connection) {
    // Esto nos ayuda a poder usar cualquier caracter en nuestras consultas
    $setnames = $connection->prepare("SET NAMES 'utf8'");
    $setnames->execute();
  }

  private function make_connection() {
    // Esta es la forma orientada a objetos
    $mysqli = new \mysqli($this->server, $this->username, $this->password, $this->database);

    // Posible refactorización al código
    // $this->test_connection($mysqli);
    // $this->set_names($mysqli);

    // Comprobar conexión de manera orientada a objetos
    if ($mysqli->connect_errno) {
      die("Falló la conexión: {$mysqli->connect_error}");
    }

    // Esto nos ayuda a poder usar cualquier caracter en nuestras consultas
    $setnames = $mysqli->prepare("SET NAMES 'utf8'");
    $setnames->execute();

    $this->connection = $mysqli;
  }

}