
START TRANSACTION;

SET @id := (SELECT `id` FROM `fields` WHERE `key` = "opt_o_file_allowed");

UPDATE `multi_lang` SET `content` = 'File with extension is allowed to upload.' WHERE `foreign_id` = @id AND `model` = "pjField" AND `field` = "title";

COMMIT;