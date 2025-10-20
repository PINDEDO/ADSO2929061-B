<?php 
    $title = '20- Functions with Params';
    $description = 'A function that accepts input values to perform its specific task.';

    include 'template/header.php';
    echo "<section>";

    function calcularProducto($numero1, $numero2 = 5) {
        echo "$numero1 * $numero2 es igual a: " . ($numero1 * $numero2) . "<br>" ;
    }

    calcularProducto(4, 10);
    calcularProducto(6);
    calcularProducto(64, 4);

    echo "</section>";
    include 'template/footer.php'; 
?>