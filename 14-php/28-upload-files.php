<?php 
    $title = '28- Upload Files';
    $description = 'Moves the files from /tmp to the given TO directory.';

    include 'template/header.php';
    echo "<section>";
?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <figure class="figure">
                <img src="images/logo-php.png" width="250" id="prevista">
            </figure>
        </div>
        <div class="row">
            <button class="btn-upload" type="button"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Seleccionar Foto 
            </button>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" style="display: none;">
        </div>
        <div class="row">
            <button class="btn btn-success" type="submit"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                Subir Foto 
            </button>
        </div>
    </form>

    <?php if ($_FILES): ?>
        <?php if ($_FILES['foto']['error'] > 0): ?>
            <div class="error">
                <strong>Error:</strong> Debes seleccionar una Foto.
            </div>
        <?php else: ?>
            <?php move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/'.$_FILES['foto']['name']) ?>
            <div class="msg">
                <strong>
                    La Foto ha sido subida exitosamente!
                </strong>
                <div>
                    <strong> Nombre:</strong> <?php echo $_FILES['foto']['name'] ?>
                </div>
                <div>
                    <strong> Tipo:</strong> <?php echo $_FILES['foto']['type'] ?>
                </div>
                <div>
                    <strong> Tamaño:</strong> <?php echo round($_FILES['foto']['size'] / 1024) ?> KB
                </div>
            </div>	
        <?php endif ?>
    <?php endif ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.btn-upload').click(function() {
                $('#foto').click();
            });
            $('#foto').change(function(event) {
                let lector = new FileReader()
                lector.onload = function(event) {
                    $('#prevista').attr('src', event.target.result);
                }
                lector.readAsDataURL(this.files[0]);
            })
        });
    </script>

<?php 
    echo "</section>";
    include 'template/footer.php' 
?>