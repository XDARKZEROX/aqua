
START TRANSACTION;

UPDATE `options` SET `order`='7' WHERE `key`='o_allow_topic_subscribing';  
UPDATE `options` SET `order`='8' WHERE `key`='o_new_member_activation'; 

INSERT INTO `options` (`foreign_id`, `key`, `tab_id`, `value`, `label`, `type`, `order`, `is_visible`, `style`) VALUES
(1, 'o_banned_words', 2, NULL, NULL, 'text', 6, 1, NULL);

INSERT INTO `fields` VALUES (NULL, 'opt_o_banned_words', 'backend', 'Options / Banned words', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Banned words', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Banned words', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Banned words', 'script');

INSERT INTO `fields` VALUES (NULL, 'option_tips_ARRAY_o_banned_words', 'arrays', 'option_tips_ARRAY_o_banned_words', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You can make a list of words (separated by commas) and comments containing any of these words will not be allowed.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You can make a list of words (separated by commas) and comments containing any of these words will not be allowed.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You can make a list of words (separated by commas) and comments containing any of these words will not be allowed.', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_error_ARRAY_banned_words', 'arrays', 'front_error_ARRAY_banned_words', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Comment contains banned words.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Comment contains banned words.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Comment contains banned words.', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_postcomment_ARRAY_FPC21', 'arrays', 'front_postcomment_ARRAY_FP21', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Your comment could not be posted because it contains banned word(s).', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Your comment could not be posted because it contains banned word(s).', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Your comment could not be posted because it contains banned word(s).', 'script');

COMMIT;