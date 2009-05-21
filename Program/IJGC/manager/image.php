<?php
 session_start();
 $alphanum  .= strtolower("ABCDEFGHIJKMNPQRSTUVWXYZ");
 $alphanum  .= "23456789";
 
 $rand = substr(str_shuffle($alphanum), 0, 5);
 $bgNum = rand(1, 2);
 $image = imagecreatefromjpeg("$bgNum.jpg");
 $textColor = imagecolorallocate ($image, 0, 0, 0); 
 imagestring ($image, 8, 8, 8,  $rand, $textColor); 
 $_SESSION['kodever'] = $rand;
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
 header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
 header("Cache-Control: no-store, no-cache, must-revalidate"); 
 header("Cache-Control: post-check=0, pre-check=0", false); 
 header("Pragma: no-cache"); 	
 header('Content-type: image/jpeg');
 imagejpeg($image);
 imagedestroy($image); 
?>