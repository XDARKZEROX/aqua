
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblNoComments', 'backend', 'Label / No comments', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No comments', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No comments', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No comments', 'script');

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblNoTopicFound");
UPDATE `multi_lang` SET `content` = 'No threads found.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

COMMIT;