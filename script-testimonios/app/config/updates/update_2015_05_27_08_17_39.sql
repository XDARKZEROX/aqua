
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblInactive', 'backend', 'Label / Inactive', 'script', '2015-05-27 09:56:20');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Inactive', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Inactive', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Inactive', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblExportFeed', 'backend', 'Label / Export Feed', 'script', '2015-05-27 10:32:41');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Export Feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Export Feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Export Feed', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblAllPages', 'backend', 'Label / All pages', 'script', '2015-05-27 14:32:03');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'All pages', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'All pages', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'All pages', 'script');

COMMIT;