
START TRANSACTION;

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "menuTopics");
UPDATE `multi_lang` SET `content` = 'Pages' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "menuMembers");
UPDATE `multi_lang` SET `content` = 'Commenters' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblAddTopic");
UPDATE `multi_lang` SET `content` = 'Add page' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblInstallPhp1_0");
UPDATE `multi_lang` SET `content` = 'Please select the page that you want to install.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblTopic");
UPDATE `multi_lang` SET `content` = 'Page(s)' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblUpdateTopic");
UPDATE `multi_lang` SET `content` = 'Update page' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AT01");
UPDATE `multi_lang` SET `content` = 'All the changes made to this page have been saved.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AT03");
UPDATE `multi_lang` SET `content` = 'All the changes made to this page have been saved.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AT04");
UPDATE `multi_lang` SET `content` = 'We are sorry, but the page has not been added.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AT08");
UPDATE `multi_lang` SET `content` = 'Page you are looking for is missing.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AT01");
UPDATE `multi_lang` SET `content` = 'Page updated!' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AT03");
UPDATE `multi_lang` SET `content` = 'Page added!' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AT04");
UPDATE `multi_lang` SET `content` = 'Page failed to added.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AT08");
UPDATE `multi_lang` SET `content` = 'Page not found.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "front_report_case_ARRAY_03");
UPDATE `multi_lang` SET `content` = 'out of page' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_allow_topic_rating");
UPDATE `multi_lang` SET `content` = 'Allow page rating' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_allow_topic_subscribing");
UPDATE `multi_lang` SET `content` = 'Allow page subscribing' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_body_new_comment");
UPDATE `multi_lang` SET `content` = 'Body\r\n<br/>\r\n<br/>\r\nAvailable tokens:\r\n<br/>\r\n{CommentID}\r\n<br/>\r\n{PageName}\r\n<br/>\r\n{CommentMessage}\r\n<br/>\r\n{EditCommentURL}' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_body_report");
UPDATE `multi_lang` SET `content` = 'Body\r\n<br/>\r\n<br/>\r\nAvailable tokens:\r\n<br/>\r\n{CommentID}\r\n<br/>\r\n{PageName}\r\n<br/>\r\n{CommentMessage}\r\n<br/>\r\n{EditCommentURL}' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_body_new_reply");
UPDATE `multi_lang` SET `content` = 'Body\r\n<br/>\r\n<br/>\r\nAvailable tokens:\r\n<br/>\r\n{CommentID}\r\n<br/>\r\n{PageName}\r\n<br/>\r\n{CommentMessage}\r\n<br/>\r\n{EditCommentURL}' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblTopics");
UPDATE `multi_lang` SET `content` = 'Pages' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblPopularTopics");
UPDATE `multi_lang` SET `content` = 'Most popular pages' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblNoTopicFound");
UPDATE `multi_lang` SET `content` = 'No pages found.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "add_topic_titles_title");
UPDATE `multi_lang` SET `content` = 'Create new page' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "add_topic_titles_body");
UPDATE `multi_lang` SET `content` = 'Enter page URL and reference ID for the web page where the comment box will be placed.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "member_list_titles_body");
UPDATE `multi_lang` SET `content` = 'Below you can see commenter profiles for all people who posted a comment on your pages.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "front_label_notopic");
UPDATE `multi_lang` SET `content` = 'The page no longer exists.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "front_label_inactive_topic");
UPDATE `multi_lang` SET `content` = 'The page is no longer active.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblAddMember");
UPDATE `multi_lang` SET `content` = 'Add commenter' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblMember");
UPDATE `multi_lang` SET `content` = 'Commenter(s)' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblMemberSince");
UPDATE `multi_lang` SET `content` = 'First comment' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblUpdateMember");
UPDATE `multi_lang` SET `content` = 'Update commenter' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AM01");
UPDATE `multi_lang` SET `content` = 'All the changes made to this commenter have been saved.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AM03");
UPDATE `multi_lang` SET `content` = 'A new commenter has been added into the list.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AM04");
UPDATE `multi_lang` SET `content` = 'We are sorry, but the commenter has not been added.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AM08");
UPDATE `multi_lang` SET `content` = 'Commenter you are looking for is missing.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AM01");
UPDATE `multi_lang` SET `content` = 'Commenter updated!' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AM03");
UPDATE `multi_lang` SET `content` = 'Commenter added!' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AM04");
UPDATE `multi_lang` SET `content` = 'Commenter failed to add.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AM08");
UPDATE `multi_lang` SET `content` = 'Commenter not found.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_email_new_member");
UPDATE `multi_lang` SET `content` = 'New commenter notification' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "notify_email_ARRAY_1");
UPDATE `multi_lang` SET `content` = 'New commenter notification' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblMembers");
UPDATE `multi_lang` SET `content` = 'Commenters' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblTopMembers");
UPDATE `multi_lang` SET `content` = 'Top commenters' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblNoMemberFound");
UPDATE `multi_lang` SET `content` = 'No commenters found.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_email_member_confirmation");
UPDATE `multi_lang` SET `content` = 'New commenter confirmation' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_new_member_activation");
UPDATE `multi_lang` SET `content` = 'New commenter activation' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "notify_sms_ARRAY_1");
UPDATE `multi_lang` SET `content` = 'New commenter registration' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_sms_new_member_registration");
UPDATE `multi_lang` SET `content` = 'New commenter registration' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "member_list_titles_title");
UPDATE `multi_lang` SET `content` = 'Commenters' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

UPDATE `options` SET `is_visible`=0 WHERE `key`='o_layout';  

INSERT INTO `options` (`foreign_id`, `key`, `tab_id`, `value`, `label`, `type`, `order`, `is_visible`, `style`) VALUES
(1, 'o_theme', 1, 'theme1|theme2|theme3|theme4|theme5|theme6|theme7|theme8|theme9|theme10::theme1', 'Theme 1|Theme 2|Theme 3|Theme 4|Theme 5|Theme 6|Theme 7|Theme 8|Theme 9|Theme 10', 'enum', 9, 1, NULL);

COMMIT;