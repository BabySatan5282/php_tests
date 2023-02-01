<?php
require_once "include/header.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "delete from crud where id=?";
    $pdo->prepare($query)->execute([$id]);
    header("Location:index.php?delete=success");
}
