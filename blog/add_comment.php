<?php
require "connection.php";

if (isset($_POST["pseudo"]) && isset($_POST["content"]) && 
    !empty($_POST["pseudo"]) && !empty($_POST["content"]))
{
    // echo "enter";

    $id_article = htmlspecialchars($_POST["id_article"]);
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    //mysqli_real_escape_string
    $content = htmlspecialchars($_POST["content"]);
    $date = date("Y-m-d h:i:s" );
    
    $sql = "INSERT INTO `Comment`  ( `id_article`,`pseudo`, `content`, `date`)
            VALUES ('$id_article' ,'$pseudo', '$content', '$date')";
            
    // var_dump($sql);
    if ($connect -> query($sql)) {
        echo "New record created successfully";
        header("Location:article.php?id_article=".$id_article);
        exit();
    } 
    else{
        echo "ERROR";
    }

}
else{
     $id_article = htmlspecialchars($_POST["id_article"]);
     header("Location:article.php?id_article=".$id_article);
     exit();
}
?>