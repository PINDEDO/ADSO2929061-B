<?php

$title = '13- Arrays Associative';
$description = 'Array using string keys to access corresponding value';


include 'template/header.php';
echo "<section>";


$personajes = [
    'Tanjiro Kamado' => 16,
    'Nezuko Kamado' => 15,
    'Zenitsu Agatsuma' => 17,
    'Inosuke Hashibira' => 18
];

$personajes['Genya Shinazugawa'] = 20;
$personajes['Kanao Tsuyuri'] = 19;

foreach ($personajes as $nombre => $edad) {
    echo $nombre . ": " . $edad . "<br>";
}

echo "</section>";


include 'template/footer.php';
?>