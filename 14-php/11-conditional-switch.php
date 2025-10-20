```php
<?php

$title = '11- Conditional switch';
$description = 'Select code block based on value';


include 'template/header.php';
echo "<section>";


$mesActual = date('m');

if ($mesActual == 1) {
    echo "<h4>Es Enero!</h4>";
} else if ($mesActual == 2) {
    echo "<h4>Es Febrero!</h4>";
} else if ($mesActual == 3) {
    echo "<h4>Es Marzo!</h4>";
} else if ($mesActual == 4) {
    echo "<h4>Es Abril!</h4>";
} else if ($mesActual == 5) {
    echo "<h4>Es Mayo!</h4>";
} else if ($mesActual == 6) {
    echo "<h4>Es Junio!</h4>";
} else if ($mesActual == 7) {
    echo "<h4>Es Julio!</h4>";
} else if ($mesActual == 8) {
    echo "<h4>Es Agosto!</h4>";
} else if ($mesActual == 9) {
    echo "<h4>Es Septiembre!</h4>";
} else if ($mesActual == 10) {
    echo "<h4>Es Octubre!</h4>";
} else if ($mesActual == 11) {
    echo "<h4>Es Noviembre!</h4>";
} else if ($mesActual == 12) {
    echo "<h4>Es Diciembre!</h4>";
} else {

    echo "<h4>Número de mes inválido.</h4>";
}


echo "</section>";


include 'template/footer.php';
?>
```