{assign var="title" value="密码重置"}
{include file="header.tpl"}
{include file="nav.tpl"}
  <div class="container">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    {if isset($result)}
      {if $result['status'] == 0}
      <div class="alert alert-warning">
        {$result['msg']}
      </div>
      {else}
      <div class="alert alert-success">
        {$result['msg']}
      </div>
      {/if}
      {if isset($result['mail'])}
      <div class="alert alert-info">
        {$result['mail']['msg']}
      </div>
      {/if}
    {/if}
    <form action="{$smarty.server.PHP_SELF}" method="post" class="form-horizontal" role="form">
	  <div class="form-group">
        <label for="email" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-10">
          <input type="email" name="email" id="email" value="{if isset($smarty.post.email)}{$smarty.post.email|escape}{/if}" class="form-control" placeholder="登陆邮箱"/>
        </div>
      </div>
      <div class="form-group">
        <label for="captcha" class="col-sm-2 control-label">验证码</label>
        <div class="col-sm-10">
          <div class="input-group">
            <input type="text" name="captcha" id="captcha" class="form-control" placeholder="请输入验证码"/>
            <span class="input-group-addon" style="padding:0;"><img src="../captcha.php" alt="验证码"/></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
          <input type="submit" class="btn btn-default" id="submit" value="申请重置"/>
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
    </div>
  </div>
{include file="footer.tpl"}