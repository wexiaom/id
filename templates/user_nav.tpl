
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">{$title}</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> 我的信息<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./">用户中心</a></li>
              <li><a href="./password-edit.php">修改密码</a></li>
            </ul>
          </li>
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cloud"></span> 我的域名<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./forward-list.php">域名列表</a></li>
              <li><a href="./forward-add.php">添加域名</a><li>
            </ul>
          </li>
	  {if isset($user['admin'])}
	  <li><a href="../admin/"><span class="glyphicon glyphicon-cog"></span> 后台管理</a></li>
	  {/if}
          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-log-out"></span> 退出登陆</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->