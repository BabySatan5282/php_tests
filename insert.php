<form action="" method="POST">
    <p>
        <input type="text" name="name">
    </p>
    <p>
        <input type="text" name="age">
    </p>
    <p>
        <input type="submit" name="submit" value="Post">
    </p>
</form>

<?php

$pdo = new PDO("mysql:host=localhost;dbname=php_corse", "root", "");

if (isset($_POST["submit"])) {

    $name = $_POST['name'];
    $age = $_POST["age"];

    $sql = "insert into users (name,age) values (?,?)";

    $res = $pdo->prepare($sql);

    $res->execute([$name, $age]);


    echo "success";
}
