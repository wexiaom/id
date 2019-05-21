{assign var="title" value="用户中心"}
{include file="header.tpl"}
{include file="user_nav.tpl"}
  <div class="container">
    <div class="col-xs-12 col-sm-3 hidden-xs">
      <div class="list-group">
        <div class="list-group-item active">功能菜单</div>
        <a href="./forward-list.php" class="list-group-item">转发域名列表</a>
        <a href="./forward-add.php" class="list-group-item">添加域名转发</a>
        <a href="./password-edit.php" class="list-group-item">修改密码</a>
        <a href="#./user-email.php" class="list-group-item" onclick="alert('暂时无法使用')">更换邮箱</a>
        {if isset($user['admin'])}
        <a href="../admin/" class="list-group-item">管理员后台</a>
        {/if}
      </div>
    </div>
    <div class="col-xs-12 col-sm-9">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">用户信息</h3>
        </div>
        <ul class="list-group">
          <li class="list-group-item"><span class="glyphicon glyphicon-envelope"></span> <b>帐户邮箱：</b> {$user['email']}</li>
          <li class="list-group-item"><span class="glyphicon glyphicon-user"></span> <b>帐户ＩＤ：</b> {$user['id']}</li>
          <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>注册时间：</b> {$user['time']}</li>
          <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>用户状态：</b> {$user['status_text']}</li>
          <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>拥有域名：</b> {$forward->num_rows}个</li>
        </ul>
      </div>
    </div>
  </div>
{include file="footer.tpl"}