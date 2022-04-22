<?php

define("HOST","db.3wa.io");
define("DATABASE","kristelocampo_blog");
define("USER","kristelocampo");
define("PASSWORD","4a4337d6006115a0f2eaea830ec0af43");

try{
    $connect = new PDO("mysql:host=".HOST.";dbname=".DATABASE,USER,PASSWORD);
    $connect -> exec("SET CHARACTER SET utf8");
    // var_dump($connect);

} catch(Exception $message){
    die("erreur de connexion ".$message->getMessage());
}

?>