<?php 
    $title = '33- Filters';
    $description = 'Are used to validate and sanitize external input.';

    include 'template/header.php';
    echo "<section>";
?>

<form action="" method="POST">
    <div class="row">
        <input type="number" class="form-control" name="edad" placeholder="Ingresa tu Edad">
    </div>
    <div class="row">
        <input type="email" class="form-control" name="correo" placeholder="Ingresa tu Correo">
    </div>
    <div class="row">
        <input type="url" class="form-control" name="direccion_web" placeholder="Ingresa tu URL">
    </div>
    <div class="row">
        <input type="submit" value="Aplicar Filtros" class="btn btn-success">
    </div>
</form>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // EDAD 
        $edad = $_REQUEST['edad'];
        $opciones = array('options' => 
                array('min_range' => 18, 
                        'max_range' => 23
                )
            );
        if (!filter_var($edad, FILTER_VALIDATE_INT, $opciones)) {
            echo '<div class="error">
                    No Puedes Participar en WSI!
                    </div>';
        } else {
            echo '<div class="msg">
                    Puedes Participar en WSI!
                    </div>';
        }
        // CORREO 
        if (!filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL)) {
            echo '<div class="error">
                    El Correo no es válido!
                    </div>';
        } else {
            echo '<div class="msg">
                    El Correo es válido!
                    </div>';
        }
        // URL 
        $direccion_web = filter_input(INPUT_POST, 'direccion_web', FILTER_SANITIZE_URL);
        echo '<div class="msg">
            La URL desinfectada es: '.$direccion_web.'
                </div>';
    }
?>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>