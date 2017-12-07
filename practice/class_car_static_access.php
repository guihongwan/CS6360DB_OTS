<?php
class Car{
    static $owner = "BB";
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
    function testStatic(){
        echo Car::$owner;
    }
}


$bmw = new Car("bmw");
$bmw->greeting();
echo "instance:".$bmw->owner;
echo "<br>Car owner:".Car::$owner;
echo "<br>";
$bmw->testStatic();
?>