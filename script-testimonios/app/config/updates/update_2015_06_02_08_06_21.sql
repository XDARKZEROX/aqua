
START TRANSACTION;

UPDATE `options` SET `value` = 'New author registration' WHERE `key` = "o_email_new_member_subject";

UPDATE `options` SET `value` = 'Dear {Name},\r\n\r\nto confirm your registration please follow the link\r\n\r\n{ActivatedURL}\r\n\r\nRegards,\r\nAdminstrator' WHERE `key` = "o_email_member_confirmation";

UPDATE `options` SET `value` = 'Activate your account' WHERE `key` = "o_email_member_confirmation_subject";

UPDATE `options` SET `value` = 'New comment has been posted.\r\n\r\nComment ID: {CommentID}\r\nThread: {ThreadReferenceId}\r\nComment: {CommentMessage}\r\n\r\nClick to edit comment: {EditCommentURL}' WHERE `key` = "o_email_new_comment";

UPDATE `options` SET `value` = 'New author has registered.\r\n\r\nName: {Name}\r\nEmail: {Email}' WHERE `key` = "o_email_new_member";

UPDATE `options` SET `value` = 'New author registration' WHERE `key` = "o_email_new_member_subject";

UPDATE `options` SET `value` = 'New comment has been posted.\r\n\r\nComment ID: {CommentID}\r\nThread: {ThreadReferenceId}\r\nComment: {CommentMessage}\r\n\r\nClick to edit comment: {EditCommentURL}' WHERE `key` = "o_email_new_reply";

UPDATE `options` SET `value` = 'New comment to {ThreadReferenceId}' WHERE `key` = "o_email_new_reply_subject";

UPDATE `options` SET `value` = 'Comment ID: {CommentID}\r\nThread: {ThreadReferenceId}\r\nComment: {CommentMessage}\r\n\r\nClick to edit comment: {EditCommentURL}' WHERE `key` = "o_email_report";

UPDATE `options` SET `value` = 'A comment has been reported' WHERE `key` = "o_email_report_subject";

UPDATE `options` SET `value` = 'Dear {Name},\r\n\r\nto confirm your registration please follow the link\r\n\r\n{ActivatedURL}\r\n\r\nRegards,\r\nAdminstrator' WHERE `key` = "o_resend_activation_url";

UPDATE `options` SET `value` = 'Activate your account' WHERE `key` = "o_resend_activation_url_subject";

UPDATE `options` SET `value` = 'New author registered.' WHERE `key` = "o_sms_new_member_registration";

COMMIT;