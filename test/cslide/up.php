
    

        <?php
        include 'database.inc.php';
        include 'login_status.inc.php';
        ?>
      
        <div id="content">

            <h2>Prześlij Pliki</h2>
	Zalogowany jako: <?php
            if ($zalogowany) {
                echo $ulogin;
            }else {
                echo "<a href='zaloguj.php'>NIE ZALOGOWANY</a>";
}
mysql_close($mysql_db_link)
?>
            <form id="form1" action="up.php" method="post" enctype="multipart/form-data">
                <p>Wybierz pliki do przesłania na serwer. Możesz wybrać wiele plików za jednym razem przytrzymując shift lub ctrl. Maksymalny rozmiar pliku to 1GB. Wysyłając pliki akceptujesz <a href="rules.php">regulamin serwisu</a>.</p>

               <div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Wysyłane Pliki</span>
			</div>
		<div id="divStatus">0 Plików Wysłanych</div>
			<div>
				<span id="spanButtonPlaceHolder"></span>
				<input id="btnCancel" type="button" value="Anuluj wysyłanie" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
			</div>
                <div id="response"></div>

            </form>
        </div>
        
