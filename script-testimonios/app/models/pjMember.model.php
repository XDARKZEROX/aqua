<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjMemberModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'members';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'name', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'email', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'password', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'website', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'member_since', 'type' => 'date', 'default' => ':NULL'),
		array('name' => 'mime_type', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'avatar_path', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'avatar_name', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'hash', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'last_login', 'type' => 'datetime', 'default' => ':NULL'),
		array('name' => 'active_expire', 'type' => 'date', 'default' => ':NULL'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T')
	);
	
	public static function factory($attr=array())
	{
		return new pjMemberModel($attr);
	}
}
?>