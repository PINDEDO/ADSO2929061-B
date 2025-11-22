<?php

echo "<section";

class Country {
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }
}

class FifaWorldCup {
    private $country;
    private $year;
    private $winner;

    public function __construct($country, $year, $winner = 'Brazil') {
        $this->country    = $country;
        $this->year       = $year;
        $this->winner     = $winner;

    }
    public function showEvent(){
        echo "<ul>
                 <li style='diasplay: flex; flex-direction: column>
                     <span><b>Country: </b> {$this->country->name}</span>
                     <span><b>Country: </b> {$this->year->country}</span>
                     <span><b>Country: </b> {$this->winner->country}</span>";
    }
}

$country  = new Country('Italy');
$Worldcup = new FifaWorldCup($country, 1990, 'Germany');
$Worldcup->showEvent();

$country  = new Country('Italy');
$Worldcup = new FifaWorldCup($country, 1994, );
$Worldcup->showEvent();

$country  = new Country('Italy');
$Worldcup = new FifaWorldCup($country, 1998, );
$Worldcup->showEvent();





