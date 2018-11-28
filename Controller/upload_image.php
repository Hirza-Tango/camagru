<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
$base = preg_replace('/^data:image\/\w+;base64,/', '', $_POST['image']);
$base = base64_decode($base);
if ($base === false)
	display_error("bad base64");
$base = imagecreatefromstring($base);
if ($base === false)
	display_error("Could not load image");
$overlays = explode(',', $_POST['overlays']);
error_log(var_export($overlays) . PHP_EOL, 3, $_SERVER['DOCUMENT_ROOT']."/log.log");
foreach ($overlays as $value) {
	$new = imagecreatefromstring(file_get_contents($value));
	if ($new === false)
		display_error("Could not load overlay");
	//This is super inefficient, but I'm lazy, so
	$tmp = imagescale($new, (imagesx($new) / imagesy($new)) * imagesy($base), imagesy($base));
	imagedestroy($new);
	$new = $tmp;
	$tmp = imagescale($new, imagesx($base));
	imagedestroy($new);
	$new = $tmp;
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
	imagealphablending($new, false);
	imagesavealpha($new, true);

	//This is a workaround for the alpha layer
	//	Create a truecolor area the same size as the new image
	$alpha_section = imagecreatetruecolor(imagesx($new), imagesy($new));
	//	The point where the new image is placed (the middle ish)
	$new_x = (imagesx($base) - imagesx($new)) / 2;
	$new_y = (imagesy($base) - imagesy($new)) / 2;
	//	Copy the base to the truecolor
	imagecopy($alpha_section, $base, 0, 0, $new_x, $new_y, imagesx($new), imagesy($new));
	//	Copy the new to the truecolor
	//		So many zeroes because the new is the same size as the truecolor
	imagecopy($alpha_section, $new, 0, 0, 0, 0, imagesx($new), imagesy($new));
	//	Merge the truecolor to preserve alpha
	imagecopymerge($base, $alpha_section, $new_x, $new_y, 0, 0, imagesx($new), imagesy($new), 100);
	imagedestroy($new);
	imagedestroy($alpha_section);
}
try {
	$db->beginTransaction();
	$sql_post_upload->execute(Array(":user"=>$_SESSION['user']['uuid']));
	$sql_get_last_upload->execute(Array(":user"=>$_SESSION['user']['uuid']));
	$filename = $sql_get_last_upload->fetch(PDO::FETCH_ASSOC)['uuid'] . '.png';
} catch (PDOException $e) {
	$db->rollback();
	imagedestroy($base);
	display_error("Could not upload. Please retry");
}
if (!imagepng($base, $_SERVER['DOCUMENT_ROOT'].'//Image//'.$filename)) {
	$db->rollback();
	imagedestroy($base);
	display_error("Could not upload. Please retry");
}
$db->commit();
imagedestroy($base);
display_status("Image successfully uploaded");
header("Location: /");
?>