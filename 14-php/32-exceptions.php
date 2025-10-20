<?php 
    $title = '32- Exceptions';
    $description = 'Is an object that describes an error or unexpected behaviour.';

    include 'template/header.php';
    echo "<section>";
?>
<form action="" method="POST">
    <div class="row">
        <input type="number" class="form-control" name="edad" placeholder="Ingresa tu edad">
    </div>
    <div class="row">
        <input type="submit" value="Validar" class="btn btn-success">
    </div>
</form>

<?php 
    if ($_POST) {
        function validar_edad($edad) {
            if ($edad < 18) {
                throw new Exception("No puedes votar!");
            }
            return true;
        }
        try {
            validar_edad($_POST['edad']);
            echo '<div class="msg">
                    Puedes votar!
                    </div>';
        } catch (Exception $e) {
            echo '<div class="error">
                    Error: '.$e->getMessage().'
                    </div>';
        }
    }
?>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>