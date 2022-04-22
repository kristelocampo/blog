<?php
session_start();

if(isset($_SESSION['Admins'])){
    $_SESSION['Admins']=[];
    session_unset();
    session_destroy();
    header("location:index.php");
} 
// redirection

?>