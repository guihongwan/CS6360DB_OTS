<?php
class Car{
    
    function greeting(){
        
    }
    function moveWheels(){
        echo "Wheels move";
    }
}
//if(class_exists("Car")){
//    echo "Yeahhh,Nice.";
//} else {
//    echo "Where is my car?";
//}
if(method_exists("Car","moveWheels")){
    echo "moveWheel() exists.";
}
?>