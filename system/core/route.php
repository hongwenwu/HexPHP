<?php

namespace core;
/**
 * URL路由类
 * @author hongwenwu
 *
 */
class route {
	/**
	 * 传入参数
	 * @var Array
	 */
	protected $parem = array();
	/**
	 * URL类型
	 * @var unknown
	 */
	protected $uri= 1;
	
	function __construct(){
		
	}
	/**
	 * 获取URL参数
	 */
	protected function getParem(){
		$this->parem = $_GET;
	}
}

?>