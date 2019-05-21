<?php
/**
 * 网站配置编辑
**/
require '../user/check_login.php';
if(isset($USER['admin'])){
  $config_ser = $config;
  if(isset($_POST['home_domain'])){
    $config_ser['register_switch'] = $_POST['register_switch'];
    $config_ser['home_domain'] = empty($_POST['home_domain']) ? $config['home_domain'] : explode(',', $_POST['home_domain']);
    $config_ser['audit'] = $_POST['audit'];
	$config_ser['domain_add_switch'] = $_POST['domain_add_switch'];
    $config_ser['domain_add_check'] = $_POST['domain_add_check'];
	$config_ser['txprotect'] = $_POST['txprotect'];
    $config_ser['admin_list'] = empty($_POST['admin_list']) ? $config['admin_list'] : explode(',', $_POST['admin_list']);
    $config_ser['smtp'] = $_POST['smtp'];
    $config_ser['smtp']['pass'] = empty($_POST['smtp']['pass']) ? $config['smtp']['pass'] : $_POST['smtp']['pass'];
	$config_ser['smtp']['ssl'] = $_POST['smtp']['ssl'];
    if(!empty($_POST['server_list'])){
      $config_ser['server_list'] = array();
      foreach(explode("\r", str_replace(array("\r\n","\n"),"\r",$_POST['server_list'])) as $PSLS){
        if(empty($PSLS)) continue;
        $PSL = explode(':', $PSLS);
        $config_ser['server_list'][] = array($PSL[0] => $PSL[1]);
      }
    }
    if(file_put_contents(ROOT.'/config.ser.php', '<?php exit; ?>'.serialize($config_ser))){
      $result = array(
        'status' => '1',
        'msg' => '保存成功'
      );
    }else{
      $result = array(
        'status' => '0',
        'msg' => '保存失败'
      );
    }
    $SM->assign('result', $result);
  }
  $config_ser['home_domain'] = implode(',',$config_ser['home_domain']);
  $config_ser['admin_list'] = implode(',',$config_ser['admin_list']);
  $SL = '';
  foreach($config_ser['server_list'] as $Server_List){
    foreach($Server_List as $SL_key=>$SL_val){
      $SL .= $SL_key.':'.$SL_val."\n";
    }
  }
  $config_ser['server_list'] = $SL;
  $SM->assign('SER', $config_ser);
}else{
  header("Location: ../user/");
  exit;
}
$SM->display('admin_config_ser.tpl');
