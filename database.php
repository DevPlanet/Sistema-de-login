<?php
$server = 'localhost';
$username ='root';
$password = 'SuaPassword';
$database = 'auth';

try{
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
}catch(PDOException $e){
    die("A conexão falhou : " . $e->getMessage());
}
?>

