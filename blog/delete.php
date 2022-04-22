<?php
session_start(); 
if(isset($_SESSION['Admins'])) {
    
    require "connection.php";
    
    if(isset($_GET["deleteId"]))
    {
        $id = $_GET["deleteId"];
        
        $query = $connect -> prepare("SELECT `id_Number`, `image`
                            FROM `Article` 
                            WHERE id_Number = ? ");
        $query -> execute([$id]);
        $article = $query -> fetch();
        if ($article["image"] !== "default.png")
        {
            $images = $article["image"];
            $uploads_dir = 'uploads/'.$images;
            unlink($uploads_dir);
        }
        
        $sql= "DELETE 
                FROM `Article`
                WHERE `Article`.`id_Number` = $id";
        $sql2 = "DELETE 
                FROM `Comment`
                WHERE `id_article` = $id";
                
        if ($connect -> query($sql) && $connect -> query($sql2))
        {
            header("Location:admin.php");
            exit();
        }
        else{
            die(mysqli_error($connect));
        }
    }

}
else
{
    echo "not connected";
    // header("location:login.php");
    // exit();
}
?>