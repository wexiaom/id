<?php
/**
 * 域名转发安装文件
**/
ini_set("display_errors", 'on');
error_reporting(E_ALL);
$version = '1.2.2';
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>域名转发程序安装</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet"/>
  <style>body{margin-top:10px;}.container{max-width:700px;}</style>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <script src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div class="container">
<?php
if(file_exists('../version.lock')){
  echo '<div class="alert alert-info">程序已经安装啦！</div>';
  exit;
} 
switch(@$_GET['do']){
  case 'check':
    echo '<div class="list-group"><div class="list-group-item active">运行环境兼容检测</div>';
    if(class_exists('mysqli')){
      echo '<div class="list-group-item text-success">Mysqli数据库类<span class="glyphicon glyphicon-ok-sign pull-right"></span></div>';
    }else{
      echo '<div class="list-group-item text-danger">Mysqli数据库类<span class="glyphicon glyphicon-remove-sign pull-right"></span></div>';
      $stoped = true;
    }
    if(substr_count($_SERVER['PHP_SELF'],'/install') <= 1){
      echo '<div class="list-group-item text-success">程序在网站根目录<span class="glyphicon glyphicon-ok-sign pull-right"></span></div>';
    }else{
      echo '<div class="list-group-item text-danger">程序在网站根目录<span class="glyphicon glyphicon-remove-sign pull-right"></span></div>';
      $stoped = true;
    }
    if(function_exists('curl_init')){
      $ch = curl_init('http://'.$_SERVER['HTTP_HOST'].'/jump.php');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: forward-install.ll00.cn','Referer: http://www.ll00.cn/'));
      if(curl_exec($ch) == '<!-- '.md5('forward-install.ll00.cn'.$_SERVER['DOCUMENT_ROOT']).' -->'){
        echo '<div class="list-group-item text-success">域名解析支持<span class="glyphicon glyphicon-ok-sign pull-right"></span></div>';
      }else{
        echo '<div class="list-group-item text-danger">域名解析支持<span class="glyphicon glyphicon-remove-sign pull-right"></span></div>';
        $stoped = true;
      }
    }else{
      echo '<div class="list-group-item text-warning">Curl函数库支持<span class="glyphicon glyphicon-remove-sign pull-right"></span></div>';
	  $stoped = true;
    }
    echo '</div>';
    if(isset($stoped)){
      echo '<div class="alert alert-info">缺少必要条件支持，您无法使用该程序</div>';
    }else{
      echo '<a href="index.php?do=db_input" class="btn btn-default">下一步：数据库信息填写</a>';
    }
  break;
  case 'db_input':
    echo '<form action="index.php?do=db_save" method="post" class="form-horizontal"><fieldset><legend>数据库信息</legend>'.
         '<div class="form-group"><label class="col-sm-2 control-label">数据库主机</label><div class="col-sm-10"><input type="text" name="db_host" class="form-control" value="localhost" placeholder="localhost" required/></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">数据库用户</label><div class="col-sm-10"><input type="text" name="db_user" class="form-control" value="root" placeholder="root" required/></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">数据库密码</label><div class="col-sm-10"><input type="text" name="db_pass" class="form-control" placeholder="password"/></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">数据库库名</label><div class="col-sm-10"><div class="input-group"><input type="text" name="db_name" class="form-control" value="forward" placeholder="forward" required/><span class="input-group-addon"><input type="checkbox" name="create_db"/> 新建</span></div></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">数据库端口</label><div class="col-sm-10"><input type="text" name="db_port" class="form-control" value="3306" placeholder="3306" required/></div></div>'.
         '<div class="form-group"><div class="col-sm-2"></div><div class="col-sm-10"><input type="submit" value="保存" class="btn btn-default"/></div></div></fieldset></form>';
  break;
  case 'db_save':
    if(isset($_POST['create_db'])){
      $db = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], null, $_POST['db_port']);
      $db_name = $db->real_escape_string($_POST['db_name']);
      if(!$db->connect_errno && $db->query("CREATE DATABASE `$db_name`")){
        echo '<div class="alert alert-success">数据库创建成功</div>';
        $db->select_db($db_name);
      }else{
        echo '<div class="alert alert-info">数据库创建失败<br/>'.$db->error.'</div>';
      }
    }else{
      $db = new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_name'], $_POST['db_port']);
    }
    
    if($db->connect_errno){
      echo '<div class="alert alert-warning">无法连接至数据库！<br/>错误信息：'.$db->connect_error.'</div>';
    }else{
      $config = file_get_contents('./config.ins');
      $config = str_replace(array('#host#','#user#','#pass#','#name#','#port#','#safe#'),array($_POST['db_host'],$_POST['db_user'],$_POST['db_pass'],$_POST['db_name'],$_POST['db_port'],str_shuffle(md5(time()))),$config);
      if(file_put_contents('../config.php', $config)){
        echo '<div class="alert alert-success">配置文件写入成功<a href="index.php?do=create_table" class="btn btn-xs btn-primary pull-right">下一步：创建数据表</a></div>';
      }else{
        echo '<div class="alert alert-danger">配置文件写入失败</div>';
      }
    }
  break;
  case 'create_table':
    require '../config.php';
    $db = new mysqli($db_conf['host'], $db_conf['user'], $db_conf['pass'], $db_conf['name'], $db_conf['port']);
    $db->connect_errno && die('MySQL Connect Error('.$db->connect_errno.'):'.$db->connect_error);
    foreach(explode(';', file_get_contents('./install.sql')) as $sql){
      if(empty($sql))continue;
      if($db->query($sql)){
        echo '<pre>'.$sql.'</pre>';
      }else{
        echo '<pre>'.$sql.'</pre>';
        echo '<div class="alert alert-info">'.$db->error.'</div>';
        $stoped = true;
      }
    }
    if(isset($stoped)){
      echo '<hr/><div class="alert alert-info">数据导入出错，安装无法继续</div>';
    }else{
      echo '<a href="index.php?do=admin" class="btn btn-default">下一步：设置管理员帐户</a>';
    }
    
  break;
  case 'admin':
    echo '<form action="index.php?do=admin_create" method="post"  class="form-horizontal"><fieldset><legend>设置管理员</legend>'.
         '<div class="form-group"><label class="col-sm-2 control-label">管理员邮箱</label><div class="col-sm-10"><input type="email" name="email" class="form-control" placeholder="admin@ll00.cn" required></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">管理员密码</label><div class="col-sm-10"><input type="text" name="pass" class="form-control" placeholder="password" required></div></div>'.
         '<div class="form-group"><div class="col-sm-2"></div><div class="col-sm-10"><input type="submit" value="设置" class="btn btn-default"/></div></div>'.
         '</form>';
  break;
  case 'admin_create':
    require '../config.php';
    $db = new mysqli($db_conf['host'], $db_conf['user'], $db_conf['pass'], $db_conf['name'], $db_conf['port']);
    if($db->connect_errno){
      echo '<div class="alert alert-warning">无法连接至数据库！<br/>错误信息：'.$db->connect_error.'</div>';
    }else{
      $email = $db->real_escape_string($_POST['email']);
      $pass = md5($_POST['pass']);
      $sql = "INSERT INTO `user` (`id`, `email`, `pass`, `time`, `status`) VALUES (1, '$email', '$pass', UNIX_TIMESTAMP(), 1)";
      if($db->query($sql)){
        echo '<div class="alert alert-success">管理员帐户创建成功</div>';
      }else{
        echo '<div class="alert alert-danger">管理员帐户创建失败<hr/>'.$db->error.'</div>';
        $stoped = true;
      }
      if(isset($stoped)){
        echo '<div class="alert alert-info">管理员帐户创建失败，无法继续</div>';
      }else{
        echo '<a href="index.php?do=smtp_set" class="btn btn-default">下一步：邮件发送设置</a>';
      }
    }
  break;
  case 'smtp_set':
    echo '<form  action="index.php?do=ser" method="post"  class="form-horizontal"><fieldset><legend>邮件发送设置</legend>'.
         '<div class="form-group"><label class="col-sm-2 control-label">SMTP服务器</label><div class="col-sm-10"><input type="text" name="host" class="form-control" placeholder="smtp.qq.com" required></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">SMTP帐户</label><div class="col-sm-10"><input type="text" name="user" class="form-control" placeholder="86849180@qq.com" required></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">SMTP密码</label><div class="col-sm-10"><input type="text" name="pass" class="form-control" placeholder="请输入SMTP帐户密码" required></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">SMTP端口</label><div class="col-sm-10"><input type="text" name="port" class="form-control" placeholder="25" required></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">SMTP SSL</label><div class="col-sm-10"><input type="checkbox" name="ssl"/></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">发送邮箱</label><div class="col-sm-10"><input type="text" name="from" class="form-control" placeholder="86849180@qq.com" required></div></div>'.
         '<div class="form-group"><label class="col-sm-2 control-label">邮箱名称</label><div class="col-sm-10"><input type="text" name="name" class="form-control" placeholder="零零域名" required></div></div>'.
         '<div class="form-group"><div class="col-sm-2"></div><div class="col-sm-10"><input type="submit" value="设置" class="btn btn-default"/></div></div>'.
         '</form>';
  break;
  case 'ser':
    $config = array(
      'register_switch' => '1',
      'home_domain' => array($_SERVER['HTTP_HOST']),
      'domain_add_switch' => '1',
      'domain_add_check' => '1',
      'admin_list' => array('1'),
      'server_list' => array(
        array('CNAME' => $_SERVER['HTTP_HOST'])
      ),
      'smtp' => array(
        'host' => $_POST['host'],
        'user' => $_POST['user'],
        'pass' => $_POST['pass'],
        'port' => $_POST['port'],
        'ssl' => isset($_POST['ssl'])?1:0,
        'from' => $_POST['from'],
        'name' => $_POST['name']
      )
    );
    $config = '<?php exit; ?>'.serialize($config);
    if(file_put_contents('../config.ser.php', $config)){
      echo '<div class="alert alert-success">创建配置文件成功</div>';
    }else{
      echo '<div class="alert alert-danger">创建配置文件失败</div>';
      $stoped = true;
    }
    if(isset($stoped)){
      echo '<div class="alert alert-info">配置文件创建失败，无法继续</div>';
    }else{
      echo '<a href="index.php?do=installed" class="btn btn-default">下一步：完成安装</a>';
    }
  break;
  case 'installed':
    file_put_contents('../version.lock', $version);
    echo '<div class="alert alert-success">程序已安装成功！<a href="../" class="btn btn-xs btn-primary pull-right">点击查看</a></div>';
  break;
  default: ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">欢迎使用域名转发</h3>
      </div>
      <div class="panel-body">
        用户把域名解析至服务器，当访客访问用户的域名时，程序会从数据库中获取域名的转发信息，把访客以用户指定的方式重定向至新地址<br/>
        本程序主要用于解决国内空间需域名备案情况下的域名绑定。<br/>
      </div>
      <div class="panel-footer">
        程序版本：<?php echo $version; ?>&nbsp;<a href="index.php?do=check" class="btn btn-xs btn-primary pull-right">开始安装</a>
      </div>
    </div>
<?php } ?>
  </div>
</body>
</html>