<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
$fid=$_GET['plik'];
if (!$zalogowany)
{
header( 'Location: http://'.$domain.'/sciagajszybko.php?plik='.$fid ) ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Transfer Premium</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
	</head>
<body>
    <?php
include 'menu.php';
?>
<div style="width:90%; margin-left:auto; margin-right:auto">
    <div style="float:left; witdth:300px">
        <p style="text-align:center"><h1>Przelew elektroniczny</h1></p>
       
            <table>
                <tr>

                    <td>
                        <a href="kuptransfer_srv.php?typ=przelew&koszt=2.5&plik=<?php echo $fid;?>"><img src="images/transfer_5gb_przelew_btn.png"></a>
                    </td>
                </tr>
                <tr>

                    <td>
                        <a href="kuptransfer_srv.php?typ=przelew&koszt=5&plik=<?php echo $fid;?>"><img src="images/transfer_10gb_przelew_btn.png"></a>
                    </td>
                </tr>
                <tr>
                    
                    <td>
                        <a href="kuptransfer_srv.php?typ=przelew&koszt=9&plik=<?php echo $fid;?>"><img src="images/transfer_20gb_przelew_btn.png"></a>
                    </td>
                </tr>
                <tr>

                    <td>
                        <a href="kuptransfer_srv.php?typ=przelew&koszt=30&plik=<?php echo $fid;?>"><img src="images/transfer_200gb_przelew_btn.png"></a>
                    </td>
                </tr>
            </table>
        
    </div>
     <div style="float:right; witdth:300px">
        <p style="text-align:center"><h1>Płatność SMSem</h1></p>
        <table>
                <tr>
                    
                    <td>
                        <a href="kuptransfer_srv.php?typ=sms&koszt=1&plik=<?php echo $fid;?>"><img src="images/transfer_1gb_sms_btn.png"></a>
                    </td>
                </tr>
                 <tr>
                    
                    <td>
                         <a href="kuptransfer_srv.php?typ=sms&koszt=2&plik=<?php echo $fid;?>"><img src="images/transfer_2gb_sms_btn.png"></a>
                    </td>
                </tr>
                 <tr>
                     <td>
                         <a href="kuptransfer_srv.php?typ=sms&koszt=3&plik=<?php echo $fid;?>"><img src="images/transfer_3gb_sms_btn.png"></a>
                    </td>
                </tr>
             <tr>
                     <td>
                         <a href="kuptransfer_srv.php?typ=sms&koszt=9&plik=<?php echo $fid;?>"><img src="images/transfer_15gb_sms_btn.png"></a>
                    </td>
                </tr>
            </table>

     </div>
</div>
