<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
$kwota = $_POST['amount'];
$email = $_POST['email'];
$status = $_POST['t_status'];
$control = $_POST['control'];
if($status==2)
    {
    $query = "SELECT * FROM users WHERE login='".$email."'";
    $result = mysql_query($query);
    $bw = mysql_result($result,0,'bandwidth');
    switch ($kwota)
    {
        case "2.50":

    $query = "UPDATE users SET bandwidth='".($bw+5120)."' WHERE login='".$email."'";
    break;
     case "5.00":

    $query = "UPDATE users SET bandwidth='".($bw+10240)."' WHERE login='".$email."'";
    break;
     case "9.00":

    $query = "UPDATE users SET bandwidth='".($bw+20480)."' WHERE login='".$email."'";
    break;
     case "30.00":

    $query = "UPDATE users SET bandwidth='".($bw+204800)."' WHERE login='".$email."'";
    break;

    }
    mysql_query($query);
}
echo "OK";
?>
