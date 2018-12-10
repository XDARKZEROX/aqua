
START TRANSACTION;

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_body_new_comment");
UPDATE `multi_lang` SET `content` = 'Body<br/><br/>Available tokens:<br/>{CommentID}<br/>{PageName}<br/>{CommentMessage}<br/>{EditCommentURL}' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_body_report");
UPDATE `multi_lang` SET `content` = 'Body<br/><br/>Available tokens:<br/>{CommentID}<br/>{PageName}<br/>{CommentMessage}<br/>{EditCommentURL}' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AT04");
UPDATE `multi_lang` SET `content` = 'Thread not added.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AT08");
UPDATE `multi_lang` SET `content` = 'Thread not found.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblUpdateTopic");
UPDATE `multi_lang` SET `content` = 'Update thread' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AT01");
UPDATE `multi_lang` SET `content` = 'Changes made to this thread have been saved.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AT03");
UPDATE `multi_lang` SET `content` = 'Changes made to this thread have been saved.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AT04");
UPDATE `multi_lang` SET `content` = 'We are sorry, but the thread has not been added.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AT08");
UPDATE `multi_lang` SET `content` = 'Thread you are looking for is missing.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AT01");
UPDATE `multi_lang` SET `content` = 'Thread updated!' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AT03");
UPDATE `multi_lang` SET `content` = 'Thread added!' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "existing_arr_ARRAY_T");
UPDATE `multi_lang` SET `content` = 'Select existing author' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "existing_arr_ARRAY_F");
UPDATE `multi_lang` SET `content` = 'Add new author' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoAddCommentDesc");
UPDATE `multi_lang` SET `content` = 'Fill in the form below and click "Save" button to add new author.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblAddMember");
UPDATE `multi_lang` SET `content` = 'Add author' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblUpdateMember");
UPDATE `multi_lang` SET `content` = 'Update author' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AM01");
UPDATE `multi_lang` SET `content` = 'Changes made to this author have been saved.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AM03");
UPDATE `multi_lang` SET `content` = 'Author has been added.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AM04");
UPDATE `multi_lang` SET `content` = 'We are sorry, but the author has not been added.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_bodies_ARRAY_AM08");
UPDATE `multi_lang` SET `content` = 'Author you are looking for is missing.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AM01");
UPDATE `multi_lang` SET `content` = 'Author updated!' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AM03");
UPDATE `multi_lang` SET `content` = 'Author added!' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AM04");
UPDATE `multi_lang` SET `content` = 'Author not added.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "error_titles_ARRAY_AM08");
UPDATE `multi_lang` SET `content` = 'Author not found.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblSelectPage");
UPDATE `multi_lang` SET `content` = 'Select thread' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoInstallDesc");
UPDATE `multi_lang` SET `content` = 'Select the thread and the theme you need to use and then either preview it or get its installation code. You need to put the PHP code for the thread on a .php page.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "notify_sms_ARRAY_1");
UPDATE `multi_lang` SET `content` = 'New author registration' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "notify_email_ARRAY_1");
UPDATE `multi_lang` SET `content` = 'New author notification' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_sms_new_member_registration");
UPDATE `multi_lang` SET `content` = 'New author registration' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoNotificationsEmailBody");
UPDATE `multi_lang` SET `content` = 'Different email notifications will be sent when various events occur. Leave subject empty if you do not want to send some of the notifications. Go to Users menu and edit an user to specify which of the notification he/she will receive.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_email_member_confirmation");
UPDATE `multi_lang` SET `content` = 'New author confirmation' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_email_new_member");
UPDATE `multi_lang` SET `content` = 'New author notification' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_new_member_activation");
UPDATE `multi_lang` SET `content` = 'New author activation' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoUpdateCommenterDesc");
UPDATE `multi_lang` SET `content` = 'Use the form below to change author\'s profile.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoUpdateCommenterTitle");
UPDATE `multi_lang` SET `content` = 'Update author' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoAddCommenterDesc");
UPDATE `multi_lang` SET `content` = 'Fill in the form below and click "Save" button to add new author.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoAddCommenterTitle");
UPDATE `multi_lang` SET `content` = 'Add Author' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "btnAddCommenter");
UPDATE `multi_lang` SET `content` = '+ Add author' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "member_list_titles_body");
UPDATE `multi_lang` SET `content` = 'Below you can see a list with all authors who posted comment(s) on your threads.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoXMLFeedDesc");
UPDATE `multi_lang` SET `content` = 'You can create a feed (CSV or XML format) for the comments posted. You can password protect the feed so others cannot access it. Use the Period option to specify which comments to be included in the feed.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblExportFeed");
UPDATE `multi_lang` SET `content` = 'Export Comments' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoCommentsDesc");
UPDATE `multi_lang` SET `content` = 'Below you can find all comments posted to all threads. You can filter the comments by their status or search for a comment. ' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoCommentsTitle");
UPDATE `multi_lang` SET `content` = 'Comments' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblMember");
UPDATE `multi_lang` SET `content` = 'Author' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblComment");
UPDATE `multi_lang` SET `content` = 'Comment' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblTopic");
UPDATE `multi_lang` SET `content` = 'Thread' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoUpdatePageDesc");
UPDATE `multi_lang` SET `content` = 'Use the form below to change page URL and reference ID for this thread.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoUpdatePageTitle");
UPDATE `multi_lang` SET `content` = 'Update thread' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "add_topic_titles_body");
UPDATE `multi_lang` SET `content` = 'Enter page URL where thread will be placed. You can use reference ID field as a short reference for the thread.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblPageURL");
UPDATE `multi_lang` SET `content` = 'Page where thread will be placed' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "add_topic_titles_title");
UPDATE `multi_lang` SET `content` = 'Add thread' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "btnAddPage");
UPDATE `multi_lang` SET `content` = '+ Add thread' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblPage");
UPDATE `multi_lang` SET `content` = 'Thread' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoPagesDesc");
UPDATE `multi_lang` SET `content` = 'Below you can see a list of available threads. You can create unlimited number of threads or change the settings for existing threads.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "infoPagesTitle");
UPDATE `multi_lang` SET `content` = 'Threads' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblPopularTopics");
UPDATE `multi_lang` SET `content` = 'Most popular threads' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "menuTopics");
UPDATE `multi_lang` SET `content` = 'Threads' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "member_list_titles_title");
UPDATE `multi_lang` SET `content` = 'Authors' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "menuMembers");
UPDATE `multi_lang` SET `content` = 'Authors' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblMembers");
UPDATE `multi_lang` SET `content` = 'Authors' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblTopMembers");
UPDATE `multi_lang` SET `content` = 'Top authors' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "lblNoMemberFound");
UPDATE `multi_lang` SET `content` = 'No authors found.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

COMMIT;