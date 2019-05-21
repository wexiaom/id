{assign var="title" value="删除用户"}
{include file="header.tpl"}
{include file="admin_nav.tpl"}
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./">管理后台</a></li>
      <li><a href="./user-list.php">用户列表</a>
      <li>{$title}</li>
    </ol>
  </div>
  <div class="container">
  {if $result['status'] == '0'}
    <div class="alert alert-warning">
      <button type="button" onclick="window.close()" class="pull-right btn btn-xs btn-primary">关闭</button>
      {$result['msg']}
    </div>
  {else}
    <div class="alert alert-success">
      <button type="button" onclick="window.close()" class="pull-right btn btn-xs btn-primary">关闭</button>
      {$result['msg']}
    </div>
  {/if}
  </div>
{include file="footer.tpl"}