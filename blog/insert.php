<?php

session_start();
if(isset($_SESSION['Admins'])){

    require "connection.php";
    
    $query = $connect ->prepare("SELECT `last_Name`,`first_Name`,`id_Number`
                                FROM `Actor` 
                                ORDER BY id_Number DESC");
    
    $query -> execute();
    
    $actors = $query ->fetchAll();
    
    $query = $connect ->prepare("SELECT `category`, `id_Number`
                                FROM `Categories`
                                ORDER BY id_Number DESC");
    
    $query -> execute();
    
    $categories = $query ->fetchAll();
    
    
    

    // echo "enter insert.php";
    if(isset($_POST["titre"]) && isset($_POST["titre"]) && 
        !empty($_POST["article"]) && !empty($_POST["article"]) &&
        isset($_POST["actor"]) && isset($_POST["actor"]) && 
        !empty($_POST["category"]) && !empty($_POST["category"]))
    {
        // echo "enter if";
        $titre = htmlspecialchars($_POST["titre"]);
        $article = htmlspecialchars($_POST["article"]);
        $date  =  date("Y-m-d h:i:s" );
        $id_actor = $_POST["actor"];
        $id_category = $_POST["category"];
        // var_dump($_POST["category"]);
        $images = $_FILES["images"]["name"];
       $uploads_dir = 'uploads';
        if (!empty($_FILES['images']['name'])) { 
  
            $tmp_name = $_FILES["images"]["tmp_name"];
            $name = $_FILES["images"]["name"];
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
        }
        else{
            $images = "default.png";
            $uploads = 'uploads/'.$images;
        }
       
        $sql = ("INSERT INTO `Article`(`title`,`content`,`date`,`id_actor`, `id_category`, `image`)
                    VALUES ('$titre','$article','$date', '$id_actor', '$id_category', '$images');");
        
       if ($connect -> query($sql)) {
            echo "New record created successfully";
            header("Location:admin.php");
            exit();
        } 
        else{
            echo "ERROR";
        }
    }
    
    
    $title = "Insert Page";
    $template = "insert";
    require "layout.phtml";
    }
else
{
    header("location:login.php");
    exit();
}
?>