{assign var="title" value="用户详情信息"}
{include file="header.tpl"}
{include file="admin_nav.tpl"}
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./">管理后台</a></li>
      <li><a href="./user-list.php">用户列表</a></li>
      <li>{$title}</li>
    </ol>
  </div>
  <div class="container">
  {if isset($result)}
    <div class="alert alert-info">{$result['msg']}</div>
  {else}
    <div class="table-responsive">
      <table class="table table-striped">
        <tbody>
          <tr><th>ID</th><td>{$Res['id']}</td></tr>
          <tr><th>邮箱</th><td>{$Res['email']}</td></tr>
          <tr><th>注册时间</th><td>{$Res['time']}</td></tr>
          <tr><th>帐户状态</th><td>{$Res['status']}</td></tr>
        </tbody>
      </table>
    </div>
  {/if}
  </div>
{include file="footer.tpl"}