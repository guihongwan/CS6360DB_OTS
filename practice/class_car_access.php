<?php
class Car{
    public $name = "car";
    private $wheels = 4;
    protected $hood = 1;
    private $engine = 1;
    var $door = 4;
    
    function __construct($name){
        $this->name = $name;
    }    
    function greeting(){
        echo "Hi, how are you? this is ".$this->name.".<br>";
    }
    function moveWheels(){
        echo "Wheels move <br>";
    }
}
class Plane extends Car {
    
    function showHood(){
        echo "<br> hood:".$this->hood;
        echo "<br> engine:".$this->engine;//this will not display
    }
}

$bmw = new Car("bmw");
$bmw->greeting();
echo $bmw->name;
//echo $bmw->wheels;

//echo $bmw->hood;
$jet = new Plane("jet");
echo "<br>";
echo $jet->showHood();
?>