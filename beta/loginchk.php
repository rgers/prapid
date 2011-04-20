<?php
 include 'database.inc.php';
 $pword=md5($_POST["password"]);
 $query = "SELECT * FROM users WHERE login='".$_POST["login"]."'AND password='".$pword."'";
 $result = mysql_query($query);
 $nr = mysql_numrows($result);
 if($nr>0)
 {
    echo "OK";
 }else{
     echo "Spróbuj jeszcze raz.";
 }
?>
