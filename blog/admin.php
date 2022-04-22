<?php
session_start();
if(isset($_SESSION['Admins'])){
    require "connection.php";
    
    $query = $connect ->prepare("SELECT `title`,`content`,`date`, `first_Name`, `last_Name`, `category`, `Article`.`id_Number`,`image`
                                FROM `Article`
                                INNER JOIN `Actor` ON `Article`.`id_actor` = `Actor`.`id_Number`
                                INNER JOIN `Categories` ON `Article`.`id_category` = `Categories`.`id_Number`
                                ORDER BY `Article`.`id_Number` DESC");
    
    $query -> execute();
    
    $all = $query ->fetchAll();
    // var_dump($all);
    
    $query= $connect -> prepare("SELECT `pseudo`
                                FROM `Admins`  ");
                                
    $query -> execute();
    
    $user = $query ->fetch();
    
    
    $title = "Administrator";
    $template = "admin";
    require "layout.phtml";

}
else
{
    header("location:login.php");
    exit();
}
?>