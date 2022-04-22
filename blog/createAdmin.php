<?php

require "connection.php";


if(isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) 
    && isset($_POST["password"]) && !empty($_POST["password"])){
    
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $password = password_hash(htmlspecialchars($_POST["password"]),PASSWORD_DEFAULT);
    // var_dump($password);
    
   echo "enter";
   $sql = ("INSERT INTO `Admins`(`pseudo`,`password`)
                        VALUES ('$pseudo', '$password')");
    var_dump($sql);
    
     if ($connect -> query($sql)) {
        echo "New account created successfully";
        header("Location:login.php");
        exit();
    } 
    else{
        echo "ERROR";
    }
    
}




$title = "Create New Account";
$template = "create";
require "layout.phtml";
?>