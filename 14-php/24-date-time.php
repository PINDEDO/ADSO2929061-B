<?php 
    $title = '24- Date & Time';
    $description = 'Many ways to handle dates and times.';

    include 'template/header.php';
    echo "<section>";
?>

<ul class="msg">
    <li>
        <strong>hora-minutos-segundos: </strong>
        <?php echo date('h:i:s') ?>
    </li>
    <li>
        <strong>dia-mes-año: </strong>
        <?php echo date('d-m-Y') ?>
    </li>
    <li>
        <strong>Nombre del Día: </strong>
        <?php echo date('l') ?>
    </li>
    <li>
        <strong>Año Completo: </strong>
        <?php echo date('Y') ?>
    </li>
    <li>
        <strong>Zona Horaria: </strong>
        <?php echo date('e') ?>
    </li>
    <li>
        <strong>Tiempo UNIX: </strong>
        <?php echo time() ?>
    </li>
</ul>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>