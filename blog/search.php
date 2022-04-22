<?php

if(array_key_exists("name", $_GET)){
    $name = $_GET['name'];
}

require "connection.php";



$query = $connect ->prepare("SELECT `title`,`content`,  `id_Number`
                            FROM `Article`
                            WHERE `title` LIKE ?");
    
$query -> execute([$name."%"]);
    
$search = $query ->fetchAll();
// var_dump($search);

require "search.phtml";
?>