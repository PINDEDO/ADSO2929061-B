<?php

$title = '15- Loop while';
$description = 'A loop that repeats code while condition is true';


include 'template/header.php';
echo "<section style='display: flex; gap: 0.2rem'>";


$contador = 1;


while ($contador <= 10) {
    echo "<p style='padding: 0.4rem 0.6rem; border: 2px solid #0006'>
                $contador
              </p>";
    $contador++;
}


echo "</section>";


include 'template/footer.php';
?>