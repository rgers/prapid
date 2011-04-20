<?php
/**
Revision 1.5
Rewritten by Ricky Mataka www.DivorceTheBoss.com
Date: June 19, 2010.
History: Full Jquery Implimentation for Classic Form Demo
History: js/handlers.js Eliminated -- Used Plugin to Bind

Warranty: None, use at your own risk.
License: Follow SWFUpload license.
SWFUpload unmodified can be found here: http://www.swfupload.org/
**/

if (!class_exists('S3')) require_once 's3/S3.php';

// AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAITQQDYV5WK4LLYWQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

// Check for CURL
if (!extension_loaded('curl') && !@dl(PHP_SHLIB_SUFFIX == 'so' ? 'curl.so' : 'php_curl.dll'))
	exit("\nERROR: CURL extension not loaded\n\n");


S3::setAuth(awsAccessKey, awsSecretKey);

$bucket = 'isdmusic';
$path = ''; // Can be empty ''

$lifetime = 3600; // Period for which the parameters are valid
$maxFileSize = (1024 * 1024 * 50); // 50 MB

$metaHeaders = array('uid' => 123);
$requestHeaders = array(
    'Content-Type' => 'application/octet-stream',
    'Content-Disposition' => 'attachment; filename=${filename}'
);

$params = S3::getHttpUploadPostParams(
    $bucket,
    $path,
    S3::ACL_PUBLIC_READ,
    $lifetime,
    $maxFileSize,
    201, // Or a URL to redirect to on success
    $metaHeaders,
    $requestHeaders,
    false // False since we're not using flash
);


foreach ($params as $p => $v) {
        echo $p." ".$v;
}

//echo $params->AWSAccessKeyId;
//echo $params->policy;
echo $params->Content-Type;
echo $params->attachment;
echo $params->uid;


//echo awsAccessKey;

$S3_BUCKET = 'isdmusic';
$SUCCESS_REDIRECT = "http://isdtest.users34.interdns.co.uk/";
$SWFRoot = "http://isdtest.users34.interdns.co.uk/";

$isMacUser = (preg_match("/macintosh/",strtolower($_SERVER['HTTP_USER_AGENT'])) ? true : false);

if ( !isset($S3_BUCKET) || $S3_BUCKET == 'AWS_BUCKET' ) {
  echo "Um, sorry, I need my configuration file. :( ";
  exit(0);
}

/*
  Flash 10.1 issue, omitted the below from the policy
        {"success_action_redirect": "' . $SUCCESS_REDIRECT . '"},
*/

//$MAX_FILE_SIZE = 50 * 1048576;
//$expTime = time() + (1 * 60 * 60);
//$expTimeStr = gmdate('Y-m-d\TH:i:s\Z', $expTime);
//$policyDoc = '{
//        "expiration": "' . $expTimeStr . '",
//        "conditions": [
//        {"bucket": "' . $S3_BUCKET . '"},
//        ["starts-with", "$key", ""],
//        {"acl": "public-read"},
//        ["content-length-range", 0, '. $MAX_FILE_SIZE .'],
//        {"success_action_status": "201"},
//        ["starts-with", "$Filename", ""], 
//        ["starts-with", "$Content-Type", "image/"]
//      ]
//}';
//$policyDoc = implode(explode('\r', $policyDoc));
//$policyDoc = implode(explode('\n', $policyDoc));
//$policyDoc64 = base64_encode($policyDoc);
//$sigPolicyDoc = base64_encode(hash_hmac("sha1", $policyDoc64, awsSecretKey, TRUE));
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>SWFUpload Demos - Classic Form Demo</title>
<link href="default.css" rel="stylesheet" type="text/css" />
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
		upload_url: "http://<?php echo $bucket; ?>.s3.amazonaws.com/",
		post_params: {"AWSAccessKeyId":"<?php echo $params->AWSAccessKeyId; ?>", "key":"${filename}", "acl":"public-read", "policy":"<?php echo $params->policy; ?>", "signature":"<?php echo $params->signature; ?>","success_action_status":"201", "content-type":"application/octet-stream", "Content-Disposition":"attachment; filename=${filename}", "uid":"123"},
		http_success : [201], 
		assume_success_timeout : <?php echo ($isMacUser ? 5 : 0); ?>,

		// File Upload Settings
		file_post_name: 'file',
		file_size_limit : "20240",    // 20 MB
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
				alert('DONE!!');
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

// this should *not* be needed, just testing an idea 
function pauseProcess(millis) {
  var sDate = new Date();
  var cDate = null;

  do { 
    cDate = new Date(); 
  } while(cDate-sDate < millis);
}
function validateForm() {
	//validate here
}
</script>
</head>

<body>
<div id="content">
	<h2>Classic Form Demo</h2>
	<form id="form1" action="#" enctype="multipart/form-data" method="post">

		<div class="fieldset">
			<span class="legend">Submit your Application</span>
			<table style="vertical-align:top;">
				<tr>
					<td><label for="lastname">Last Name:</label></td>
					<td><input name="lastname" id="lastname" type="text" style="width: 200px" /></td>

				</tr>
				<tr>
					<td><label for="firstname">First Name:</label></td>
					<td><input name="firstname" id="firstname" type="text" style="width: 200px" /></td>
				</tr>
				<tr>
					<td><label for="education">Education:</label></td>
					<td><textarea name="education"  id="education" cols="0" rows="0" style="width: 400px; height: 100px;"></textarea></td>

				</tr>
				<tr>
					<td><label for="txtFileName">Resume:</label></td>
					<td>
						<div>
							<div>
								<input type="text" name="file" id="txtFileName" disabled="true" style="border: solid 1px; background-color: #FFFFFF;" />
								<div id="swfupload-control" style="display:inline;"><input type="button" id="mybutton" /></div><div id="fsUploadProgress2" style="display:inline;"></div>
							</div>
							<div class="flash" id="fsUploadProgress">
								<!-- This is where the file progress gets shown.  SWFUpload doesn't update the UI directly.
											The Handlers (in handlers.js) process the upload events and make the UI updates -->
							</div>                         
							<input type="hidden" name="hidFileID" id="hidFileID" value="" />
							<!-- This is where the file ID is stored after SWFUpload uploads the file and gets the ID back from upload.php -->
						</div>
					</td>

				</tr>
				<tr>
					<td><label for="references">References:</label></td>
					<td><textarea name="references" id="references" cols="0" rows="0" style="width: 400px; height: 100px;"></textarea></td>
				</tr>
			</table>
			<br />
			<input type="submit" value="Submit Application" id="btnSubmit" />
		</div>
	</form>
</div>
</body>
</html>
