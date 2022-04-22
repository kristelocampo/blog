<?php


session_start();
if(isset($_SESSION['Admins'])){

    require "connection.php";
    
    if(array_key_exists("updateId",$_GET)){
        $id_Number = $_GET['updateId'];
    }
    
    $query = $connect ->prepare("SELECT `title`,`content`, `Article`.`id_Number`,`id_actor`,`id_category`, `image`
                                FROM `Article`
                                WHERE `id_Number` = ?");
    
    $query -> execute([$id_Number]);
    
    $edited = $query ->fetch();
    // var_dump($edited);
    
    $query = $connect ->prepare("SELECT `last_Name`,`first_Name`,`id_Number`
                                FROM `Actor` ");
    
    $query -> execute();
    
    $actors = $query ->fetchAll();
    
    $query = $connect ->prepare("SELECT `category`, `id_Number`
                                FROM `Categories`");
    
    $query -> execute();
    
    $categories = $query ->fetchAll();
    
    
    if(isset($_POST["titre"]) && isset($_POST["article"]) && !empty($_POST))
    {
        // echo "enter if";
        $titre = htmlspecialchars($_POST["titre"]);
        $article = htmlspecialchars($_POST["article"]);
        $id_Number =  htmlspecialchars($_POST["id_Number"]);
        $id_actor = $_POST["actor"];
        $id_category = $_POST["category"];
        
        $images = $_FILES["images"]["name"];
        $uploads_dir = 'uploads';
        
        if (!empty($_FILES['images']['name'])) { 
          
            $query = $connect -> prepare("SELECT `id_Number`, `image`
                        FROM `Article` 
                        WHERE id_Number = ? ");
            $query -> execute([$id_Number]);
            $edited_article = $query -> fetch();
          
            if ($edited_article["image"] !== "default.png")
            {
                // delete old image
                $images_tmp = $edited_article["image"];
                // var_dump($images_tmp);
                $uploads = 'uploads/'.$images_tmp;
                unlink($uploads);
        
                //replace new image
                $tmp_name = $_FILES["images"]["tmp_name"];
                $name = $_FILES["images"]["name"];
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
            }
            else{
                $tmp_name = $_FILES["images"]["tmp_name"];
                $name = $_FILES["images"]["name"];
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
            }
    
        }
        else if (empty($_FILES['images']['name'])){
            
             $query = $connect ->prepare("SELECT `title`,`content`, `Article`.`id_Number`,`id_actor`,`id_category`, `image`
                                FROM `Article`
                                WHERE `id_Number` = ?");
    
            $query -> execute([$id_Number]);
    
            $same = $query ->fetch();
            
            $images = $same["image"];
            $uploads = 'uploads/'.$images_tmp;
            // var_dump($images);
        }
        $sql = "UPDATE `Article`
                SET `title` = '$titre', `content`= '$article', `id_actor` = '$id_actor', `id_category` = '$id_category', `image` = '$images'
                WHERE  `id_Number` = $id_Number";
        
       if ($connect -> query($sql)) {
            echo "Edited created successfully";
            header("Location:admin.php");
            exit();
        } 
        else{
            echo "ERROR";
        }
     
    }
    
    $title = "Update Page";
    $template = "update";
    require "layout.phtml";
}
else
{
    header("location:login.php");
    exit();
}
?>