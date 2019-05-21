{assign var="title" value="网站配置"}
{include file="header.tpl"}
{include file="admin_nav.tpl"}
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./">管理首页</a></li>
      <li>{$title}</li>
    </ol>
  </div>
  <div class="container">
    <div class="col-xs-12 col-sm-8">
    {if isset($result)}
      {if $result['status'] == '0'}
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {$result['msg']}
      </div>
      {else}
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {$result['msg']}
      </div>
      {/if}
    {/if}
      <form action="{$smarty.server.PHP_SELF}" method="post" class="form-horizontal" role="form">
        <div class="form-group">
          <label for="register_switch" class="col-sm-2 control-label">用户注册</label>
          <div class="col-sm-10">
            <select name="register_switch" id="register_switch" class="form-control">
              <option value="0">禁止新用户注册</option>
              <option value="1"{if $SER['register_switch']=='1'} selected="selected"{/if}>开启新用户注册</option>
              <option value="2"{if $SER['register_switch']=='2'} selected="selected"{/if} disabled="disabled">通过邀请码注册</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="home_domain" class="col-sm-2 control-label">主站域名</label>
          <div class="col-sm-10">
            <input type="text" name="home_domain" id="home_domain" value="{$SER['home_domain']}" class="form-control" placeholder="forward.ll00.cn,home.ll00.cn"/>
          </div>
        </div>
        <div class="form-group">
          <label for="server_list" class="col-sm-2 control-label">解析方式</label>
          <div class="col-sm-10">
            <textarea name="server_list" id="server_list" rows="2" class="form-control" placeholder="CNAME:forward.ll00.cn">{$SER['server_list']}</textarea>
          </div>
        </div>
	<div class="form-group">
          <label for="domain_add_switch" class="col-sm-2 control-label">域名审核模式</label>
          <div class="col-sm-10">
            <select name="audit" id="audit" class="form-control">
              <option value="0">关闭</option>
              <option value="1"{if $SER['audit']} selected="selected"{/if}>开启</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="domain_add_switch" class="col-sm-2 control-label">域名添加</label>
          <div class="col-sm-10">
            <select name="domain_add_switch" id="domain_add_switch" class="form-control">
              <option value="0">关闭</option>
              <option value="1"{if $SER['domain_add_switch']} selected="selected"{/if}>开启</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="domain_add_check" class="col-sm-2 control-label">解析检测</label>
          <div class="col-sm-10">
            <select name="domain_add_check" id="domain_add_check" class="form-control">
              <option value="0">关闭</option>
              <option value="1"{if $SER['domain_add_check']=='1'} selected="selected"{/if}>开启</option>
            </select>
          </div>
        </div>
	<div class="form-group">
          <label for="domain_add_check" class="col-sm-2 control-label">反腾讯检测</label>
          <div class="col-sm-10">
            <select name="txprotect" id="txprotect" class="form-control">
              <option value="0">关闭</option>
              <option value="1"{if $SER['txprotect']=='1'} selected="selected"{/if}>开启</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="admin_list" class="col-sm-2 control-label">管理员ID</label>
          <div class="col-sm-10">
            <input type="text" name="admin_list" id="admin_list" value="{$SER['admin_list']}" class="form-control" placeholder="2,8,9"/>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_type" class="col-sm-2 control-label">邮件发送</label>
          <div class="col-sm-10">
            <select name="smtp[type]" id="smtp_type" class="form-control">
              <option value="0">关闭邮件发送</option>
              <option value="1"{if $SER['smtp']['type']=='1'} selected="selected"{/if}>通过PHPMailer发送</option>
              <option value="1"{if $SER['smtp']['type']=='2'} selected="selected"{/if}>通过PHP mail()发送</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_host" class="col-sm-2 control-label">SMTP服务器</label>
          <div class="col-sm-10">
            <input type="text" name="smtp[host]" id="smtp_host" value="{$SER['smtp']['host']}" class="form-control" placeholder="smtp.qq.com"/>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_user" class="col-sm-2 control-label">SMTP帐户</label>
          <div class="col-sm-10">
            <input type="text" name="smtp[user]" id="smtp_user" value="{$SER['smtp']['user']}" class="form-control" placeholder="86849180"/>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_pass" class="col-sm-2 control-label">SMTP密码</label>
          <div class="col-sm-10">
            <input type="text" name="smtp[pass]" id="smtp_pass" value="{$SER['smtp']['pass']}" class="form-control" placeholder="请输入SMTP密码"/>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_port" class="col-sm-2 control-label">SMTP端口</label>
          <div class="col-sm-10">
            <input type="text" name="smtp[port]" id="smtp_port" value="{$SER['smtp']['port']}" class="form-control" placeholder="25"/>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_ssl" class="col-sm-2 control-label">SMTP安全</label>
          <div class="col-sm-10">
            <select name="smtp[ssl]" id="smtp_ssl" class="form-control">
              <option value="0">关闭</option>
              <option value="1"{if $SER['smtp']['ssl']=='1'} selected="selected"{/if}>SSL加密</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_from" class="col-sm-2 control-label">发送邮箱</label>
          <div class="col-sm-10">
            <input type="text" name="smtp[from]" id="smtp_from" value="{$SER['smtp']['from']}" class="form-control" placeholder="86849180@qq.com"/>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_name" class="col-sm-2 control-label">邮箱名称</label>
          <div class="col-sm-10">
            <input type="text" name="smtp[name]" id="smtp_name" value="{$SER['smtp']['name']}" class="form-control" placeholder="零零域名"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-2"></div>
          <div class="col-sm-10">
            <input type="submit" class="btn btn-default" value="更新配置"/>
          </div>
        </div>
      </form>
    </div>
    <div class="col-xs-12 col-sm-4">
    <b>主站域名</b><br/>
    即网站的域名，添加后可避免被系统识别为跳转的域名。<hr/>
    <b>解析方式</b><br/>
    让用户添加域名时对域名进行解析的解析方式<hr/>
    <b>解析检测</b><br/>
    用户添加域名时，是否检测域名是否已解析至服务器<hr/>
    <b>域名审核模式</b><br/>
    用户添加域名后，管理员需要到后台审核后才能正常访问<hr/>
    <b>反腾讯检测</b><br/>
    反腾讯网址安全监测，通过对IP段和header特征的拦截，可以屏蔽腾讯管家网址安全检测系统访问，可防举报。
    </div>
  </div>
{include file="footer.tpl"}