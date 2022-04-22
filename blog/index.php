<?php


require "connection.php";

$query = $connect ->prepare("SELECT Article.id_Number,`title`,`content`,`date`, `first_Name`, `last_Name`
                            FROM `Article` 
                            INNER JOIN `Actor`
                            ON `Article`.`id_actor` = `Actor`.`id_Number`
                            ORDER BY Article.id_Number DESC");

$query -> execute();

$articles = $query ->fetchAll();
// var_dump($articles);


$title = "Home Page";
$template = "index";
require "layout.phtml";
?>