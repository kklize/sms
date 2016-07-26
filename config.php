<?php
if(isset($_SERVER['HTTP_HOST']))
{
    define('HTTP_HOST', $_SERVER['HTTP_HOST']);
}else{
    define('HTTP_HOST', '192.168.33.10:8060');
}
define('GLOBAL_URL'  , 'http://'.HTTP_HOST.'/');

define('SITE_URL'  ,   GLOBAL_URL.'index.php/');

define('ADMINER_URL' , GLOBAL_URL.'admin/');
define('MOBILE_URL'  , GLOBAL_URL.'mobile/');

# 引用绝对路径PATH定义
define('ROOT'        , dirname(__FILE__).'/');
define('SHARED_PATH'   , ROOT.'shared/');
define('APPLI_PATH', ROOT.'application/');
