<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjTopicModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'topics';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'topic', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'page_url', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'views', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'created', 'type' => 'datetime', 'default' => ':NOW()'),
		array('name' => 'status', 'type' => 'enum', 'default' => ':NULL')
	);
	
	public static function factory($attr=array())
	{
		return new pjTopicModel($attr);
	}
}
?>