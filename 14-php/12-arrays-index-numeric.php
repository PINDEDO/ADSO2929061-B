<?php

$title = '12- Arrays Index Numeric';
$description = 'Stores multiples values accessed by index';


include 'template/header.php';
echo "<section>";


$frutas = ["🍎", "🍌", "🍊", "🥭"];

echo "Mi fruta favorita es: " . $frutas[0] . "<br>";
echo "La segunda fruta de la lista es: " . $frutas[1] . "<br>";


$frutas[2] = "🍇";
echo "La tercera fruta actualizada es: " . $frutas[2] . "<br>";


$frutas[] = "🍍";
echo "La fruta recién agregada es: " . $frutas[4] . "<br>";


echo "Todas las frutas en la lista: <br>";
for ($i = 0; $i < count($frutas); $i++) {
    echo $frutas[$i] . " ";
}


echo "</section>";


include 'template/footer.php';
?>