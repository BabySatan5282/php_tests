<?php

$pdo = new PDO("mysql:host=localhost;dbname=php_corse", "root", "");

$sql = "select * from users";

$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $n => $d) {
    echo "no. " . ++$n;
    echo "<br>";
    echo "*******";
    echo "<br>";
    foreach ($d as $k => $v) {
        echo $k . " is " . $v;
        echo "<br>";
    }
    echo "<br>";
    echo "##########################";
    echo "<br>";
    echo "<br>";
    
}
