<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjFileModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'files';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'comment_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'mime_type', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'file_path', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'file_name', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'hash', 'type' => 'varchar', 'default' => ':NULL')
	);
	
	public $i18n = array('name');
	
	public static function factory($attr=array())
	{
		return new pjFileModel($attr);
	}
}
?>