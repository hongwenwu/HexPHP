<?php
class View{
	
	protected $vars = array();

	function __constract(){}
	//模板赋值
	public function assign($var, $value){
		//is_array判断是否数组
		if(is_array($var)){
			//array_merge 合并数组
			$this->vars = array_merge($this->vars,$var);
		}else{
			$this->vars[$var] = $value;
		}
	}
	//模板显示
	public function display($tplfile){
		$tplfile = !empty($tplfile) ? $tplfile: $_GET[ACTION];
		$template = APPPATH."/".APP_TEMPLATE."/".$_GET[MODEL]."/".$tplfile.".html";
		if(!file_exists($template)){
			halt("模板文件不存在".$template);
		}
		if(!empty($this->vars)){
			foreach ($this->vars as $key => $value) {
				$$key = $value;
			}
		}
		include_once $template;
	}
	public function error($msg="",$ref='javascript:void(0);'){
		echo $msg;
		echo "<script>";
		echo $ref;
		echo "</script>";
	}
}