{assign var="title" value="删除域名"}
{include file="header.tpl"}
{include file="admin_nav.tpl"}
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./">管理后台</a></li>
      <li><a href="./forward-list.php">域名转发列表</a>
      <li>{$title}</li>
    </ol>
  </div>
  <div class="container">
  {if $result['status'] == '0'}
    <div class="alert alert-warning">
      <button type="button" onclick="location.href=document.referrer" class="pull-right btn btn-xs btn-primary">返回</button>
      {$result['msg']}
    </div>
  {else}
    <div class="alert alert-success">
      <button type="button" onclick="location.href=document.referrer" class="pull-right btn btn-xs btn-primary">返回</button>
      {$result['msg']}
    </div>
  {/if}
  </div>
{include file="footer.tpl"}