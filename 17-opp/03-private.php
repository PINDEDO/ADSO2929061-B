<?php

echo "section";

class RenderTable
{
    private $nr; # Number of rows
    private $nc; # Number of Columns

    public function __construct($nr, $nc)
    {
        $this->nr = $nr;
        $this->nc = $nc;

        // Access to private methods
        $this->startTable();
        $this->bodyTable();
        $this->endTable();
    }
    private function starTable()
    {
        echo "<table>";

    }
    private function bodyTable()
    {
        echo "<h3> Table ({$this->nr}x{$this->nc})</h3>";
        for ($r = 1; $r <= $this->nr; $r++) {
            echo "<tr>";
            for ($c = 1; $c <= $this->nc; $c++) {
                echo "<td>  f{$r}c{$c} </td>";
            }
            echo "</tr>";
        }
    }
    private function endTable()
    {
        echo "</table>";

    }
}

?>