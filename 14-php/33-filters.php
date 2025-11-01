<?php 
$title = '33- Filtros';
$description = 'Se usan para validar y limpiar entrada externa.';

include 'template/header.php';
?>

<section>
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
    $esPostRequest = $_SERVER['REQUEST_METHOD'] === 'POST';
    
    if ($esPostRequest) {
        // Validar EDAD
        $edad = $_REQUEST['edad'];
        $edadMinima = 18;
        $edadMaxima = 23;
        
        $opcionesEdad = [
            'options' => [
                'min_range' => $edadMinima,
                'max_range' => $edadMaxima
            ]
        ];
        
        $edadValida = filter_var($edad, FILTER_VALIDATE_INT, $opcionesEdad);
        
        if (!$edadValida) { ?>
            <div class="error">
                ¡No puedes participar en WSI!
            </div>
        <?php } else { ?>
            <div class="msg">
                ¡Puedes participar en WSI!
            </div>
        <?php }
        
        // Validar CORREO
        $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
        
        if (!$correo) { ?>
            <div class="error">
                ¡El correo no es válido!
            </div>
        <?php } else { ?>
            <div class="msg">
                ¡El correo es válido!
            </div>
        <?php }
        
        // Limpiar URL
        $direccionWeb = filter_input(INPUT_POST, 'direccion_web', FILTER_SANITIZE_URL);
        ?>
        <div class="msg">
            La URL desinfectada es: <?php echo $direccionWeb; ?>
        </div>
    <?php } ?>
</section>

<?php include 'template/footer.php'; ?>