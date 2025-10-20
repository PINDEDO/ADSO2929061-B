<?php

$title = '18- Loop foreach';
$description = 'Loop that iterates over each element in an array.';

include 'template/header.php';
echo "<section>";

$signos = ['♈️ Aries', '♉️ Tauro', '♊️ Geminis', '♋️ Cancer', '♌️ Leo', '♍️ Virgo'];


foreach ($signos as $signo) {
    echo "<p>$signo</p>";
}

echo "</section>";

include 'template/footer.php';
?>