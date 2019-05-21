{assign var="title" value="用户资料编辑"}
{include file="header.tpl"}
{include file="admin_nav.tpl"}
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./">用户中心</a></li>
      <li><a href="./user-list.php">用户列表</a>
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
      {elseif $result['status'] == '2'}
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
    {if isset($Res)}
      <form action="{$smarty.server.PHP_SELF}?id={$smarty.get.id}" method="post" class="form-horizontal" role="form">
        <div class="form-group">
          <label class="col-sm-2 control-label">邮箱</label>
          <div class="col-sm-10">
            <input type="email" name="email" value="{$Res['email']}" class="form-control" placeholder="请输入用户的新邮箱地址"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">密码</label>
          <div class="col-sm-10">
            <input type="text" name="password" value="" class="form-control" placeholder="留空则不修改密码"/>
          </div>
        </div>
        <div class="form-group">
          <label for="type" class="col-sm-2 control-label">状态</label>
          <div class="col-sm-10">
            <select name="status" class="form-control">
              <option value="0"{if $Res['status']=='0'} selected="selected"{/if}>待激活</option>
              <option value="1"{if $Res['status']=='1'} selected="selected"{/if}>正常</option>
              <option value="2"{if $Res['status']=='2'} selected="selected"{/if}>封禁</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-2"></div>
          <div class="col-sm-10">
            <input type="submit" value="修改" class="btn btn-default"/>
          </div>
        </div>
      </form>
    {/if}
    </div>
    <div class="col-xs-12 col-sm-4">
      <b>提示：</b><br/>输入框留空则表示该项保留为原来的值，不会被更改
    </div>
  </div>
{include file="footer.tpl"}