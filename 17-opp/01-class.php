<?php 
$title     = "01-class";
$description = "";

echo "<section>";

class Vehicle {
    # Attributes
    public $brand;
    public $refer;
    public $color;
    public $modelo;

    # Methods

    public function setAttributes($brand, $refer, $color, $modelo) {
        $this->brand = $brand;
        $this->refer = $refer;
        $this->color = $color;
        $this->modelo = $modelo;

    }
    public function getAttributs() {
        return "<ul>
                    <li>Brand $this->brand  </li>
                    <li>Refer $this->refer  </li>
                    <li>Color $this->color  </li>
                    <li>Model $this->modelo </li>
                <ul> ";
        
    }


}

$Vehicle1 = new Vehicle();
$Vehicle1->setAttributes('Volkswagen', 'Golf', 'Black', 2020);
echo $Vehicle1->getAttributs();

$Vehicle2 = new Vehicle();
$Vehicle2->setAttributes('Nissan', 'SkyLand', 'Red', 1992);
$Vehicle2->brand = 'Mercedez';
echo $Vehicle1->getAttributs();

$Vehicle3 = new Vehicle();
$Vehicle3->
$Vehicle3->brand = 'Mazda';
echo $Vehicle1->getAttributs();