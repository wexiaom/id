
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">{if isset($title)}{$title}{else}域名转发系统{/if}</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
          <li><a href="/user/"><span class="glyphicon glyphicon-log-in"></span> 登陆</a></li>
          <li><a href="/register.php"><span class="glyphicon glyphicon-registration-mark"></span> 注册</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->