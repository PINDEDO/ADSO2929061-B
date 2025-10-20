<?php

$title = '16- Loop do while';
$description = 'Executes code once, then repeats if the condition remains true.';


include 'template/header.php';
echo "<section style='display: flex; gap: 0.2rem'>";

$numero = 1;


do {

    if ($numero % 2 == 0) {
        echo "<p style='padding: 0.4rem 0.6rem; border: 2px solid #0006'>
                    $numero
                  </p>";
    }

    $numero++;
} while ($numero <= 18);


echo "</section>";

include 'template/footer.php';
?>