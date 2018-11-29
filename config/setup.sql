DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `likes`;
DROP TABLE IF EXISTS `uploads`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
	`uuid` CHAR(36) PRIMARY KEY,
	`email` VARCHAR(191) UNIQUE NOT NULL,
	`username` VARCHAR(191) UNIQUE NOT NULL,
	`password` CHAR(128) NOT NULL,
	`email_on_comment` BOOL NOT NULL DEFAULT 1,
	`validation_required` CHAR(10) NULL
);

CREATE TABLE `uploads` (
	`uuid` CHAR(36) PRIMARY KEY,
	`user` CHAR(36) NOT NULL,
	`like_count` INT NOT NULL DEFAULT 0,
	`comment_count` INT NOT NULL DEFAULT 0,
	`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (`user`) REFERENCES `users`(`uuid`) ON DELETE CASCADE
);

CREATE TABLE `comments` (
	`upload` CHAR(36) NOT NULL,
	`user` CHAR(36) NOT NULL,
	`text` TEXT NOT NULL,
	`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (`user`) REFERENCES `users`(`uuid`) ON DELETE CASCADE,
	FOREIGN KEY (`upload`) REFERENCES `uploads`(`uuid`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `likes` (
	`upload` CHAR(36) NOT NULL,
	`user` CHAR(36) NOT NULL,
	`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	UNIQUE INDEX (`upload`, `user`),
	FOREIGN KEY (`user`) REFERENCES `users`(`uuid`) ON DELETE CASCADE,
	FOREIGN KEY (`upload`) REFERENCES `uploads`(`uuid`) ON DELETE CASCADE
);

INSERT INTO `users` (`uuid`, `email`, `username`, `password`) VALUES
('9219e0d0-f3bf-11e8-b9bd-7d9d9b332a3d', "dslogrove@gmail.com","Dylan_Slogrove","$2y$10$y1FaRYTQECQdmlJF5O0aDeCtHIAbCVGwZ5bwVzxW9eTgoVeBjDEiG"),
("9219e1d4-f3bf-11e8-b9bd-7d9d9b332a3d", "cosincla@student.wethinkcode.co.za", "Connor_Sinclair", "$2y$10$7xsH2RAz6XtvdfHf1vo/tu1NCoCPzvMiUwv1oxtE1UW4ojKPPJZIu");

INSERT INTO `uploads` (`uuid`, `user`, `created`) VALUES
('2fb6a328-f3c0-11e8-b9bd-7d9d9b332a3d', '9219e0d0-f3bf-11e8-b9bd-7d9d9b332a3d', '2018-11-29 10:18:59'),
('7f8eee78-f3c0-11e8-b9bd-7d9d9b332a3d', '9219e1d4-f3bf-11e8-b9bd-7d9d9b332a3d', '2018-11-29 10:21:13'),
('8a290792-f3c0-11e8-b9bd-7d9d9b332a3d', '9219e1d4-f3bf-11e8-b9bd-7d9d9b332a3d', '2018-11-29 10:21:31'),
('a52637a4-f3c0-11e8-b9bd-7d9d9b332a3d', '9219e0d0-f3bf-11e8-b9bd-7d9d9b332a3d', '2018-11-29 10:22:16'),
('aa842d92-f3bf-11e8-b9bd-7d9d9b332a3d', '9219e0d0-f3bf-11e8-b9bd-7d9d9b332a3d', '2018-11-29 10:15:15'),
('c2d9e382-f3bf-11e8-b9bd-7d9d9b332a3d', '9219e1d4-f3bf-11e8-b9bd-7d9d9b332a3d', '2018-11-29 10:15:56');

DROP TRIGGER IF EXISTS LIKE_INCREMENT;
CREATE TRIGGER LIKE_INCREMENT AFTER INSERT ON `likes`
FOR EACH ROW
	UPDATE `uploads` SET `like_count` = `like_count` + 1
	WHERE `uuid` = NEW.`upload`;

DROP TRIGGER IF EXISTS COMMENT_INCREMENT;
CREATE TRIGGER COMMENT_INCREMENT AFTER INSERT ON `comments`
FOR EACH ROW
	UPDATE `uploads` SET `comment_count` = `comment_count` + 1
	WHERE `uuid` = NEW.`upload`;

DROP TRIGGER IF EXISTS LIKE_DECREMENT;
CREATE TRIGGER LIKE_DECREMENT AFTER DELETE ON `likes`
FOR EACH ROW
	UPDATE `uploads` SET `like_count` = `like_count` - 1
	WHERE `uuid` = OLD.`upload`;

DROP TRIGGER IF EXISTS COMMENT_DECREMENT;
CREATE TRIGGER COMMENT_DECREMENT AFTER DELETE ON `comments`
FOR EACH ROW
	UPDATE `uploads` SET `comment_count` = `comment_count` - 1
	WHERE `uuid` = OLD.`upload`;