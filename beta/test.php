<?php

$file = "test.mp3"; // file to be send to the client
$speed = 8.5; // 8,5 kb/s download rate limit

if(file_exists($file) && is_file($file)) {

   header("Cache-control: private");
   header("Content-Type: application/octet-stream"); 
   header("Content-Length: ".filesize($file));
   header("Content-Disposition: filename=$file" . "%20"); 

   flush();

   $fd = fopen($file, "r");
   while(!feof($fd)) {
         echo fread($fd, round($speed*1024));
       flush();
       sleep(1);
   }
   fclose ($fd);

}

?> 
