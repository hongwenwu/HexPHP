<?php
define("WEB_ROOT_PATH", str_replace("\\","/",dirname(__FILE__)));
define("APPPATH",WEB_ROOT_PATH."/app");
define("OSPATH",WEB_ROOT_PATH."/core");

require_once OSPATH."/init.php";

$init = new App();

$init->run();

//end index.php