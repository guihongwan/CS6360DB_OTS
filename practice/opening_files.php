<?php 

$file = "test.txt";

//write a file

//$fd = fopen($file,'w');//if the file does not exist, will create one.
//if($fd){
//   fwrite($fd,"I love PHP.");
//   fclose($fd); 
//}else{
//   echo "Fail to open th file." ;
//}

//read a file

//$fd = fopen($file,'r');//if the file does not exist, will create one.
//if($fd){
//   //$content = fread($fd,10);//each bite equals a character
//   $size = filesize($file);
//   $content = fread($fd, $size);//each bite equals a character
//   echo $content;
//   fclose($fd); 
//}else{ 
//   echo "Fail to open th file." ;
//}

//delete a file

unlink($file);

?>