<?php
/**
 * Smarty模板引擎初始化文件
**/

defined('author') or die('error');

$SM = new Smarty;
$SM->debugging = false;
$SM->caching = false;
$SM->setCacheDir(ROOT.'/cache'); //缓存目录
$SM->setTemplateDir(ROOT.'/templates'); //模板目录
$SM->setCompileDir(ROOT.'/templates_c'); //编译目录
$SM->addPluginsDir(ROOT.'/plugins'); //添加插件目录
$SM->setConfigDir(ROOT.'/config'); //配置目录

$SM->assign('DB', $db);
$SM->assign('CONFIG', $config);
