{assign var="title" value="用户登陆"}
{include file="header.tpl"}
{include file="nav.tpl"}
  <div class="container">
    <div class="col-xs-12 col-sm-8 col-lg-6 center-block" style="float: none;">
    {if isset($result)}
      {if $result['status'] == 0}
	  <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {$result['msg']}
      </div>
      {else}
      <script>
        /* 登陆成功跳转至用户中心 */
        location.href = "./";
      </script>
	  <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {$result['msg']}
      </div>
      {/if}
    {/if}
    {if isset($smarty.get.msg)}
      <div class="alert alert-info">{$smarty.get.msg|escape:'htmlall'}</div>
    {/if}
      <form class="form-login" action="{$smarty.server.SCRIPT_NAME}" method="post">
        <fieldset>
          <legend>登陆</legend>
          <div class="form-group">
            <label for="email" class="sr-only">登陆帐户</label>
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="email" name="email" id="email" class="form-control" value="" placeholder="请输入登陆帐户"/>
            </div>
          </div>
          <div class="form-group">
            <label for="pass" class="sr-only">登陆密码</label>
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" name="pass" id="pass" class="form-control" value="" placeholder="请输入登陆密码"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-6">
              <input type="submit" class="btn btn-primary form-control" value="登陆"/>
            </div>
            <div class="col-xs-6">
              <a class="btn btn-info form-control" href="./password-reset.php">重置密码</a>
            </div>
          </div>
        </fieldset>
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
      </script>{/literal}
    </div>
  </div>
{include file="footer.tpl"}