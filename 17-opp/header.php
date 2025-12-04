
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'OOP PHP'; ?> | ADSO2929061B</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600&family=Montserrat:wght@100;300;400;700;900&display=swap" rel="stylesheet">
</head>
<body class="oop">
    <nav class="controls">
        <a href="index.php" title="Back to Menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="#ffffff" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288 480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 73.4-73.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-128 128z"/>
            </svg>
        </a>
    </nav>

    <main>
        <header>
            <div class="breadcrumb">
                <span>OOP</span>
                <span class="separator">/</span>
                <span class="current"><?php echo isset($breadcrumb) ? $breadcrumb : 'Ejercicio'; ?></span>
            </div>
            <h1><?php echo isset($pageTitle) ? $pageTitle : 'Programación Orientada a Objetos'; ?></h1>
            <p class="subtitle"><?php echo isset($subtitle) ? $subtitle : 'Conceptos fundamentales de POO en PHP'; ?></p>
        </header>