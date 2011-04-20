<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-type" content="text/html;
              charset=utf-8" />
        <title>Prześlij Pliki</title>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
     <style type="text/css">
            table table td {
                width: 250px;
                white-space: nowrap;
                padding-right: 5px;
            }
            table table tr:nth-child(2n+1) {
                background-color: #EEEEEE;
            }
            table table td:first-child {
                font-weight: bold;
            }

            table table td:nth-child(2) {
                text-align: right;
                font-family: monospaced;
            }

        </style>
      <script type="text/javascript" src="swfupload.js"></script>
<script type="text/javascript" src="swfupload.queue.js"></script>
<script type="text/javascript" src="swfupload.cookies.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "swfupload.swf",
				flash9_url : "swfupload_fp9.swf",
				upload_url: "upload2.php",
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_size_limit : "1024 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "images/TestImageNoText_65x29.png",
				button_width: "110",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Wybierz pliki</span>',
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,

				// The event handler functions are defined in handlers.js
				swfupload_preload_handler : preLoad,
				swfupload_load_failed_handler : loadFailed,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
	</script>
</head>

    <body>
        <?php
        include 'database.inc.php';
        include 'login_status.inc.php';
        include 'menu.php';?>
        <center>
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
				<input id="btnCancel" type="button" value="Anuluj wysyłanie" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
			</div>
                <div id="response"></div>

            </form>
        </div>
        </center>
        <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-329354-6");
pageTracker._trackPageview();
} catch(err) {}</script>
    </body>
</html>
