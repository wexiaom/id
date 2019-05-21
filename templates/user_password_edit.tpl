{assign var="title" value="密码修改"}
{include file="header.tpl"}
{include file="user_nav.tpl"}
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./">用户中心</a></li>
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
          <label class="col-sm-2 control-label">帐户</label>
          <div class="col-sm-10">
            <input type="text" id="email" value="{$user['email']}" class="form-control" disabled="disabled"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">新密码</label>
          <div class="col-sm-10">
            <input type="password" name="new_pass" id="new_pass" value="" class="form-control" placeholder="请输入新密码"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">确认密码</label>
          <div class="col-sm-10">
            <input type="password" name="new_password" id="new_password" value="" class="form-control" placeholder="请再次输入新密码"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">当前密码</label>
          <div class="col-sm-10">
            <input type="password" name="password" id="password" value="" class="form-control" placeholder="请输入当前密码"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-2"></div>
          <div class="col-sm-10">
            <input type="submit" class="btn btn-default" value="修改"/>
          </div>
        </div>
      </form>
    </div>
    <div class="col-xs-12 col-sm-4">
      <b>温磬提示</b><br/>
      为了您的帐户安全，请不要设置过于简单的密码。<br/>
      密码修改后，请牢记您的新密码。<br/>
      如果您忘了您的当前密码，请通过找回密码或联系管理员的方式重置您的密码
    </div>
  </div>
{include file="footer.tpl"}