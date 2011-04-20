<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Kontakt</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		 table td {
			width: 250px;
			white-space: nowrap;
			padding-right: 0px;
		}
		 table tr:nth-child(2n+1) {
			background-color: #EEEEEE;
		}
		 table td:first-child {
			font-weight: bold;
		}

table td:nth-child(2) {
			font-weight: bold;
}
		table td:nth-child(3) {
		 text-align: right;
			font-family: monospaced;
		}

	</style>
</head>
<body>
    
<?php
$fid=$_GET['plik'];
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
include 'menu.php';
echo '<div id="content">';
$name = $_POST['name'];
$organization = $_POST['organization'];
$reason = $_POST['reason'];
$email = $_POST['email'];
if ($name && $reason && $email)
  {
mail("kontakt@polskirapid.pl", "Formularz WWW", $name."\n".$organization."\n".$email."\n".$reason."\n".$filehttp);
echo "Wiadomość została przesłana.";

    }else{
        ?>

        <form method="POST" action="contact.php">
            <table>
                <tr>
                    <td>
                        *Imię i nazwisko:
                    </td>
                    <td>
                        <input type="text" name="name">
                    </td>
                </tr>
                 <tr>
                    <td>
                        Firma/Organizacja:
                    </td>
                    <td>
                        <input type="text" name="organization">
                    </td>
                </tr>
                <tr>
                    <td>
                        *Adres e-mail do kontaktu:
                    </td>
                    <td>
                        <input type="text" name="email">
                    </td>
                </tr>
                
                <tr>
                    <td>
                        *Wiadomość:
                    </td>
                    <td>
                        <input type="text" name="reason">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Wyślij wiadomość"></td>
                </tr>
            </table>
            Pola z gwiazdką (*) muszą być uzupełnione, aby zgłoszenie zostało przesłane. Jeśli masz problem z obsługą tego automatycznego formularza, wyślij e-mail na adres kontakt@polskirapid.pl.
        </form>
<?php
    }
?>

