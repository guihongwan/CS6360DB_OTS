<?php
class Car{
    var $name;
    var $wheel = 4;
    var $hood = 1;
    var $engine = 1;
    var $door = 4;
    function Car($n){
        $this->name = n;
    }    
    function greeting(){
        echo "Hi, how are you? this is ".$name."<br>";
    }
    function moveWheels(){
        echo "Wheels move <br>";
    }
}
//if(class_exists("Car")){
//    echo "Yeahhh,Nice.";
//} else {
//    echo "Where is my car?";
//}
//if(method_exists("Car","moveWheels")){
//    echo "moveWheel() exists.";
//}

$bmw = new Car("bmw");
$bmw->greeting();
$bmw->moveWheels();
?>