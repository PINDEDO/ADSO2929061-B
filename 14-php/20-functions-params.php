<?php 
$title = '20- Funciones con Parámetros';
$description = 'Una función que acepta valores de entrada para realizar su tarea específica.';

include 'template/header.php';
?>

<section>
    <?php
    function calcularProducto($numero1, $numero2 = 5) {
        $resultado = $numero1 * $numero2;
        echo "$numero1 × $numero2 es igual a: $resultado<br>";
    }

    calcularProducto(4, 10);
    calcularProducto(6);
    calcularProducto(64, 4);
    ?>
</section>

<?php include 'template/footer.php'; ?>