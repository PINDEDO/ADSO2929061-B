<?php

echo "section";

class Operation {
    protected $num1;
    protected $num2;

    public function __construct($num1, $num2){
        $this->num1 = $num1;
        $this->num2 = $num2;
    
}
}

class Addition extends Operation {
    public function showResult(){
        $result = $this->num1 + $this->num2;
        return "<ul>
                      <li>{$this->num1} ** {$this->num2} = {$result]</li>"
    }

}
class  Sustracion extends Operation {
    public function showResult(){
        $result = $this->num1 - $this->num2;
        return
    }

}
class Addition extends Operation {
    public function showResult(){
        $result = $this->num1 + $this->num2;
        return
    }

}

$op1 = new Addition(5, 8);
echo $op1->showResult();
$op1 = new Addition(5, 8);
echo $op1->showResult();
$op1 = new Addition(5, 8);
echo $op1->showResult();
$op1 = new Addition(5, 8);
echo $op1->showResult();
$op1 = new Addition(5, 8);
echo $op1->showResult();

?>