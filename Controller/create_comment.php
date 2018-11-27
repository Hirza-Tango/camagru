<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');

$image = $_POST['image'];
$comment = input_clean($_POST['comment']);

if (!isset($comment, $image))
	display_error("Could not upload comment");
if (!is_uuid($image))
	display_error("Image not found");
try {
	$sql_post_comment->execute(Array(":upload"=>$image, ":user"=>$_SESSION['user']['uuid'], ":text"=>$comment));
} catch (PDOException $e){
	display_error("Could not upload comment");
}
#TODO: send email
header('Location: /image.php?image='.$image);
?>