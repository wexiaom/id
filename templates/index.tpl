{assign var="title" value="彩虹域名转发系统"}
{include file="header.tpl"}
  <div class="container text-center" style="margin-top: 50px;">
    <h2>域名URL转发</h2>
    <div class="col-sm-12 text-center" style="margin-top: 50px;">
      <div class="col-sm-2 hidden-xs"></div>
      <div class="col-xs-12 col-sm-8">
      {if isset($_COOKIE['user_id'], $_COOKIE['user_key'])}
        <div class="col-xs-6 center-block" style="float: none;"><a href="./user/" class="btn btn-default btn-block">用户中心</a></div>
      {else}
        <div class="col-xs-6"><a href="./user/login.php" class="btn btn-default btn-block">会员登陆</a></div>
        <div class="col-xs-6"><a href="./register.php" class="btn btn-default btn-block">新人注册</a></div>
      {/if}
      </div>
    </div>
    <br/><br/><br/><br/><br/><br/><br/><br/>
    <div class="rows">
      <div class="col-xs-12 col-sm-6 col-lg-3">
        <h4><span class="glyphicon glyphicon-plane"></span><br/>方便快捷</h4>
        <br/>
        <p>注册即可使用，无需实名认证</p>
      </div>
      <div class="col-xs-12 col-sm-6 col-lg-3">
        <h4><span class="glyphicon glyphicon-random"></span><br/>两种方式</h4>
        <br/>
        <p>提供两种转发方式，显性转发及隐性转发</p>
      </div>
      <div class="col-xs-12 col-sm-6 col-lg-3">
        <h4><span class="glyphicon glyphicon-send"></span><br/>实时生效</h4>
        <br/>
        <p>零等待无烦恼，免除一系列审核</p>
      </div>
      <div class="col-xs-12 col-sm-6 col-lg-3">
        <h4><span class="glyphicon glyphicon-thumbs-up"></span><br/>无需备案</h4>
        <br/>
        <p>没有备案也能玩的转，就是这么爽</p>
      </div>
    </div>
  </div>
  <div class="container text-center" style="margin-top: 50px;">
    <div class="btn-group">
      <a href="http://www.cccyun.cc" class="btn btn-default">彩虹网址导航</a>
      <a href="http://www.qqzzz.net" class="btn btn-default">彩虹云任务</a>
      <a href="http://blog.cccyun.cc" class="btn btn-default">缤纷彩虹天地</a>
      <a href="http://tool.cccyun.cc" class="btn btn-default">彩虹工具网</a>
      <a href="http://www.tbsign.cc" class="btn btn-default">贴吧签到助手</a>
    </div>
  </div>
  <footer class="container text-center" style="margin-top: 50px;">&copy; 彩虹</footer>
<style>
  body {
    background-image: url("https://o6yu884iy.qnssl.com/background.png");
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    -moz-background-size: cover;
    -webkit-background-size: cover;
    padding-top: 0;
    color: #fff;
  }
  h4 {
    font-size: 20px;
    color: rgba(255, 254, 254, 0.9);
  }
  p {
    font-size: 17px;
  }
  .glyphicon {
    font-size: 40px;
  }

  .btn-default {
    color: #fff;
    background-color: rgba(19, 56, 74, 0.5);
    border-color: rgba(204, 204, 204, 0.5);
  }
  .btn-default:hover {
    color: #fff;
    background-color: rgba(19, 56, 74, 0.6);
    border-color: rgba(204, 204, 204, 0.6);
  }
</style>

</body>
</html>