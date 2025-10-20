<?php

$title = '14- Arrays Multidimensional';
$description = 'Array that contains other nested arrays.';

include 'template/header.php';
echo "<section>";

$bicicletas = [
    'Specialized' => ['Enduro', 'Stumjumper', 'Camber'],
    'Intense' => ['Carbine', 'Tracer', 'Spider'],
    'Santa Cruz' => ['Nomad', 'Megatower', 'Hightower']
];

foreach ($bicicletas as $marca => $modelos) {
    echo "<h3>$marca</h3>";
    echo "<ul>";

    foreach ($modelos as $modelo) {
        echo "<li>" . $modelo . "</li>";
    }

    echo "</ul>";
}


echo "</section>";


include 'template/footer.php';
?>