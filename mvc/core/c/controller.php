<?php
class controller{
	protected $viewObj;
	public function __construct()
	{
		$this->viewObj = new View();
	}
	//模板赋值
	public function assign($val,$value){
		$this->viewObj->assign($val,$value);
	}
	//显示模板
	public function display($file=NULL){
		$this->viewObj->display($file);
	}
	//加载模型
	protected function loadModel($modelName){
		//组合文件地址
		$modelFile = APPPATH."/".APP_MODULE."/".$modelName.".php";
		//判断文件是否存在
		if(!file_exists($modelFile)){
			halt("模型文件不存在".$modelFile);
		}
		//包含文件
		include_once $modelFile;
		//生成类名 单词首字母大写 驼峰命名法
		$class = ucwords($modelName);
		//判断该类是否存在
		if(!class_exists($class)){
			halt($class."模型类未定义");
		}
		//实例化并返回
		$model = new $class();
		return $model;
	}
	
}

//end controller.php