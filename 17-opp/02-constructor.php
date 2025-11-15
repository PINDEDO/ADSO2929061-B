<?php
$title     = "01-class";
$description = "";

echo "<section>";

class PlayList {
    # Attributes
    public $artist;
    public $album;
    public $year;
    public $song;
    
    # Construct
    public function __construct($artist, $album, $year, $song) {
        $this->artist = $artist;
        $this->album = $album;
        $this->year = $year;
        $this->song = $song;
    }

    $pl = new PlayList('kris R', 'U.V.E.S', 2025, 'COSITAS FT. BLESSD');
    echo $pl->song;

}