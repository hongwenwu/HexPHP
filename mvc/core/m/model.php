<?php
class Model{
	protected $dblink = NULL;
	protected $dbsql;
	public function __construct(){
		global $config;
		$this->dblink = mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']) or die(mysql_error());
		mysql_select_db($config['db_name'],$this->dblink);
		mysql_query("set names '".$config['db_char']."'",$this->dblink);
	}

	//执行sql返回结果
	public function Query($sql){
		$this->dbsql = $sql;
		$res = mysql_query($sql) or die(mysql_error());
		return $res;
	}
	//执行sql返回状态
	public function exec($sql){
		$this->dbsql = $sql;
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	//获取查询语句
	public function getlastsql(){
		return $this->dbsql;
	}
	//返回处理后的结果
	public function fetch($res ,$type = 'array'){
		$func = $type =='array' ? "mysql_fetch_array":"mysql_fetch_object";
		$row = $func($res);
		return $row;
	}
}