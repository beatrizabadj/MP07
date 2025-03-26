<?php
$host = "localhost";
$username="root";
$passwd = "";
$dbname="m7_crud";
$sqlFile = "m7_crud.sql";

try{
    // connexio dades amb pdo a la bd de mysql
    $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $passwd);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // creacio de base de dades
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $passwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // // creacio taula usuaris
    // $pdo->exec("CREATE TABLE IF NOT EXISTS usuaris (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     nom VARCHAR(50) NOT NULL,
    //     email VARCHAR(100) NOT NULL UNIQUE,
    //     edat INT NOT NULL
    // )");
    
    echo "Conexión exitosa y base de datos configurada.";


} catch (PDOException $e){
    
    die('Error de connexió ' . $e->getMessage());
}



