{assign var="title" value="用户注册"}
{include file="header.tpl"}
{include file="nav.tpl"}
  <div class="container">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    {if isset($result)}
      {if $result['status'] == 0}
      <div class="alert alert-warning">
        <button type="button" onclick="location=location" class="pull-right btn btn-xs btn-primary">返回注册</button>
        {$result['msg']}
      </div>
      {else}
      <div class="alert alert-success">
        <button type="button" onclick="location='./user'" class="pull-right btn btn-xs btn-primary">马上登陆</button>
        {$result['msg']}
      </div>
      {/if}
      {if isset($result['mail'])}
      <div class="alert alert-info">
        {$result['mail']['msg']}
      </div>
      {/if}
    {else}
    <form action="{$smarty.server.PHP_SELF}" method="post" class="form-horizontal" role="form">
	  <div class="form-group">
        <label for="email" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-10">
          <input type="email" name="email" id="email" class="form-control" placeholder="登陆邮箱"/>
        </div>
      </div>
      <div class="form-group">
        <label for="cookie" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
          <input type="password" name="pass" id="pass" class="form-control" placeholder="登陆密码"/>
        </div>
      </div>
      <div class="form-group">
        <label for="captcha" class="col-sm-2 control-label">验证码</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" name="captcha" id="captcha" class="form-control" placeholder="请输入验证码"/>
            <span class="input-group-addon" style="padding:0;"><img title="点击刷新" src="./captcha.php" onclick="this.src='./captcha.php?'+Math.random();" alt="验证码"/></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
          <input type="submit" class="btn btn-default" id="submit" value="立即注册"/>
          <input type="submit" class="btn btn-info" formaction="./user/mail-active.php" id="resend" value="重发注册邮件"/>
        </div>
      </div>
    </form>
    {literal}<script>
      $("#email").change(function(){
        var rxp = new RegExp(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/);
        if(rxp.test($("#email").val())){
          $("#email").parent().parent().attr("class","form-group has-success");
        }else{
          $("#email").parent().parent().attr("class","form-group has-error");
        }
      });
      $("#pass").change(function(){
        var pwl = $("#pass").val().length;
        if(pwl>5 && pwl<16){
          $("#pass").parent().parent().attr("class","form-group has-success");
        }else{
          $("#pass").parent().parent().attr("class","form-group has-error");
        }
      });
      $("#captcha").change(function(){
        if($("#captcha").val().length!=5){
          $("#captcha").parent().parent().parent().attr("class","form-group has-error");
        }
      });
    </script>{/literal}
    {/if}
    </div>
  </div>
{include file="footer.tpl"}