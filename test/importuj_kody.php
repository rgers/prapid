<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
if(!isset($_FILES['Filedata']))
    {
?>
<form enctype="multipart/form-data" action="importuj_kody.php" method="POST">
Koszt: <input type="text" name="koszt" value="" /><br />
Choose a file to upload: <input name="Filedata" type="file" /><br />
<input type="submit" value="Upload File" />
</form>
<?php
    }else{
$plik_tmp = $_FILES['Filedata']['tmp_name'];
$plik_nazwa = $_FILES['Filedata']['name'];
$plik_rozmiar = $_FILES['Filedata']['size'];
if(is_uploaded_file($plik_tmp)) {
$handle = @fopen($plik_tmp, "r");
if ($handle) {
    while (!feof($handle)) {
        $buffer = fgets($handle, 4096);
        echo $buffer.$_POST['koszt'];
        switch ($_POST['koszt'])
        {
    case 1:
        $query = "INSERT INTO kody1 VALUES ('".rtrim($buffer)."','0')";
        break;
    case 2:
        $query = "INSERT INTO kody2 VALUES ('".rtrim($buffer)."','0')";
        break;
    case 3:
        $query = "INSERT INTO kody3 VALUES ('".rtrim($buffer)."','0')";
        break;
    case 9:
        $query = "INSERT INTO kody9 VALUES ('".rtrim($buffer)."','0')";
        break;
        }
        mysql_query($query);
    }
    fclose($handle);
}
unlink($plik_tmp);
    }
    }
    ?>
