<!-- DB.php -->
<?php

class DB {

   private $username = username,
           $host = host,
           $dbname = dbname,
           $password = password,
           $dbh, // DB handler
           $error,
           $stmt;

   public function __construct() {
      // Set DSN
      $dsn = array(
          PDO::ATTR_PERSISTENT => true,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
      // create a PDO instance
      try {
         $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      } catch (PDOException $e) {
         
      }
   }

   public function query($query) {
    $this->stmt = $this->dbh->prepare($query);
   }

   // binds the prep statement
   public function bind($param, $value, $type = null) {
    if(is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;        
        default:
          $type = PDO::PARAM_STR;
          break;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
   }

   // execute the prep statement
   public function execute() {
    return $this->stmt->execute();
   } 

   // return result set
   public function resultset() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   // return a single record
   public function single(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
   }

   // returns the number of affected rows
   public function rowCount(){
    return $this->stmt->rowCount();
   }

   // returns last inserted id
   public function lastInsertedId(){
    return $this->dbh->lastInsertID();
   }

   // transaction methods 
   public function beginTransaction() {
    return $this->dbh->beginTransaction();
   }
}
