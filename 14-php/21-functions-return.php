<?php 
    $title = '21- Functions Return';
    $description = 'A function that sends a value back to the code that called it.';

    include 'template/header.php';
    echo "<section>";

    function calcularDivision($numero1, $numero2 = 5) {
        return "$numero1 / $numero2 es igual a: " . ($numero1 / $numero2) . "<br>" ;
    }

    echo calcularDivision(4, 10);
    echo calcularDivision(6);
    echo calcularDivision(64, 4);

    echo "</section>";
    include 'template/footer.php'; 
?>