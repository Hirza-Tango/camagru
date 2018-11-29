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
try {
	$sql_get_email->execute(Array(":upload"=>$image));
	$email = $sql_get_email->fetchAll(PDO::FETCH_ASSOC);
	//Check that email is returned
	if ($sql_get_email->rowCount() != 1)
		header('Location: /image.php?image='.$image);
	$email = $email[0]['email'];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$message = 'A user commented "'.$comment.'"on your post! To see the comment, click <a href="http://'.$_SERVER['HTTP_HOST'].'/image.php?image='.$image.'">here</a>.'."\nYou can disable these emails in your profile settings.";
		$message = wordwrap($message, 70, "\n");
		!mail($email, "Camagru comment", $message);
	}
} catch (PDOException $e){
	display_error("DEBUG: ".$e->getMessage());
}
header('Location: /image.php?image='.$image);
?>