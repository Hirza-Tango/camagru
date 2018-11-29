<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');

$sql_get_gallery_page = $db->prepare('
	SELECT
		a.`uuid`, a.`like_count`, a.`comment_count`, a.`created`, b.username as username, (SELECT 1 FROM `likes` WHERE `upload` = a.`uuid` AND `user` = :user) as is_liked, a.`user`
	FROM
		`uploads` as a
	JOIN
		`users` as b ON a.`user` = b.`uuid`
	ORDER BY
		a.`created` DESC
	LIMIT :start, :page_size
');
$sql_get_gallery_size = $db->prepare('
	SELECT
		COUNT(*) as count
	FROM
		`uploads`
');
$sql_get_image = $db->prepare('
	SELECT
		a.`uuid`, a.`like_count`, a.`comment_count`, a.`created`, b.username as username, (SELECT 1 FROM `likes` WHERE `upload` = a.`uuid` AND `user` = :user) as is_liked, `user`
	FROM
		`uploads` as a
	JOIN
		`users` as b ON a.`user` = b.`uuid`
	WHERE
		a.`uuid` = :uuid
	LIMIT 1;
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
	ORDER BY
		a.`created` DESC;
');
$sql_get_login = $db->prepare('
	SELECT
		`uuid`, `email`, `username`, `email_on_comment`, `password`, `validation_required`
	FROM
		`users`
	WHERE
		(email = :email OR username = :username);
');
$sql_get_password = $db->prepare('
	SELECT
		`password`
	FROM
		`users`
	WHERE
		`uuid` = :uuid;
');
$sql_get_last_upload = $db->prepare('
	SELECT
		`uuid`
	FROM
		`uploads`
	WHERE
		`user` = :user
	ORDER BY `created` DESC
	LIMIT 1;
');
$sql_get_email = $db->prepare('
	SELECT
		b.`email`
	FROM
		`uploads` as a
	JOIN
		`users` as b
	ON
		a.`user` = b.`uuid`
	WHERE
		a.`uuid` = :upload AND `email_on_comment` = 1
');
$sql_post_user = $db->prepare('
	INSERT INTO `users`
		(`uuid`,`email`,`username`,`password`, `validation_required`)
	VALUES
		(UUID(), :email, :username, :password, :validation)
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
$sql_update_user = $db->prepare('
	UPDATE `users` SET
		`username`= :username,
		`email`= :email,
		`email_on_comment`= :email_on_comment
	WHERE
		`uuid` = :user;
');
$sql_update_password = $db->prepare('
	UPDATE `users` SET
		`password`= :newpass
	WHERE
		`uuid` = :user;
');
$sql_invalidate_user = $db->prepare('
	UPDATE `users` SET
		`validation_required` = :token
	WHERE
		`email` = :email;
');
$sql_reset_password = $db->prepare('
	UPDATE `users` SET
		`password`= :newpass,
		`validation_required` = NULL
	WHERE
		`validation_required` = :token;
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
$sql_update_verification = $db->prepare('
	UPDATE `users` SET
		`validation_required` = NULL
	WHERE
		`validation_required` = :token
');
$sql_delete_user = $db->prepare('
	DELETE FROM `users`
	WHERE `uuid` = :user
');
$sql_delete_upload = $db->prepare('
	DELETE FROM `uploads`
	WHERE `uuid` = :upload AND `user` = :user
');
$sql_delete_like = $db->prepare('
	DELETE FROM `likes`
	WHERE `user` = :user
	AND `upload` = :upload
');
?>