<?php

echo "<section>";

class Evolve {
    public function evolvePokemon($origin, $evolution) {
        echo "<ul><li> {$origin}👉{$evolution}</li></ul>";
    }
}


class Pokemon {
    private $origin;
    private $evolution;
    private $collaboration;

    public function __construct($origin, $evolution) {
        $this->origin    = $origin;
        $this->evolution = $evolution;

        //Collaborations
        $this->collaboration  = new Evolve;

    }

    public function nexteLvel() {
        $this->collaboration->evolvePokemon($this->origin, $this->evolution);
    }
}

$ev = new Pokemon('Pichu', 'pikachu');
$ev->nextLevel();
$ev = new Pokemon('Feid', 'Ferxxo');
$ev->nexteLvel();

?>