<?php
class Index extends controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$model = $this->loadModel("category");
		$res = $model->Query("SELECT * FROM category");
		$row = $model->fetch($res);
		//echo $model->getlastsql();
		$this->assign("atitle",$row);
		$this->display();
	}
	public function show(){
		$title =  "Index/show 这里是show方法";
		//$this->error("错误了");
		$this->assign("atitle",$title);
		$this->display();
	}
}