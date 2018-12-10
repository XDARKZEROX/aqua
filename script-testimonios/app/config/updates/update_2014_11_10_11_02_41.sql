
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_AC05', 'arrays', 'error_titles_ARRAY_AC05', 'script', '2014-11-10 17:54:21');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'File size too large', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'File size too large', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'File size too large', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_AC05', 'arrays', 'error_bodies_ARRAY_AC05', 'script', '2014-11-10 17:55:16');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'New comment could not be added because file size is too large and your server cannot upload it. Maximum allowed size is {SIZE}. Please, upload smaller file.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'New comment could not be added because file size is too large and your server cannot upload it. Maximum allowed size is {SIZE}. Please, upload smaller file.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'New comment could not be added because file size is too large and your server cannot upload it. Maximum allowed size is {SIZE}. Please, upload smaller file.', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_AC06', 'arrays', 'error_titles_ARRAY_AC06', 'script', '2014-11-10 17:55:35');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'File size too large', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'File size too large', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'File size too large', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_AC06', 'arrays', 'error_bodies_ARRAY_AC06', 'script', '2014-11-10 17:56:14');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'The comment could not be updated successfully because file size is too large and your server cannot upload it. Maximum allowed size is {SIZE}. Please, upload smaller file.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'The comment could not be updated successfully because file size is too large and your server cannot upload it. Maximum allowed size is {SIZE}. Please, upload smaller file.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'The comment could not be updated successfully because file size is too large and your server cannot upload it. Maximum allowed size is {SIZE}. Please, upload smaller file.', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_AC09', 'arrays', 'error_titles_ARRAY_AC09', 'script', '2014-11-10 17:56:42');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Upload error', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Upload error', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Upload error', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_AC09', 'arrays', 'error_bodies_ARRAY_AC09', 'script', '2014-11-10 17:57:20');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'New comment has been added, but file could not be uploaded successfully.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'New comment has been added, but file could not be uploaded successfully.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'New comment has been added, but file could not be uploaded successfully.', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_AC10', 'arrays', 'error_titles_ARRAY_AC10', 'script', '2014-11-10 17:57:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Upload error', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Upload error', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Upload error', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_AC10', 'arrays', 'error_bodies_ARRAY_AC10', 'script', '2014-11-10 17:58:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'The comment has been updated, but file could not be uploaded successfully.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'The comment has been updated, but file could not be uploaded successfully.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'The comment has been updated, but file could not be uploaded successfully.', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_postcomment_ARRAY_FPC19', 'arrays', 'front_postcomment_ARRAY_FPC19', 'script', '2014-11-10 18:01:05');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Your comment could not be posted because the file size is too large.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Your comment could not be posted because the file size is too large.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Your comment could not be posted because the file size is too large.', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_postcomment_ARRAY_FPC20', 'arrays', 'front_postcomment_ARRAY_FPC20', 'script', '2014-11-10 18:01:54');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Your comment has been posted, but the file could not be uploaded because the file size is too large.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Your comment has been posted, but the file could not be uploaded because the file size is too large.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Your comment has been posted, but the file could not be uploaded because the file size is too large.', 'script');

COMMIT;