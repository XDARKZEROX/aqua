
START TRANSACTION;

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_allow_topic_rating");
UPDATE `multi_lang` SET `content` = 'Allow thread rating' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_allow_topic_subscribing");
UPDATE `multi_lang` SET `content` = 'Allow thread subscribing' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblPageComment");
UPDATE `multi_lang` SET `content` = 'Thread comment' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_body_new_comment");
UPDATE `multi_lang` SET `content` = 'Body<br/><br/>Available tokens:<br/>{CommentID}<br/>{ThreadReferenceId}<br/>{CommentMessage}' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_body_report");
UPDATE `multi_lang` SET `content` = 'Body<br/><br/>Available tokens:<br/>{CommentID}<br/>{ThreadReferenceId}<br/>{CommentMessage}' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_body_new_reply");
UPDATE `multi_lang` SET `content` = 'Body<br/><br/>Available tokens:<br/>{CommentID}<br/>{ThreadReferenceId}<br/>{CommentMessage}<br/>{ViewCommentURL}' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

UPDATE `options` SET `value` = 'New comment has been posted.\r\n\r\nComment ID: {CommentID}\r\nThread: {ThreadReferenceId}\r\nComment: {CommentMessage}' WHERE `key` = "o_email_new_reply";

COMMIT;