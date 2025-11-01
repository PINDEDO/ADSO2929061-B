

<?php 
$title = '21- Funciones con Retorno';
$description = 'Una función que devuelve un valor al código que la llamó.';

include 'template/header.php';
?>

<section>
    <?php
    function calcularDivision($numero1, $numero2 = 5) {
        $resultado = $numero1 / $numero2;
        return "$numero1 ÷ $numero2 es igual a: $resultado<br>";
    }

    echo calcularDivision(4, 10);
    echo calcularDivision(6);
    echo calcularDivision(64, 4);
    ?>
</section>

<?php include 'template/footer.php'; ?>