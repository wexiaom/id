{assign var="title" value="添加域名"}
{include file="header.tpl"}
{include file="user_nav.tpl"}
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./">用户中心</a></li>
      <li><a href="./forward-list.php">我的域名</a>
      <li>{$title}</li>
    </ol>
  </div>
  <div class="container">
    <div class="col-xs-12 col-sm-8">
    {if isset($result)}
      {if $result['status'] == '0'}
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {$result['msg']}
      </div>
      {elseif $result['status'] == '2'}
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {$result['msg']}
      </div>
      {else}
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {$result['msg']}
      </div>
      {/if}
    {/if}
    {if isset($Res)}
      <form action="{$smarty.server.PHP_SELF}?id={$smarty.get.id}" method="post" class="form-horizontal" role="form">
        <div class="form-group">
          <label class="col-sm-2 control-label">域名</label>
          <div class="col-sm-10">
            <input type="text" id="domain" value="{$Res['domain']}" class="form-control" disabled="disabled"/>
          </div>
        </div>
        <div class="form-group">
          <label for="type" class="col-sm-2 control-label">类型</label>
          <div class="col-sm-10">
            <select name="mode" id="mode" class="form-control">
                <option value="0"{if $Res['mode']=='0'} selected="selected"{/if}>显性转发</option>
                <option value="1"{if $Res['mode']=='1'} selected="selected"{/if}>隐性转发</option>
                <option value="2"{if $Res['mode']=='2'} selected="selected"{/if} disabled="disabled">页面停放</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="url" class="col-sm-2 control-label">目标地址</label>
          <div class="col-sm-10">
            <input type="url" name="url" id="url" value="{$Res['url']}" class="form-control" placeholder="如：http://www.ll00.cn"/>
          </div>
        </div>
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">页面标题</label>
          <div class="col-sm-10">
            <input type="text" name="title" id="title" value="{$Res['title']}" class="form-control" placeholder="如：零零工具站"/>
          </div>
        </div>
        <div class="form-group">
          <label for="keywords" class="col-sm-2 control-label">关键字</label>
          <div class="col-sm-10">
            <input type="text" name="keywords" id="keywords" value="{$Res['keywords']}" class="form-control" placeholder="如：在线工具,网站工具,站长工具"/>
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-sm-2 control-label">页面描述</label>
          <div class="col-sm-10">
            <input type="text" name="description" id="description" value="{$Res['description']}" class="form-control" placeholder="如：零零工具站是一个在线工具站，为所有访客提供快捷方面的..."/>
          </div>
        </div>
        <div class="form-group">
          <label for="park" class="col-sm-2 control-label">停放页面</label>
          <div class="col-sm-10">
            <select name="park" id="park" class="form-control">
                <option value="default.html">默认页面</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-2"></div>
          <div class="col-sm-10">
            <input type="submit" class="btn btn-default" value="更改"/>
          </div>
        </div>
      </form>
      {literal}<script>
        $("select#mode").change(function(){
          switch($("select#mode").val()){
            case '0':
              $("input#url").parent().parent().show(800);
              $("input#title").parent().parent().hide(800);
              $("input#keywords").parent().parent().hide(800);
              $("input#description").parent().parent().hide(800);
              $("select#park").parent().parent().hide(800);
            break;
            case '1':
              $("input#url").parent().parent().show(800);
              $("input#title").parent().parent().show(800);
              $("input#keywords").parent().parent().show(800);
              $("input#description").parent().parent().show(800);
              $("select#park").parent().parent().hide(800);
            break;
            case '2':
              $("input#url").parent().parent().hide(800);
              $("input#title").parent().parent().hide(800);
              $("input#keywords").parent().parent().hide(800);
              $("input#description").parent().parent().hide(800);
              $("select#park").parent().parent().show(800);
            break;
          }
        });
        switch($("select#mode").val()){
          case '0':
            $("input#url").parent().parent().show(800);
            $("input#title").parent().parent().hide(800);
            $("input#keywords").parent().parent().hide(800);
            $("input#description").parent().parent().hide(800);
            $("select#park").parent().parent().hide(800);
          break;
          case '1':
            $("input#url").parent().parent().show(800);
            $("input#title").parent().parent().show(800);
            $("input#keywords").parent().parent().show(800);
            $("input#description").parent().parent().show(800);
            $("select#park").parent().parent().hide(800);
          break;
          case '2':
            $("input#url").parent().parent().hide(800);
            $("input#title").parent().parent().hide(800);
            $("input#keywords").parent().parent().hide(800);
            $("input#description").parent().parent().hide(800);
            $("select#park").parent().parent().show(800);
          break;
        }
      </script>{/literal}
      {/if}
    </div>
    <div class="col-xs-12 col-sm-4">
      <b>显性转发</b><br/>
      当访客访问您的域名时，直接跳转至您所指定的网址<hr/>
      <b>隐性转发</b><br/>
      当访客访问您的域名时，会显示您所指定的网址的内容，并且地址栏的网址不会发生变化
    </div>
  </div>
{include file="footer.tpl"}