<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjCommentModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'comments';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'member_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'topic_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'rating', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'comment_text', 'type' => 'text', 'default' => ':NULL'),
		array('name' => 'subscribed', 'type' => 'enum', 'default' => '0'),
		array('name' => 'likes', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'dislikes', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'ip', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'created', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'status', 'type' => 'enum', 'default' => ':NULL')
	);
	
	public static function factory($attr=array())
	{
		return new pjCommentModel($attr);
	}
}
?>