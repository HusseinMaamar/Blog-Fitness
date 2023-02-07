<?php
/*  $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
 $pass = array(); 
 $combLen = strlen($comb) - 1; 
 for ($i = 0; $i < 4; $i++) {
     $n = rand(0, $combLen);
     $pass[] = $comb[$n];
 }
 print(implode($pass));  */

 if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
 $url = "https"; 
else
 $url = "http"; 
 
// Ajoutez // à l'URL.
$url .= "://"; 
 
// Ajoutez l'hôte (nom de domaine, ip) à l'URL.
$url .= $_SERVER['HTTP_HOST']; 
 
// Ajouter l'emplacement de la ressource demandée à l'URL
$url .= $_SERVER['REQUEST_URI']; 
   
// Afficher l'URL
echo $url; 
?>