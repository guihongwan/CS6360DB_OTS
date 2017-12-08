<?php
// get a posted variable
if(isset($_POST['var1'])){
    $var1=$_POST['var1'];
}

// if the posted variable isn't there...
if(!isset($var1))
   {
   // then draw up the dialog box
   echo "
   <table bgcolor='gray'>
      <tr>
         <td>
         Do you want to cancel?
         </td>
      </tr>
      <tr>
      <form method='post' action='test.php'>
      <input type='hidden' name='var1' value='Yes sirree, Bob!'>
         <td align='center'>
         <input type='submit' value='Yes'>
         </td>
      </form>
      <form method='post' action='test.php'>
      <input type='hidden' name='var1' value='No way, Jose!'>
         <td align='left'>
         <input type='submit' value='No'>
         </td>
      </form>
      </tr>
   </table> 
   ";
   }

// otherwise, echo the set variable
else
   {
   echo "The variable set is: $var1";
   }
?>