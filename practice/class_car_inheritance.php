<?php
class Car{
    var $name = "car";
    var $wheels = 4;
    var $hood = 1;
    var $engine = 1;
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
    var $wheels = 20;
    
}

$bmw = new Car("bmw");
$bmw->greeting();
$jet = new Plane("jet");
echo $jet->wheels;
?>