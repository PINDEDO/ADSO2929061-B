<?php 
    $title = '23- Forms Post';
    $description = 'Retrieve data from a POST request.';

    include 'template/header.php';
    echo "<section>";
?>
<form action="" method="POST">
    <div class="row">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" name="nombre" id="nombre">
    </div>
    <div class="row">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo">
    </div>
    <div class="row">
        <input type="submit" value="Enviar Formulario">
        <input type="reset" value="Limpiar Formulario">
    </div>
</form>

<?php if ($_POST): ?>
    <?php if (!empty($_POST['nombre']) && !empty($_POST['correo'])): ?>
        <div class="msg">
            <strong>Nombre Completo:</strong> <?php echo $_POST['nombre']; ?>
            <br>
            <strong>Correo:</strong> <?php echo $_POST['correo']; ?>
        </div>
        <?php else: ?>
        <div class="error">
            <small>Por favor complete los campos</small>
        </div>
    <?php endif ?>
<?php endif ?>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>