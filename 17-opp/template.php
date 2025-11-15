<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01 - Introduction to OOP | ADSO2929061B</title>
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
                <span class="current">01 - Introduction</span>
            </div>
            <h1>Introduction to OOP</h1>
            <p class="subtitle">Understanding Object-Oriented Programming fundamentals</p>
        </header>

        <!-- AQUÍ VA TU CONTENIDO PHP -->
        <section class="content">
            <h2>What is OOP?</h2>
            <p>
                Object-Oriented Programming (OOP) is a programming paradigm that uses "objects" to design applications and programs. 
                It utilizes several techniques from previously established paradigms, including modularity, polymorphism, and encapsulation.
            </p>

            <h3>Key Concepts</h3>
            <ul>
                <li><strong>Classes:</strong> Blueprints for creating objects</li>
                <li><strong>Objects:</strong> Instances of classes</li>
                <li><strong>Encapsulation:</strong> Bundling data and methods</li>
                <li><strong>Inheritance:</strong> Creating new classes from existing ones</li>
                <li><strong>Polymorphism:</strong> Objects taking multiple forms</li>
                <li><strong>Abstraction:</strong> Hiding complex implementation details</li>
            </ul>
        </section>

        <!-- SECCIÓN DE CÓDIGO PHP -->
        <section class="code-section">
            <h3>PHP Example</h3>
            <div class="code-header">
                <span class="language">PHP</span>
                <span class="filename">example.php</span>
            </div>
            <xmp><?php
// Definir una clase simple
class car {
    // Propiedades
    public $brand;
    public $model;
    public $year;
    
    // Constructor
    public function __construct($brand, $model, $year) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }
    
    // Método
    public function getInfo() {
        return "{$this->year} {$this->brand} {$this->model}";
    }
}

// Crear objetos
$car1 = new Car("Toyota", "Corolla", 2023);
$car2 = new Car("Honda", "Civic", 2024);

// Usar métodos
echo $car1->getInfo(); // Output: 2023 Toyota Corolla
echo $car2->getInfo(); // Output: 2024 Honda Civic
?></xmp>
        </section>

        <!-- SECCIÓN DE RESULTADO/OUTPUT -->
        <section class="output-section">
            <h3>Output</h3>
            <div class="output">
                <?php
                // AQUÍ VA TU CÓDIGO PHP EJECUTABLE
                class car {
                    public $brand;
                    public $model;
                    public $year;
                    
                    public function __construct($brand, $model, $year) {
                        $this->brand = $brand;
                        $this->model = $model;
                        $this->year = $year;
                    }
                    
                    public function getInfo() {
                        return "{$this->year} {$this->brand} {$this->model}";
                    }
                }

                $car1 = new Car("Toyota", "Corolla", 2023);
                $car2 = new Car("Honda", "Civic", 2024);

                echo "<p>🚗 Car 1: " . $car1->getInfo() . "</p>";
                echo "<p>🚗 Car 2: " . $car2->getInfo() . "</p>";
                ?>
            </div>
        </section>

        <!-- SECCIÓN DE NOTAS/TIPS -->
        <section class="tips-section">
            <h3>💡 Important Notes</h3>
            <div class="tip">
                <strong>Remember:</strong> In PHP, classes are defined using the <code>class</code> keyword, 
                and objects are created using the <code>new</code> keyword.
            </div>
            <div class="tip">
                <strong>Best Practice:</strong> Always use meaningful names for your classes and follow 
                the PascalCase naming convention (e.g., <code>UserProfile</code>, <code>DatabaseConnection</code>).
            </div>
        </section>

        <!-- NAVEGACIÓN ENTRE EJERCICIOS -->
        <nav class="exercise-nav">
            <a href="index.php" class="nav-btn back">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="16">
                    <path fill="currentColor" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
                </svg>
                Menu
            </a>
            <a href="02-classes-objects.php" class="nav-btn next">
                Next: Classes & Objects
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="16">
                    <path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                </svg>
            </a>
        </nav>
    </main>
</body>

</html>
