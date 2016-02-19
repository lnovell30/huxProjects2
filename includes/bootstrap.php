<?php
 require_once('./includes/functionsAndContent.php');
 $content = getBootStrap();
 echo $content;
 
function getBootStrap() {
    
$content = getPasswordForm();
    
return $content;

}
?>