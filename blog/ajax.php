<?php

require "connection.php";



$query = $connect ->prepare("SELECT `pseudo`,`content`
                            FROM `Comment`
                            ORDER BY id_Number DESC LIMIT 5");
    
$query -> execute();
    
$comments = $query ->fetchAll();
// var_dump($comments);
require "ajax.phtml"
?>