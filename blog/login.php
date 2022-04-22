<?php

session_start();
require "connection.php";

if(!isset($_SESSION['Admins'])) {
if(isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) 
    && isset($_POST["password"]) && !empty($_POST["password"])){
    
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    // var_dump($pseudo);
    $password = htmlspecialchars($_POST["password"]);
    // var_dump($password);
    
    // récupérer les infos via la BDD 
    $query = $connect -> prepare(" SELECT `Admins`.`pseudo`,`password`
                                    FROM `Admins`
                                    WHERE `pseudo` = ?");
    $query -> execute([$pseudo]);
    $admin = $query -> fetch();
    // var_dump($admin); 
    
    if($admin){
        if(password_verify($password , $admin["password"])){
           $_SESSION['Admins']= $admin["pseudo"];
            header("location:admin.php");

        } else {
            echo '<script>alert("Incorrect Password")</script>';
        }
    } else {
        echo '<script>alert("Incorrect Email")</script>';
    }
    
    
}

if(isset($_POST["create"]))
{
     header("location:createAdmin.php");
}


$title = "Login";
$template = "login";
require "layout.phtml";
} else {
     header("location:admin.php");
    exit();
}

?>