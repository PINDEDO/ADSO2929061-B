<?php

$title = '17- Loop for';
$description = 'Loop that repeats for a specific, predefined number of iterations.';


include 'template/header.php';
echo "<section style='display: flex; gap: 0.2rem'>";


for ($contador = 1; $contador <= 40; $contador++) {

    if ($contador % 5 == 0) {
        echo "<p style='padding: 0.4rem 0.6rem; border: 2px solid #0006'>
                    $contador
                  </p>";


        if ($contador == 25) continue;


        if ($contador == 30) break;
    }
}


echo "</section>";


include 'template/footer.php';
?>