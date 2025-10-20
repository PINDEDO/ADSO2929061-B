<?php session_start(); ?>
<?php 
    $title = '30- Sessions';
    $description = 'Mechanism to store and retrieve data across multiple page requests from a single user.';

    include 'template/header.php';
    echo "<section>";
?>

<?php 
    if ($_POST) {
        unset($_SESSION['visitas']);
        session_destroy();
    }	
?>

<?php if (isset($_SESSION['visitas'])): ?>
    <?php $_SESSION['visitas']++; ?>
<?php else: ?>
    <?php $_SESSION['visitas'] = 1; ?>
<?php endif ?>
<p>
    <strong>
        Has visitado esta página: 
    </strong>
    <?php echo $_SESSION['visitas']; ?> 
    <?php echo ($_SESSION['visitas'] == 1) ? "vez" : "veces"; ?>
</p>
<form action="" method="POST">
    <input type="submit" value="Cerrar Sesión" class="btn btn-danger" name="eliminar">
</form>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>