
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'menuPreview', 'backend', 'Menu / Preview', 'script', '2015-05-19 14:09:14');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Preview', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Preview', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Preview', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoPagesTitle', 'backend', 'Infobox / List of pages', 'script', '2015-05-19 15:21:16');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'List of pages', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'List of pages', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'List of pages', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoPagesDesc', 'backend', 'Infobox / List of pages', 'script', '2015-05-19 15:22:45');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You can see below the list of pages. In order to add new page, click on the button "+ Add page". If you want to view or edit the details of a specific page, click on the pencil icon on the corresponding entry.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You can see below the list of pages. In order to add new page, click on the button "+ Add page". If you want to view or edit the details of a specific page, click on the pencil icon on the corresponding entry.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You can see below the list of pages. In order to add new page, click on the button "+ Add page". If you want to view or edit the details of a specific page, click on the pencil icon on the corresponding entry.', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnAddPage', 'backend', 'Button / + Add page', 'script', '2015-05-19 15:23:49');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '+ Add page', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '+ Add page', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '+ Add page', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblID', 'backend', 'Label / ID', 'script', '2015-05-19 15:25:12');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'ID', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'ID', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'ID', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblReferenceID', 'backend', 'Label / Reference ID', 'script', '2015-05-19 15:25:43');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Reference ID', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Reference ID', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Reference ID', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblReferenceIDAllowed', 'backend', 'Label / Reference ID contains only letters or digits.', 'script', '2015-05-19 15:32:57');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Reference ID contains only letters or digits.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Reference ID contains only letters or digits.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Reference ID contains only letters or digits.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblPageURLInvalid', 'backend', 'Label / Page URL is invalid.', 'script', '2015-05-19 15:33:58');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Page URL is invalid.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Page URL is invalid.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Page URL is invalid.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblFieldRequired', 'backend', 'Label / This field is required.', 'script', '2015-05-19 15:37:37');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This field is required.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This field is required.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This field is required.', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdatePageTitle', 'backend', 'Infobox / Update page', 'script', '2015-05-19 16:10:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Update page', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Update page', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Update page', 'script');

INSERT INTO `fields` VALUES (NULL, 'infoUpdatePageDesc', 'backend', 'Infobox / Update page', 'script', '2015-05-19 16:10:55');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You can make any change on the form below and click "Save" button to edit page information.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You can make any change on the form below and click "Save" button to edit page information.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You can make any change on the form below and click "Save" button to edit page information.', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblPage', 'backend', 'Label / Page', 'script', '2015-05-19 16:41:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Page', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Page', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Page', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnAddCommenter', 'backend', 'Button / + Add commenter', 'script', '2015-05-19 16:57:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '+ Add commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '+ Add commenter', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '+ Add commenter', 'script');

INSERT INTO `fields` VALUES (NULL, 'opt_o_theme', 'backend', 'Options / Theme', 'script', '2015-05-19 17:28:19');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Theme', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Theme', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Theme', 'script');

COMMIT;