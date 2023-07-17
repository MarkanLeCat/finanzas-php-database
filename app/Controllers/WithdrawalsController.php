<?php

namespace App\Controllers;

use Database\PDO\Connection;

class WithdrawalsController {

  private $connection;

  public function __construct() {

    $this->connection = Connection::getInstance()->get_database_instance();

  }
  
  /**
   * Muestra una lista de este recurso
   */
  public function index() {
    
    $stmt = $this->connection->prepare("SELECT * FROM withdrawals");
    $stmt->execute();

    $amount = 0;
    $description = "";
    $stmt->bindColumn("amount", $amount);
    $stmt->bindColumn("description", $description);

    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    foreach($results as $result)
      echo "Gastaste " . $amount . " USD en: " . $description . "\n";

    // Esto es usando Fetch Column
    /* $stmt = $this->connection->prepare("SELECT amount, description FROM withdrawals");
    $stmt->execute();

    $results = $stmt->fetchAll(\PDO::FETCH_COLUMN, 0);

    foreach($results as $result)
      echo "Gastaste $result USD \n"; */
    
  }
  
  /** 
   * Muestra un formulario para crear un nuevo recurso
   */
  public function create() {
    
  }
  
  /**
   * Guarda un nuevo recurso en la base de datos
   */
  public function store($data) {

    $stmt = $this->connection->prepare("INSERT INTO withdrawals (payment_method, type, date, amount, description) VALUES (:payment_method, :type, :date, :amount, :description)");

    $stmt->bindValue(":payment_method", $data["payment_method"]);
    $stmt->bindValue(":type", $data["type"]);
    $stmt->bindValue(":date", $data["date"]);
    $stmt->bindValue(":amount", $data["amount"]);
    $stmt->bindValue(":description", $data["description"]);

    $stmt->execute();

  }
  
  /**
   * Muestra un único recurso especificado
   */ 
  public function show($id) {

    $stmt = $this->connection->prepare("SELECT * FROM withdrawals WHERE id=:id");
    $stmt->execute([
      ":id" => $id
    ]);

    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
  }
  
  /**
   * Muestra el formulario para editar un recurso
   */ 
  public function edit() {
    
  }
  
  /**
   * Actualiza un recurso específico en la base de datos
   */ 
  public function update($data, $id) {

    $stmt = $this->connection->prepare("UPDATE withdrawals SET 
      payment_method = :payment_method,
      type = :type,
      date = :date,
      amount = :amount,
      description = :description 
    WHERE id = :id");

    $stmt->bindValue(":id", $id);
    $stmt->bindValue(":payment_method", $data["payment_method"]);
    $stmt->bindValue(":type", $data["type"]);
    $stmt->bindValue(":date", $data["date"]);
    $stmt->bindValue(":amount", $data["amount"]);
    $stmt->bindValue(":description", $data["description"]);

    $stmt->execute();
    
  }
  
  /**
   * Elimina un recurso específico de la base de datos
   */ 
  public function destroy($id) {

    $stmt = $this->connection->prepare("DELETE FROM withdrawals WHERE id = :id");
    $stmt->execute([
      ":id" => $id
    ]);
    
  }

}

/* 

index - Display a listing of the resource.
create - Show the form for creating a new resource.
store - Store a newly created resource in storage.
show - Display the specified resource.
edit - Show the form for editing the specified resource.
update - Update the specified resource in storage.
destroy - Remove the specified resource from storage.

*/