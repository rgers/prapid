<?php

// CHANGE EVERYTHING BELOW

define(AWS_ACCESS_KEY_ID,'AKIAJIOABZNYPODUHRIA');
define(AWS_SECRET_ACCESS_KEY,'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');
$S3_BUCKET = 'cdn.gers.pl';
$SUCCESS_REDIRECT = "http://onet.pl";
$SWFRoot = "http://prapid.gers.pl/amazon_upload/";

$isMacUser = (preg_match("/macintosh/",strtolower($_SERVER['HTTP_USER_AGENT'])) ? true : false);

if ( !isset($S3_BUCKET) || $S3_BUCKET == 'AWS_BUCKET' ) {
  echo "Um, sorry, I need my configuration file. :( ";
  exit(0);
}

$MAX_FILE_SIZE = 500 * 1048576;
$expTime = time() + (1 * 60 * 60);
$expTimeStr = gmdate('Y-m-d\TH:i:s\Z', $expTime);
$policyDoc = '{
        "expiration": "' . $expTimeStr . '",
        "conditions": [
        {"bucket": "' . $S3_BUCKET . '"},
        ["starts-with", "$key", ""],
        {"acl": "public-read"},
        ["content-length-range", 0, '. $MAX_FILE_SIZE .'],
        {"success_action_status": "201"},
        ["starts-with", "$Filename", ""],
        ["starts-with", "$Content-Type", "image/"]
      ]
}';
$policyDoc = implode(explode('\r', $policyDoc));
$policyDoc = implode(explode('\n', $policyDoc));
$policyDoc64 = base64_encode($policyDoc);
$sigPolicyDoc = base64_encode(hash_hmac("sha1", $policyDoc64, AWS_SECRET_ACCESS_KEY, TRUE));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-type" content="text/html;
              charset=utf-8" />
        <title>Prześlij Pliki</title>
        <!-- <link href="css/default.css" rel="stylesheet" type="text/css" /> -->
        <link href="css/uploadify.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/jquery.fancybox-1.3.0.css" type="text/css" media="screen" />
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
  <!--  <?php //include 'jsfuncs.php'; ?> -->
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.3");
</script>
<script type="text/javascript" src="<?=$SWFRoot?>swfupload.js"></script>
<script type="text/javascript" src="<?=$SWFRoot?>js/fileprogress.js"></script>
<script type="text/javascript" src="<?=$SWFRoot?>/js/jquery.swfupload.js"></script>
<script type="text/javascript">
var trackFiles = [];
var trackFilesCount = 0;
var trackSentURL = false;
var forceDone = false;
var forceFile = null;
var master = null;
var MacMinSizeUpload = 150000; // 150k, this is not cool :(
var MacDelay = 10000; // 10 secs.
var isMacUser = <?php echo ($isMacUser ? 'true' : 'false'); ?>;
var successURL = '<?php echo ($SUCCESS_REDIRECT); ?>';

$(function(){
	$('#swfupload-control').swfupload({
		upload_url: "http://<?=$S3_BUCKET?>.s3.amazonaws.com/",
		post_params: {"AWSAccessKeyId":"<?=AWS_ACCESS_KEY_ID?>", "key":"${filename}", "acl":"public-read", "policy":"<?=$policyDoc64?>", "signature":"<?=$sigPolicyDoc?>","success_action_status":"201", "content-type":"image/"},
		http_success : [201],
		assume_success_timeout : <?php echo ($isMacUser ? 5 : 0); ?>,

		// File Upload Settings
		file_post_name: 'file',
		file_size_limit : "2020240",    // 20 MB
		file_types : "*.*",			// or you could use something like: "*.doc;*.wpd;*.pdf",
		file_types_description : "All Files",
		file_upload_limit : "0",
		file_queue_limit : "1",

		button_image_url : "XPButtonUploadText_61x22.png",
		button_placeholder_id : 'mybutton',
		button_placeholder : $('#mybutton'),
		button_width: 61,
		button_height: 22,

		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,
		moving_average_history_size: 10,

		// Flash Settings
		flash_url : "<?=$SWFRoot?>swfupload.swf",
		custom_settings : {
		  progressTarget : "fsUploadProgress",
		 /* cancelButtonId : "btnCancel"*/
		  upload_successful : false
		},
		// Debug Settings
		debug: false
	})
	.bind('fileDialogStart', function(event, file){
		var swfu = $.swfupload.getInstance('#swfupload-control');
		var txtFileName = document.getElementById("txtFileName");
		txtFileName.value = "";
		swfu.cancelUpload();
	})

	.bind('uploadError', function(event, file, errorCode, message){
		var swfu = $.swfupload.getInstance('#swfupload-control');
		try {

			if (errorCode === SWFUpload.UPLOAD_ERROR.FILE_CANCELLED) {
				// Don't show cancelled error boxes
				return;
			}
			var txtFileName = document.getElementById("txtFileName");
			txtFileName.value = "";
			validateForm();

			file.id = "singlefile";
			var progress = new FileProgress(file, swfu.customSettings.progressTarget);
			progress.setError();
			progress.toggleCancel(false);

			switch (errorCode) {
			case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
				progress.setStatus("Upload Error: " + message);
				swfu.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
				progress.setStatus("Upload Failed.");
				swfu.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.IO_ERROR:
				progress.setStatus("Server (IO) Error");
				swfu.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
				progress.setStatus("Security Error");
				swfu.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
				progress.setStatus("Upload limit exceeded.");
				swfu.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
				progress.setStatus("Failed Validation.  Upload skipped.");
				swfu.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
				break;
			case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
				// If there aren't any files left (they were all cancelled) disable the cancel button
				if (this.getStats().files_queued === 0) {
					document.getElementById(swfu.customSettings.cancelButtonId).disabled = true;
				}
				progress.setStatus("Cancelled");
				progress.setCancelled();
				break;
			case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
				progress.setStatus("Stopped");
				break;
			default:
				progress.setStatus("Unhandled Error: " + errorCode);
				swfu.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
				break;
			}
		} catch (ex) {
			swfu.debug(ex);
		}
	})

	.bind('fileQueued', function(event, file){
		try {
			var txtFileName = document.getElementById("txtFileName");
			txtFileName.value = file.name;
		} catch (e) {
		}
	})
	.bind('fileQueueError', function(event, file, errorCode, message){
		alert('Size of the file '+file.name+' is greater than limit');
	})
	.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
		var swfu = $.swfupload.getInstance('#swfupload-control');
		var btnSubmit=$('#btnSubmit');
		btnSubmit.click(function(){
			try {
				swfu.startUpload();
			} catch (ex) {

			}
			return false;
		});
		validateForm();
	})

	.bind('uploadStart', function(event, file){
		var swfu = $.swfupload.getInstance('#swfupload-control');
		try {
			var progress = new FileProgress(file, swfu.customSettings.progressTarget);
			progress.setStatus("Uploading...");
			progress.toggleCancel(true, this);
			trackFiles[trackFilesCount++] = file.name;
			updateDisplay.call(swfu,file);
		}
		catch (ex) {}
		return true;
	})

	.bind('uploadProgress', function(event, file, bytesLoaded, bytesTotal){
		var swfu = $.swfupload.getInstance('#swfupload-control');
		try {
			var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);
			file.id = "singlefile";
			var progress = new FileProgress(file, swfu.customSettings.progressTarget);
			var animPic = document.getElementById("loadanim");
			if (animPic != null) {
			  animPic.style.display = 'block';
			}
			progress.setStatus("Uploading..."+(isMacUser && file.size < MacMinSizeUpload ? ' ...Finishing up, 10 second delay' : ''));
			progress.setProgress(percent);
			$('#fsUploadProgress2').text(percent+'%');
			updateDisplay.call(swfu, file);
		} catch (ex) {
			swfu.debug(ex);
		}
	})
	.bind('uploadSuccess', function(event, file, serverData){
		var swfu = $.swfupload.getInstance('#swfupload-control');
		try {
			file.id = "singlefile";
			var progress = new FileProgress(file, swfu.customSettings.progressTarget);
			progress.setComplete();
			progress.setStatus("Complete.");
			progress.toggleCancel(false);

			if (serverData === " ") {
				swfu.customSettings.upload_successful = false;
			} else {
				swfu.customSettings.upload_successful = true;
				document.getElementById("hidFileID").value = serverData;
			}
		} catch (ex) {
			swfu.debug(ex);
		}
	})

	.bind('uploadComplete', function(event, file){
		// upload has completed, try the next one in the queue
		//$(this).swfupload('startUpload');
		var swfu = $.swfupload.getInstance('#swfupload-control');
		try {
			if (swfu.customSettings.upload_successful) {
				swfu.setButtonDisabled(true);
				//CALL BACK uploadDone(); OR
				//FORM SUBMIT document.forms[0].submit();
				alert('Congratutlaions Your File Has Been Uploaded!!');
			} else {
				file.id = "singlefile";	// This makes it so FileProgress only makes a single UI element, instead of one for each file
				var progress = new FileProgress(file, swfu.customSettings.progress_target);
				progress.setError();
				progress.setStatus("File rejected");
				progress.toggleCancel(false);

				var txtFileName = document.getElementById("txtFileName");
				txtFileName.value = "";
				validateForm();
				alert("There was a problem with the upload.\nThe server did not accept it.");
			}
		} catch (e) {
		}
	})

/// END
});

function updateDisplay(swfu,file) {
  // isMacUser Patch Begin
  if ( isMacUser ) {
	if (file == null && forceDone) {
      master.cancelUpload(forceFile.id,false);
      pauseProcess(500); // allow flash? to update itself
      master.uploadSuccess(forceFile,null);
      master.uploadComplete(forceFile);
      forceDone = false;
      return;
    }
    // check for small files less < 150k
    // note: dialup users will get bad results.
    if (file.size < MacMinSizeUpload && !forceDone) {
      master = swfu;
      if (!forceDone) {
        forceFile = file;
        // wait <n> seconds before enforcing upload done!
        setTimeout("updateDisplay("+null+","+null+")",MacDelay);
        forceDone = true;
      }
    }
  } // isMacUser Patch End
}

</script>
</head>

    <body>
        <?php
        include 'database.inc.php';
        include 'login_status.inc.php';
        include 'menu.php';?>
              <div style="width:1200px; margin-left: auto; margin-right: auto; border: thin solid; height: 800px;">
        <div id="content" style="float:left; text-align: center; width: 40%; margin-left: auto; margin-right: auto">

            <h2>Prześlij Pliki</h2>
	Zalogowany jako: <?php
            if ($zalogowany) {
                echo $ulogin;
            }else {
                echo "<a id='logup' href='zaloguj.php'>NIE ZALOGOWANY</a>";
}
mysql_close($mysql_db_link)
?>
        
          
                <p>Wybierz pliki do przesłania na serwer. Możesz wybrać wiele plików za jednym razem przytrzymując shift lub ctrl. Maksymalny rozmiar pliku to 1GB. Wysyłając pliki akceptujesz <a href="rules.php">regulamin serwisu</a>.</p>
<div>
							<div>
								<input type="text" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
								<div id="swfupload-control" style="display:inline;"><input type="button" id="mybutton" /></div><div id="fsUploadProgress2" style="display:inline;"></div>
							</div>
							<div class="flash" id="fsUploadProgress">
								<!-- This is where the file progress gets shown.  SWFUpload doesn't update the UI directly.
											The Handlers (in handlers.js) process the upload events and make the UI updates -->
							</div>
							<input type="hidden" name="hidFileID" id="hidFileID" value="" />
							<!-- This is where the file ID is stored after SWFUpload uploads the file and gets the ID back from upload.php -->
						</div>
					
			<br />
			<input type="submit" value="Upload" id="btnSubmit" />

        </div><div style="float:right; width: 59%; height: 150px; margin-left: auto; margin-right: auto; margin-top: auto; margin-bottom: auto; font-size: large; text-align: center;"><img src="images/zarobek.gif" style="float: right;" /><span style="float: left; top: 40px;">Umieszczaj pliki, dziel się nimi i zarabiaj!<br />Dostaniesz pieniądze
        za każdy megabajt ściągnięty z Twojego konta korzystając z transferu premium. Jeśli ktoś ściągnie 1GB (np. 1 film) dostaniesz za to 20gr. Jeśli ściągnie go 100 osób
        dostaniesz za to aż 20zł!<img src="images/kasa150px.gif" style="float: right;" /></span></div>
                   <div style="float:right; width: 40%; margin-left: auto; margin-right: 15%; margin-top: 20px;"> <div style="font-size:18px; with:800px; margin-left:auto; margin-right:auto; text-align:left">Co miesiąc najaktywniejsi użytkownicy dostają od nas nagrody. W tym miesiącu do wygrania:<ul><li>Odtwarzacz MP3 <b style="color:red">Apple iPod Nano 8GB</b> (miejsce 1.),</li>
    <li><b style="color:red">Pendrive Kingston Datatraveler DT100 8GB</b> (miejsce 2.)</li><li>oraz pakiety transferu premium <b style="color:red">200GB</b> (miejsce 3.),</li><li><b style="color:red">100GB</b> (miejsce 4.),</li><li><b style="color:red">50GB</b> (miejsce 5.),</li><li><b style="color:red">10GB</b> (miejsce 6.)</li><li>i <b style="color:red">5GB</b> (miejsce 7.)</li></ul> Nagrody są przyznawane o północy ostatniego dnia każdego miesiąca.<br /><br />
    Co zrobić, aby wygrać?<br />
    Wystarczy się zarejestrować (rejestracja jest darmowa) i aktywnie korzystać z serwisu polskirapid.pl. Za każdy wysłany megabajt dostajesz 1Pp (punkt premium). Jeśli ktoś ściąga za darmo plik wysłany przez Ciebie to za każdy ściągnięty megabajt również
    dostajesz 1Pp. Jeśli ktoś ściąga Twoje dane używając płatnego transferu premium to za każdy ściągnięty megabajt dostajesz 2Pp. Jeśli sam ściągasz korzystając z transferu
    premium to również dostajesz 2Pp za każdy megabajt. To takie proste. Nagrody są rozdawane wg klasyfikacji dokładnie o północy
    ostatniego dnia każdego miesiąca. Wtedy też punkty zostają wyzerowana, aby w każdym miesiącu każdy miał równe szanse. <a href="rules.php#konkurs">Regulamin konkursu</a>.
</div></div>
            </div>
        
      
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
