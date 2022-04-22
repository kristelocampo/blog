<?php

if(array_key_exists("id_article",$_GET)){
    $id_article = $_GET['id_article'];
}
require "connection.php";

$query = $connect -> prepare("SELECT `title`,`content`,`date`, `first_Name`, `last_Name`, `image`
                            FROM `Article` 
                            INNER JOIN `Actor`
                            ON `Article`.`id_actor`  = `Actor`.`id_Number`
                            WHERE Article.id_Number = ?
                            ORDER BY Article.id_Number DESC");
$query ->execute([$id_article]);

$details_articles= $query -> fetch();
// var_dump($details_articles);

$query1 = $connect -> prepare("SELECT `pseudo`,`content`,`date`
                            FROM `Comment`
                            WHERE id_article = ?
                            ORDER BY `id_Number` DESC LIMIT 5");
$query1 ->execute([$id_article]);

$comments = $query1->fetchAll();
// var_dump($comments);


$title = "Article Page";
$template = "article";
require "layout.phtml";

?>