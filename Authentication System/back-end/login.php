<?php

require_once("../database/functions.php");
require_once("../database/dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    response("Only POST method accepted!");
}

if (!isset($_POST["id"])) {
    response("id is required!");
}
if (!isset($_POST["password"])) {
    response("Password is required!");
}

$id = $_POST["id"];
$password = $_POST["password"];

$password=md5($password);
$pdo = getPDO();

$query = "SELECT * FROM ausers WHERE (id = :id ) AND password = :password";
$stmt = $pdo->prepare($query);
$stmt->bindParam("id", $id, PDO::PARAM_STR);
$stmt->bindParam("password", $password, PDO::PARAM_STR);
$stmt->execute();
echo $password;
echo $id;

if ($stmt->rowCount()  == 0) {
    response("ID or Password is incorrect!");
}

$token = uniqid();

$query = "UPDATE ausers SET token = :token WHERE id = :id  AND password = :password";
$stmt = $pdo->prepare($query);
$stmt->bindParam("token", $token, PDO::PARAM_STR);
$stmt->bindParam("id", $id, PDO::PARAM_STR);
$stmt->bindParam("password", $password, PDO::PARAM_STR);
$stmt->execute();


$user = $stmt->fetch(PDO::FETCH_ASSOC);
response("Successfully Logged In", true, ["token" => $token]);