<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');

$sql_get_gallery_page = $db->prepare('
	SELECT
		a.`uuid`, a.`like_count`, a.`comment_count`, a.`created`, b.username as username
	FROM
		`uploads` as a
	JOIN
		`users` as b ON a.`user` = b.`uuid`
	ORDER BY
		a.`created` DESC
	LIMIT :start, :page_size
');
$sql_get_upload_comments = $db->prepare('
	SELECT
		b.username as username, a.`text`, a.`created`, a.`updated`
	FROM
		`comments` as a
	JOIN
		`users` as b ON a.`user` = b.`uuid`
	WHERE
		upload = :upload
');
$sql_get_login = $db->prepare('
	SELECT
		`uuid`, `email`, `username`, `email_on_comment`
	FROM
		`users`
	WHERE
		(email = :email or username = :username)
		AND password = :pass
');

$sql_post_user = $db->prepare('
	INSERT INTO `users`
		(`uuid`,`email`,`username`,`password`)
	VALUES
		(UUID(), :email, :username, :password)
');
$sql_post_upload = $db->prepare('
	INSERT INTO `uploads`
		(`uuid`, `user`)
	VALUES
		(UUID(), :user)
');
$sql_post_comment = $db->prepare('
	INSERT INTO `comments`
		(`upload`, `user`, `text`)
	VALUES
		(:upload, :user, :text)
');
$sql_post_like = $db->prepare('
	INSERT INTO `likes`
		(`upload`, `user`)
	VALUES
		(:upload, :user)
');
//TODO: Should a uuid token be used for this?
//TODO: HMAC token checking
$sql_update_user = $db->prepare('
	UPDATE `users` SET
		`username`= :username,
		`email`= :newemail,
		`email_on_comment`= :email_on_comment
	WHERE
		`uuid` = :user
');
$sql_update_password = $db->prepare('
	UPDATE `users` SET
		`password`= :newpass,
	WHERE
		`uuid` = :user
');
$sql_update_comment = $db->prepare('
	UPDATE `comments` SET
		`text` = :text
	WHERE
		`user` = :user
		AND `upload` = :upload
		AND `created` = :created
		AND `created` >= CURRENT_TIMESTAMP - INTERVAL 5 MINUTE
');
$sql_delete_user = $db->prepare('
	DELETE FROM `users`
	WHERE `uuid` = :user
');
$sql_delete_upload = $db->prepare('
	DELETE FROM `uploads`
	WHERE `uuid` = :upload
');
$sql_delete_like = $db->prepare('
	DELETE FROM `likes`
	WHERE `user` = :user
	AND `upload` = :upload
');
?>