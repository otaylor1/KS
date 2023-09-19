<?php
global $productDisplayName;
$productDisplayName = "Developer Test";

// For images in pages for different versions of the game
global $dsjBaseOffset, $dsjImageBase;

/** @var string $dsjBaseOffset Base directory of Digital Science Journal. Will be used in future for other versions of game */
$dsjBaseOffset = "";

/** @var string $dsjImageBase Location of images relative to page  */
$dsjImageBase = $dsjBaseOffset . "images/";

/**
 * All pages should start off this this call!
 * You can either add scripts/styles on the page, or just close </head> and start <body>
 */
function standardHeader() {
	global $productDisplayName;
	$pageName = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
	$viewmode = "logging";
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo ucfirst($pageName); ?> - <?php echo $productDisplayName; ?> Digital Journal</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;700&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap-reboot.min.css" integrity="sha512-YmRhY1UctqTkuyEizDjgJcnn0Knu5tdpv09KUI003L5tjfn2YGxhujqXEFE7fqFgRlqU/jeTI+K7fFurBnRAhg==" crossorigin="anonymous" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<script type="text/javascript" src="<?php forceCacheBuster("js/digital-journal.js"); ?>"></script>
	<link rel="stylesheet" href="<?php echo forceCacheBuster("css/digital-journal.css"); ?>">
	<link rel="stylesheet" href="<?php echo forceCacheBuster("css/popover.css"); ?>">
<?php if(file_exists("css/".$pageName.".css")) { ?>
	<link rel="stylesheet" href="<?php forceCacheBuster("css/".$pageName.".css"); ?>">
<?php } ?>
<?php if(file_exists(("js/".$pageName.".js"))) {?>
	<script src="<?php forceCacheBuster("js/".$pageName.".js"); ?>"></script>
<?php } ?>
	<script type="text/javascript">
		var viewMode = "<?php echo $viewmode; ?>";
	</script>
<?php
}

/**
 * Appends a parameter to the name of a file based on the file's modification
 * time which helps to prevent the browser from caching older versions of JS
 * or CSS files
 *
 * @param string $filename File to append characters to prevent caching (especially iOS!)
 */
function forceCacheBuster($filename) {
	echo $filename;
	if(file_exists(realpath( dirname( __FILE__ ) )."/../".$filename)) {
		echo "?" . filemtime( realpath( dirname( __FILE__ ) )."/../".$filename);
	}
}

/**
 * Simple body we can use when we just need to display an error
 *
 * @param stirng $message What error occured
 */
function errorBody($message) { ?>
</head>
<body>
	<div class="fixed-container">
		<div class="error-listing">
			<h1>ERROR!</h1>
			<p><?php echo $message; ?></p>
		</div>
<?php
}

/**
 * A body for a page that to show when the user failed to log in
 */
function failedLoginBody() {
	global $dsjImageBase;
?>
</head>
<body>
	<div class="fixed-container">
		<div class="error-listing">
			<h1>FAILED TO LOG IN!</h1>
			<p>Please try to login again.</p>
			<img class="go-back" src="<?php echo $dsjImageBase; ?>back.png"/>
		</div>
<?php
}

/**
 * Writes the closing </div> and any final scripts we need to call
 */
function standardFooter() { ?>
		</div>
	</div>
<?php // Reserved for additional scripts ?>
</body>
</html>
<?php
}

/* ---- UI ---- */
/**
 * Creates the button area at the top left.
 */
function writeUIButtons() {
	global $dsjImageBase;
?>
		<ul class="buttons">
			<li id="dashboard-button"><a href="javascript:backToDashboard();"><img src="<?php echo $dsjImageBase; ?>icons/dashboard.png" data-toggle="popover" data-placement="right" data-content="<div>Back to Dashboard!</div>" data-original-title="" title=""/></a></li>
			<li id="account-button"><a href="javascript:backToAccounts();"><img src="<?php echo $dsjImageBase; ?>icons/accounts.png" data-toggle="popover" data-placement="right" data-content="<div>Back to Accounts!</div>" data-original-title="" title=""/></a></li>
			<li id="comment-button"><a href="javascript:leaveComment();"><img src="<?php echo $dsjImageBase; ?>icons/comment.png" data-toggle="popover" data-placement="right" data-content="<div>Leave a comment</div>" data-original-title="" title=""/></a></li>
		</ul>
<?php
}

/**
 * Use to write vocabulary words so that they are styled and have a popover
 *
 * @param string $word The vocabulary word that will be displayed with a popover
 * @param string $partOfSpeech The part of speech of the vocabulary word
 * @param string $definition The definition of the vocabulary word
 * @param bool $returnNotEcho Toggles writing to PHP or returning a string if true.
 * @return void|string If $returnNotEcho is true, the content is returned as a string, otherwise it will use PHP's echo() to write the content
 */
function vocabularyWord(string $word, string $partOfSpeech, string $definition, bool $returnNotEcho = false) {
	$content = '<span class="vocabularyPopover" data-toggle="popover" data-placement="top" data-content="<div><b>' . ucfirst($word) . '</b>:&nbsp;&nbsp; <i>(' . $partOfSpeech . ')</i><br/>' . $definition . '</div>">' . $word . '</span>';
	if($returnNotEcho==false) {
		echo $content;
	} else {
		return $content;
	}
}

/**
 * Writes a question marker so we can later change the
 * @param string $questionId
 * @param bool $returnNotEcho Toggles writing to PHP or returning a string if true.
 * @return void|string If $returnNotEcho is true, the content is returned as a string, otherwise it will use PHP's echo() to write the content
 */
function questionMarker(string $questionId, bool $returnNotEcho = false) {
	$value = '<span id="'. $questionId . '" class="question-marker-incomplete">&#9733;</span> ';
	if($returnNotEcho) {
		return $value;
	} else {
		echo $value;
	}
}


function writeQuestionInput($id, $class) {
	echo '<input id="' . $id . '" class="' . $class .'" type="text" data-question-type="textinput"/>';
}

function writeQuestionNumberInput($id, $class, $maxLength, $minValue, $maxValue) {
	echo '<input id="' . $id . '" class="' . $class .'" type="text" data-question-type="numberinput" maxlength="' . $maxLength . '" min="' . $minValue . '" max="' . $maxValue .'"/>';
}

function writeQuestionTextarea($id, $class) {
	echo '<textarea id="' . $id . '" class="' . $class .'" type="text" data-question-type="textarea"></textarea>';
}

?>