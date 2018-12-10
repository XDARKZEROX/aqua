
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblNoPageMessage', 'backend', 'Label / No page message', 'script', '2015-05-22 17:42:15');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No pages added. Click {STAG}here{ETAG} to add page.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No pages added. Click {STAG}here{ETAG} to add page.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No pages added. Click {STAG}here{ETAG} to add page.', 'script');

COMMIT;