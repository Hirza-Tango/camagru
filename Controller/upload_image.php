<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
//TODO: image type checking
$base = preg_replace('/^data:image\/\w+;base64,/', '', $_POST['image']);
$base = base64_decode($base);
if ($base === false)
	display_error("bad base64");
$base = imagecreatefromstring($base);
if ($base === false)
	display_error("Could not load image");

$overlays = explode(',', $_POST['overlays']);
/** 
* PNG ALPHA CHANNEL SUPPORT for imagecopymerge(); 
* by Sina Salek 
* 
* Bugfix by Ralph Voigt (bug which causes it 
* to work only for $src_x = $src_y = 0. 
* Also, inverting opacity is not necessary.) 
* 08-JAN-2011 
* 
**/
//TODO: refactor this copied code
function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
	// creating a cut resource 
	$cut = imagecreatetruecolor($src_w, $src_h);

	// copying relevant section from background to the cut resource 
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
	
	// copying relevant section from watermark to the cut resource 
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 
	
	// insert cut resource to destination image 
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct); 
}
foreach ($overlays as $value) {
	$file = file_get_contents($value);
	$new = imagecreatefromstring(file_get_contents($value));
	if ($new === false)
		display_error("Could not load overlay");
	if (imagesy($new) > imagesy($base)) {
		$tmp = imagescale($new, (imagesx($new) / imagesy($new)) * imagesy($base), imagesy($base));
		imagedestroy($new);
		$new = $tmp;
	}
	if (imagesx($new) > imagesx($base)) {
		$tmp = imagescale($new, imagesx($base));
		imagedestroy($new);
		$new = $tmp;
	}
	imagealphablending( $new, false );
	imagesavealpha( $new, true );
	imagecopymerge_alpha($base, $new, (imagesx($base) - imagesx($new)) / 2, (imagesy($base) - imagesy($new)) / 2, 0, 0, imagesx($new), imagesy($new), 100);
	imagedestroy($new);
}
try {
	$db->beginTransaction();
	$sql_post_upload->execute(Array(":user"=>$_SESSION['user']['uuid']));
	$sql_get_last_upload->execute(Array(":user"=>$_SESSION['user']['uuid']));
	$filename = $sql_get_last_upload->fetch(PDO::FETCH_ASSOC)['uuid'] . '.png';
} catch (PDOException $e) {
	$db->rollback();
	display_error("Could not upload. Please retry");
}
if (!imagepng($base, $_SERVER['DOCUMENT_ROOT'].'//Image//'.$filename)) {
	$db->rollback();
	display_error("Could not upload. Please retry");
}
$db->commit();
display_status("Image successfully uploaded");
header("Location: /");
?>