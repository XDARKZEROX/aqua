
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblXMLFeed', 'backend', 'Label / XML Feed', 'script', '2015-05-22 13:54:45');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'XML Feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'XML Feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'XML Feed', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnAddComment', 'backend', 'Button / + Add comment', 'script', '2015-05-22 13:55:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '+ Add comment', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '+ Add comment', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '+ Add comment', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddCommenterTitle', 'backend', 'Infobox / Add commenter', 'script', '2015-05-22 13:58:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Add commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Add commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Add commenter', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddCommenterDesc', 'backend', 'Infobox / Add commenter', 'script', '2015-05-22 13:59:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Fill in the form below and click "Save" button to add new commenter.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Fill in the form below and click "Save" button to add new commenter.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Fill in the form below and click "Save" button to add new commenter.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateCommenterTitle', 'backend', 'Infobox / Update commenter', 'script', '2015-05-22 14:01:10');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Update commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Update commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Update commenter', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateCommenterDesc', 'backend', 'Infobox / Update commenter', 'script', '2015-05-22 14:01:54');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You can make change on the form below and click "Save" button to edit commenter information.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You can make change on the form below and click "Save" button to edit commenter information.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You can make change on the form below and click "Save" button to edit commenter information.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoCommentsTitle', 'backend', 'Infobox / List of comments', 'script', '2015-05-22 14:04:32');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'List of comments', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'List of comments', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'List of comments', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoCommentsDesc', 'backend', 'Infobox / List of comments', 'script', '2015-05-22 14:07:57');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You can see below the list of comments. If you want to add new comment, click on the button "+ Add comment". You can also click on the pencil icon on the corresponding entry to view or edit details of the comment.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You can see below the list of comments. If you want to add new comment, click on the button "+ Add comment". You can also click on the pencil icon on the corresponding entry to view or edit details of the comment.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You can see below the list of comments. If you want to add new comment, click on the button "+ Add comment". You can also click on the pencil icon on the corresponding entry to view or edit details of the comment.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddCommentTitle', 'backend', 'Infobox / Add comment', 'script', '2015-05-22 14:10:55');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Add comment', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Add comment', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Add comment', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddCommentDesc', 'backend', 'Infobox / Add comment', 'script', '2015-05-22 14:12:10');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Fill in the form below and click "Save" button to add new comment. You can assign new comment to which page and which commenter.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Fill in the form below and click "Save" button to add new comment. You can assign new comment to which page and which commenter.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Fill in the form below and click "Save" button to add new comment. You can assign new comment to which page and which commenter.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateCommentTitle', 'backend', 'Infobox / Update comment', 'script', '2015-05-22 14:12:55');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Update comment', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Update comment', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Update comment', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateCommentDesc', 'backend', 'Infobox / Update comment', 'script', '2015-05-22 14:14:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You can make any change on the form below and click "Save" button to update the comment. To delete the current comment, click "Delete" button at the bottom of the form.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You can make any change on the form below and click "Save" button to update the comment. To delete the current comment, click "Delete" button at the bottom of the form.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You can make any change on the form below and click "Save" button to update the comment. To delete the current comment, click "Delete" button at the bottom of the form.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblNoAccessToFeed', 'backend', 'Label / No access to XML feed', 'script', '2015-05-22 14:28:08');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No access to XML feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No access to XML feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No access to XML feed', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoXMLFeedTitle', 'backend', 'Infobox / XML Feed', 'script', '2015-05-22 14:46:33');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'XML Feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'XML Feed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'XML Feed', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoXMLFeedDesc', 'backend', 'Infobox / XML Feed', 'script', '2015-05-22 14:49:20');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'There are two formats of Feed - CSV and XML. You need to select the period, enter the password, and click on the "Get Feed URL" button.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'There are two formats of Feed - CSV and XML. You need to select the period, enter the password, and click on the "Get Feed URL" button.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'There are two formats of Feed - CSV and XML. You need to select the period, enter the password, and click on the "Get Feed URL" button.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblFormat', 'backend', 'Label / Format', 'script', '2015-05-22 14:50:20');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Format', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Format', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Format', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_formats_ARRAY_xml', 'arrays', 'export_formats_ARRAY_xml', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'XML', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'XML', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'XML', 'script');

INSERT INTO `fields` VALUES (NULL, 'export_formats_ARRAY_csv', 'arrays', 'export_formats_ARRAY_csv', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'CSV', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'CSV', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'CSV', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblEnterPassword', 'backend', 'Label / Enter password', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Enter password', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Enter password', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Enter password', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblPeriod', 'backend', 'Label / Period', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Period', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Period', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Period', 'script');

INSERT INTO `fields` VALUES (NULL, 'peirod_arr_ARRAY_1', 'arrays', 'peirod_arr_ARRAY_1', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Today', 'script');

INSERT INTO `fields` VALUES (NULL, 'peirod_arr_ARRAY_2', 'arrays', 'peirod_arr_ARRAY_2', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Yesterday', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Yesterday', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Yesterday', 'script');

INSERT INTO `fields` VALUES (NULL, 'peirod_arr_ARRAY_3', 'arrays', 'peirod_arr_ARRAY_3', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This week', 'script');

INSERT INTO `fields` VALUES (NULL, 'peirod_arr_ARRAY_4', 'arrays', 'peirod_arr_ARRAY_4', 'script', '2015-05-22 15:01:08');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Last week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Last week', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Last week', 'script');

INSERT INTO `fields` VALUES (NULL, 'peirod_arr_ARRAY_5', 'arrays', 'peirod_arr_ARRAY_5', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This month', 'script');

INSERT INTO `fields` VALUES (NULL, 'peirod_arr_ARRAY_6', 'arrays', 'peirod_arr_ARRAY_6', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Last month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Last month', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Last month', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoCommentsFeedTitle', 'backend', 'Infobox / Comments Feed URL', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Comments Feed URL', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Comments Feed URL', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Comments Feed URL', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoCommentsFeedDesc', 'backend', 'Infobox / Comments Feed URL', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Use the URL below to have access to all comments. Please, note that if you change the password the URL will change too as password is used in the URL itself so no one else can open it.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Use the URL below to have access to all comments. Please, note that if you change the password the URL will change too as password is used in the URL itself so no one else can open it.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Use the URL below to have access to all comments. Please, note that if you change the password the URL will change too as password is used in the URL itself so no one else can open it.', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnGetFeedURL', 'backend', 'Button / Get Feed URL', 'script', '2015-05-22 15:00:25');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Get Feed URL', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Get Feed URL', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Get Feed URL', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblSubscribedToDiscussion', 'backend', 'Label / Subscribed to discussion', 'script', '2015-05-22 15:24:00');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Subscribed to discussion', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Subscribed to discussion', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Subscribed to discussion', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblPageComment', 'backend', 'Label / Page comment', 'script', '2015-05-22 15:43:01');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Page comment', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Page comment', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Page comment', 'script');

INSERT INTO `fields` VALUES (NULL, 'existing_arr_ARRAY_T', 'arrays', 'existing_arr_ARRAY_T', 'script', '2015-05-22 15:45:41');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Select existing commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Select existing commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Select existing commenter', 'script');

INSERT INTO `fields` VALUES (NULL, 'existing_arr_ARRAY_F', 'arrays', 'existing_arr_ARRAY_F', 'script', '2015-05-22 15:46:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Add new commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Add new commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Add new commenter', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblNA', 'backend', 'Label / N/A', 'script', '2015-05-22 15:56:46');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'N/A', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'N/A', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'N/A', 'script');

INSERT INTO `fields` VALUES (NULL, 'menuPreviewInstall', 'backend', 'Label / Preview & Install', 'script', '2015-05-22 16:00:49');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Preview & Install', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Preview & Install', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Preview & Install', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoInstallTitle', 'backend', 'Infobox / Install code', 'script', '2015-05-22 16:03:14');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Install code', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Install code', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Install code', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoInstallDesc', 'backend', 'Infobox / Install code', 'script', '2015-05-22 16:05:48');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Below you can select the page and theme and click on the "Get Install Code" button to see the install code. You can also click on the button "Preview" to have a quick look to see how the front-end is.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Below you can select the page and theme and click on the "Get Install Code" button to see the install code. You can also click on the button "Preview" to have a quick look to see how the front-end is.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Below you can select the page and theme and click on the "Get Install Code" button to see the install code. You can also click on the button "Preview" to have a quick look to see how the front-end is.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblSelectPage', 'backend', 'Label / Select page', 'script', '2015-05-22 16:06:31');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Select page', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Select page', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Select page', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblSelectTheme', 'backend', 'Label / Select theme', 'script', '2015-05-22 16:07:04');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Select theme', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Select theme', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Select theme', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnGetInstallCode', 'backend', 'Button / Get Install Code', 'script', '2015-05-22 16:08:11');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Get Install Code', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Get Install Code', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Get Install Code', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnAddUser', 'backend', 'Button / + Add user', 'script', '2015-05-22 17:02:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '+ Add user', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '+ Add user', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '+ Add user', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUsersTitle', 'backend', 'Infobox / List of users', 'script', '2015-05-22 17:04:57');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'List of users', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'List of users', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'List of users', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUsersDesc', 'backend', 'Infobox / List of users', 'script', '2015-05-22 17:06:27');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Below is the list of users. If you want to view or edit the detail information of a specific user, click on the pencil icon on the corresponding entry. You can also click on the "+ Add user" button to add new user.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Below is the list of users. If you want to view or edit the detail information of a specific user, click on the pencil icon on the corresponding entry. You can also click on the "+ Add user" button to add new user.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Below is the list of users. If you want to view or edit the detail information of a specific user, click on the pencil icon on the corresponding entry. You can also click on the "+ Add user" button to add new user.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddUserTitle', 'backend', 'Infobox / Add user', 'script', '2015-05-22 17:07:53');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Add user', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Add user', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Add user', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoAddUserDesc', 'backend', 'Infobox / Add user', 'script', '2015-05-22 17:10:42');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Fill in the form below and click "Save" button to add new user. There are two user roles - Admin and Editor. Admin will have full permission to access administration pages. Editor can only access to Pages, Comments, and Commeters.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Fill in the form below and click "Save" button to add new user. There are two user roles - Admin and Editor. Admin will have full permission to access administration pages. Editor can only access to Pages, Comments, and Commeters.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Fill in the form below and click "Save" button to add new user. There are two user roles - Admin and Editor. Admin will have full permission to access administration pages. Editor can only access to Pages, Comments, and Commeters.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateUserTitle', 'backend', 'Infobox / Update user', 'script', '2015-05-22 17:11:27');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Update user', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Update user', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Update user', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdateUserDesc', 'backend', 'Infobox / Update user', 'script', '2015-05-22 17:12:06');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Let''s make any change on the form below and click "Save" button to edit user information.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Let''s make any change on the form below and click "Save" button to edit user information.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Let''s make any change on the form below and click "Save" button to edit user information.', 'script');

COMMIT;