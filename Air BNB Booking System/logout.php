<?php
// FOR LOGOUT
session_start();            
session_unset();            
session_destroy();          

header("Location: Main Page.php"); 
exit();
?>
