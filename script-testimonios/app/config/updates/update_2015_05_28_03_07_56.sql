
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblTotalComments', 'backend', 'Label / Total comments', 'script', '2015-05-28 09:55:29');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Total comments', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Total comments', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Total comments', 'script');

COMMIT;