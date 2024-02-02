<?php

require_once("../database/functions.php");
require_once("../database/dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    response("Only POST method accepted!");
}

if (!isset($_POST["name"])) {
    response("name is required");
}
if (!isset($_POST["password"])) {
    response("Password is required!");
}
if(!isset($_POST["id"])){
    reponse("Id is required");
}



$name = $_POST["name"];
$password = $_POST["password"];
$id= $_POST["id"];

if(strlen($id)!=10){
    response("make sure your id should be correct ");
}

$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    response("your password must contain uppercase , lowercase , number and special char and size should be 8 and more ");
}


$password=md5($password);

$pdo = getPDO();

$query = "insert into ausers (name,id,password)values( :name, :id, :password  ) ";
$stmt = $pdo->prepare($query);
$stmt->bindParam("name", $name, PDO::PARAM_STR);
$stmt->bindParam("password", $password, PDO::PARAM_STR);
$stmt->bindParam("id", $id, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount()  != 0) {
    response(true,"Register Successfully");
}