    <script>

        const preview = document.querySelector('#preview')

        const upload  = document.querySelector('.upload')

        const photo   = document.querySelector('#photo')

 

        upload.addEventListener('click', function() {

            photo.click()

        })

 

        photo.addEventListener('change', function() {

            preview.src = window.URL.createObjectURL(this.files[0])

        })

    </script>

 
<?php

    // Connection Data Base

    try {

        $conx = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    } catch (PDOException $e) {

        echo "Error: " . $e->getMessage();

    }

 

    // Login

    function login($email, $password, $conx) {

        try {

           $sql = "SELECT *

                   FROM users

                   WHERE email = :email

                   AND password = :password

                   LIMIT 1";

            $stmt = $conx->prepare($sql);

            $stmt->bindparam(":email", $email);

            $stmt->bindparam(":password", $password);

            $stmt->execute();

 

            if($stmt->rowCount() > 0) {

                $usr = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION['uid'] = $usr['id'];

                return true;

            } else {

                 $_SESSION['error'] = "El Usuario no esta registrado!";

                return false;

            }

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }

    }

 

    // List Pets

    function listPets($conx) {

        try {

            $sql = "SELECT p.id AS id,

                           p.name AS name,

                           p.photo AS photo,

                           s.name AS specie,

                           b.name AS breed

                    FROM pets AS p,

                         species AS s,

                         breeds AS b

                    WHERE s.id = p.specie_id

                    AND b.id = p.breed_id";

            $stmt = $conx->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }

    }

 

    // List Species

    function listSpecies($conx) {

        try {

            $sql = "SELECT *

                    FROM species";

            $stmt = $conx->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }

    }

 

    // Add Pet

    function addPet($name, $specie_id, $breed_id, $sex_id, $photo, $conx) {

        try {

            $sql = "INSERT INTO pets

                    (name, specie_id, breed_id, sex_id, photo)

                    VALUES

                    (:name, :specie_id, :breed_id, :sex_id, :photo)";

            $stmt = $conx->prepare($sql);

            $stmt->bindparam(":name", $name);

            $stmt->bindparam(":specie_id", $specie_id);

            $stmt->bindparam(":breed_id", $breed_id);

            $stmt->bindparam(":sex_id", $sex_id);

            $stmt->bindparam(":photo", $photo);

            if($stmt->execute()) {

                return true;

            } else {

                return false;

            }

 

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }

    }

 

    // List Breeds

    function listBreeds($conx) {

        try {

            $sql = "SELECT *

                    FROM breeds";

            $stmt = $conx->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }

    }

 

    // List Breeds

    function listSexes($conx) {

        try {

            $sql = "SELECT *

                    FROM sexes";

            $stmt = $conx->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }

    }


    include '../config/app.php';

    include '../config/database.php';

    include '../config/security.php';

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tu mejor amigo en casa - Add</title>

    <link rel="stylesheet" href="<?=$css?>master.css">

</head>

<body>

    <main class="add">

        <header>

            <h2>Adicionar Mascota</h2>

            <a href="dashboard.php" class="back"></a>

            <a href="../close.php" class="close"></a>

        </header>

        <figure class="photo-preview">

            <img id="preview" src="<?=$imgs?>/photo-lg-0.svg" alt="">

        </figure>

        <form action="" method="post" enctype="multipart/form-data">

            <input type="text" name="name" placeholder="Nombre" autocomplete="off" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">

            <div class="select">

                <select name="specie_id">

                    <option value="">Seleccione Especie...</option>

                    <?php $species = listSpecies($conx) ?>

                    <?php foreach($species as $specie): ?>

                        <option value="<?=$specie['id']?>" <?php if(isset($_POST['specie_id']) && $_POST['specie_id'] == $specie['id']) echo "selected"; ?>><?=$specie['id']?>-<?=$specie['name']?></option>

                    <?php endforeach ?>

                </select>

            </div>

            <div class="select">

                <select name="breed_id">

                    <option value="">Seleccione Raza...</option>

                    <?php $breeds = listBreeds($conx) ?>

                    <?php foreach($breeds as $breed): ?>

                        <option value="<?=$breed['id']?>" <?php if(isset($_POST['breed_id']) && $_POST['breed_id'] == $breed['id']) echo "selected"; ?>><?=$breed['id']?>-<?=$breed['name']?></option>

                    <?php endforeach ?>

                </select>

            </div>

            <button type="button" class="upload">Subir Foto</button>

            <input type="file" name="photo" id="photo" accept="image/*" style="display: none;">

            <div class="select">

                <select name="sex_id">

                    <option value="">Seleccione Genero...</option>

                    <?php $sexes = listSexes($conx) ?>

                    <?php foreach($sexes as $sex): ?>

                        <option value="<?=$sex['id']?>" <?php if(isset($_POST['sex_id']) && $_POST['sex_id'] == $sex['id']) echo "selected"; ?>><?=$sex['id']?>-<?=$sex['name']?></option>

                    <?php endforeach ?>

                </select>

            </div>

            <button class="save">Guardar</button>

        </form>

        <?php

            if($_POST) {

                $errors = 0;

                foreach ($_POST as $key => $value) {

                    if(empty($value)) {

                        $errors++;

                    }

                }

                if(!file_exists($_FILES['photo']['tmp_name'])) {

                    $errors++;

                }

                //var_dump($_POST);

                //var_dump($_FILES);

 

                if($errors == 0) {

                    $name      = $_POST['name'];

                    $specie_id = $_POST['specie_id'];

                    $breed_id  = $_POST['breed_id'];

                    $sex_id    = $_POST['sex_id'];

                    $photo     = time().".".pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

                    move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/".$photo);

 

                    if(addPet($name, $specie_id, $breed_id, $sex_id, $photo, $conx)) {

                        $_SESSION['message'] = "La Mascota $name se adicionó con exito!";

                        echo "<script>window.location.replace('dashboard.php')</script>";

                    }

 

                } else {

                    $_SESSION['error'] = "Todos los campos son requeridos!";

                }

 

            }

 

            if(isset($_SESSION['error'])) {

                include 'errors.php';

                unset($_SESSION['error']);

            }

        ?>

    </main>

    <script>

        const preview = document.querySelector('#preview')

        const upload  = document.querySelector('.upload')

        const photo   = document.querySelector('#photo')

 

        upload.addEventListener('click', function() {

            photo.click()

        })

 

        photo.addEventListener('change', function() {

            preview.src = window.URL.createObjectURL(this.files[0])

        })

    </script>

</body>

</html>

 
<?php

    include '../config/app.php';

    include '../config/database.php';

    include '../config/security.php';

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tu mejor amigo en casa - Dashboard</title>

    <link rel="stylesheet" href="<?=$css?>master.css">

</head>

<body>

    <main class="dashboard">

        <header>

            <h2>Administrar Mascotas</h2>

            <a href="../close.php" class="close"></a>

        </header>

       <a href="add.php" class="add"></a>   

       <table>

            <?php $pets = listPets($conx); ?>

            <?php foreach($pets as $pet): ?>

           <tr>

               <td>

                    <figure class="photo">

                        <img src="../uploads/<?=$pet['photo']?>" alt="">

                    </figure>

                    <div class="info">

                        <h3><?=$pet['name']?></h3>

                        <h4>

                            <?=$pet['specie']?> -

                            <?=$pet['breed']?>

                        </h4>

                    </div>

                    <div class="controls">

                        <a href="show.php?id=<?=$pet['id']?>" class="show"></a>

                        <a href="edit.php?id=<?=$pet['id']?>" class="edit"></a>

                        <a href="javascript:deletePet(<?=$pet['id']?>, '<?=$pet['name']?>')" class="delete"></a>

                    </div>

               </td>

           </tr>

            <?php endforeach ?>

            <?php

                if(isset($_SESSION['message'])) {

                    include 'message.php';

                    unset($_SESSION['message']);

                }

            ?>

       </table>

    </main>

</body>

        <script>

            function deletePet(id, name) {

            

                if(confirm(`Esta usted seguro? Va eliminar a ${name}`)) {

                    window.location.replace('delete.php?id='+id)

                }

            }

        </script>

</html>

 