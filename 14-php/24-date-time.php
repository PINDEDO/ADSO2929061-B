<?php 
$title = '24- Fecha y Hora';
$description = 'Múltiples formas de manejar fechas y horas.';

include 'template/header.php';
?>

<section>
    <ul class="msg">
        <li>
            <strong>Hora-Minutos-Segundos:</strong>
            <?php echo date('h:i:s'); ?>
        </li>
        <li>
            <strong>Día-Mes-Año:</strong>
            <?php echo date('d-m-Y'); ?>
        </li>
        <li>
            <strong>Nombre del Día:</strong>
            <?php echo date('l'); ?>
        </li>
        <li>
            <strong>Año Completo:</strong>
            <?php echo date('Y'); ?>
        </li>
        <li>
            <strong>Zona Horaria:</strong>
            <?php echo date('e'); ?>
        </li>
        <li>
            <strong>Tiempo UNIX:</strong>
            <?php echo time(); ?>
        </li>
    </ul>
</section>

<?php include 'template/footer.php'; ?>