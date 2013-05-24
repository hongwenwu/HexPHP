<?php
/**
 *初始化入口文件
 *定义各种常量
 */
header("Content-type:text/html;charset=utf-8");
if(!defined("WEB_ROOT_PATH"))
	define("WEB_ROOT_PATH", str_replace("\\","/",dirname(__FILE__)."/.."));
if(!defined("OSPATH"))
	define("OSPATH",str_replace("\\","/",dirname(__FILE__)));
if(!defined("MODULE"))
	define("MODULE",OSPATH."/m");
if(!defined("VIEW"))
	define("VIEW",OSPATH."/v");
if(!defined("CONTROLLER"))
	define("CONTROLLER",OSPATH."/c");
include_once OSPATH."/lib/config.php"; //配置文件
include_once OSPATH."/lib/functions.php"; //配置函数
include_once OSPATH."/lib/defines.php"; //配置文件
//模块名 , 操作名
if(isset($config['model']))
	define("MODEL",$config['model']);
if(isset($config['acion']))
	define("ACTION",$config['acion']);


include_once MODULE."/model.php"; //模型
include_once VIEW."/view.php"; //视图
include_once CONTROLLER."/controller.php"; //控制器
class App{
	public function run(){
		$this->route();
		$control = $_GET[MODEL]; //控制器
		$action = $_GET[ACTION]; //操作函数
		$controlFile = APPPATH."/".APP_ACTION."/".$control.".php";
		if(!file_exists($controlFile)){
			halt("控制器文件不存在".$controlFile);
		}
		include_once $controlFile;
		$class = ucwords($control);
		if(!class_exists($class)){
			halt($controlFile."中未定义的类".$class);
		}
		$instance = new $class();
		if (!method_exists($instance,$action)) {
			halt($controlFile."中定义的类".$class."没有找到该方法".$action);
		}
		$instance->$action();
	}
	public function route(){
		global $config;
		//两种模式来判断URL格式
		if($config['url_mode'] == 1){
			//url: http://www.demo.com/mvc/index.php?m=Index&a=index
			$control = !empty($_GET[MODEL]) ? trim($_GET[MODEL]):"";
			$action = !empty($_GET[ACTION]) ? trim($_GET[ACTION]):"";
		}else if($config['url_mode'] == 2){
			//url: http://www.demo.com/mvc/index.php/Index/index
			if(isset($_SERVER['PATH_INFO'])){
				$paths = explode("/",trim($_SERVER['PATH_INFO'],"/"));
				$control = array_shift($paths);
				$action = array_shift($paths);
			}
		}
		$_GET[MODEL] = $control = !empty($control) ? $control : $config['default_model'];
		$_GET[ACTION] = $action = !empty($action)  ? $action  : $config['default_action'];
	}
}

//end init.php