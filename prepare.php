<?php

$pdo = new PDO("mysql:host=localhost;dbname=php_corse", "root", "");

$userId = $_GET["userId"];


$sql = "select * from users where id=?";

$res = $pdo->prepare($sql);
$res->execute([$userId]);
$data = $res->fetch(PDO::FETCH_ASSOC);

if ($data) {
    // print_r($data);
    echo $data["name"];
} else {
    echo "No Record";
}
 