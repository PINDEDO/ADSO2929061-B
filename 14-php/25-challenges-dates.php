<?php  
$title = '25- Desafío de Fechas';
$description = 'Calculadora de edad usando fechas.';

include 'template/header.php';
?>

<section style="margin-top: 2rem;">
    <form method="POST">
        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
        <input type="submit" value="Calcular Edad">
    </form>

    <?php
    $esPostRequest = $_SERVER['REQUEST_METHOD'] === 'POST';
    $hayFechaNacimiento = !empty($_POST['fecha_nacimiento']);
    
    if ($esPostRequest && $hayFechaNacimiento) {
        $fechaNacimiento = new DateTime($_POST['fecha_nacimiento']);
        $fechaActual = new DateTime();
        $diferencia = $fechaActual->diff($fechaNacimiento);
        $edad = $diferencia->y;
        ?>
        <p>Tu edad es: <strong><?php echo $edad; ?> años</strong></p>
    <?php } ?>
</section>

<?php include 'template/footer.php'; ?>