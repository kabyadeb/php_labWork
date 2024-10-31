<?php
   $db_server = "localhost";
   $db_user = "root";
   $db_password = "1234";
   $db_name = "php_lab";
   $db;
   try {
       // Create a new PDO instance
       $connect = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
   
       // Set the PDO error mode to exception
       $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $db = $connect;
   } catch (PDOException $e) {
       die("Connection failed: " . $e->getMessage());
   }
?>