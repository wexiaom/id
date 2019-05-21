{assign var="title" value="管理后台"}
{include file="header.tpl"}
{include file="admin_nav.tpl"}
  <div class="container">
    <div class="col-xs-12 col-sm-3 hidden-xs">
      <div class="list-group">
        <div class="list-group-item active">功能菜单</div>
        <a href="./user-list.php" class="list-group-item">用户列表</a>
        <a href="./forward-list.php" class="list-group-item">域名转发列表</a>
        <a href="./config-ser.php" class="list-group-item">网站配置</a>
        <a href="../user/" class="list-group-item">返回前台</a>
      </div>
    </div>
    <div class="col-xs-12 col-sm-9">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">统计信息</h3></div>
        <ul class="list-group">
          <li class="list-group-item"><span class="glyphicon glyphicon-user"></span> <b>用户数量：</b> {$user_num}个</li>
          <li class="list-group-item"><span class="glyphicon glyphicon-cloud"></span> <b>域名数量：</b> {$domain_num}个</li>
        </ul>
      </div>
    </div>
  </div>
{include file="footer.tpl"}