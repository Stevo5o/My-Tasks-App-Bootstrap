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
            PDO::ATTR_PERSISTENT  => true,
            PDO::ATTR_ERRMODE     => PDO::ERRMODE_EXCEPTION
            );
          // create a PDO instance
          try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
          } catch(PDOException $e) {

          }
        }
} 
