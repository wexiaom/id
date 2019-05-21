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
      {else}
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {$result['msg']}
      </div>
      {/if}
    {/if}
      <form action="{$smarty.server.PHP_SELF}" method="post" class="form-horizontal" role="form">
        <div class="form-group">
          <label for="domain" class="col-sm-2 control-label">域名</label>
          <div class="col-sm-10">
            <input type="text" name="domain" id="domain" value="{if isset($smarty.post.domain)}{$smarty.post.domain}{/if}" class="form-control" placeholder="如：forward.ll00.cn"/>
          </div>
        </div>
        <div class="form-group">
          <label for="type" class="col-sm-2 control-label">类型</label>
          <div class="col-sm-10">
            <select name="mode" id="mode" class="form-control">
                <option value="0"{if isset($smarty.post.mode)&&$smarty.post.mode=='0'} selected="selected"{/if}>显性转发</option>
                <option value="1"{if isset($smarty.post.mode)&&$smarty.post.mode=='1'} selected="selected"{/if}>隐性转发</option>
                <option value="2"{if isset($smarty.post.mode)&&$smarty.post.mode=='2'} selected="selected"{/if} disabled="disabled">页面停放</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="url" class="col-sm-2 control-label">目标地址</label>
          <div class="col-sm-10">
            <input type="url" name="url" id="url" value="{if isset($smarty.post.url)}{$smarty.post.url}{/if}" class="form-control" placeholder="如：http://www.cccyun.cn"/>
          </div>
        </div>
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">页面标题</label>
          <div class="col-sm-10">
            <input type="text" name="title" id="title" value="{if isset($smarty.post.title)}{$smarty.post.title}{/if}" class="form-control" placeholder="如：彩虹网址导航"/>
          </div>
        </div>
        <div class="form-group">
          <label for="keywords" class="col-sm-2 control-label">关键字</label>
          <div class="col-sm-10">
            <input type="text" name="keywords" id="keywords" value="{if isset($smarty.post.keywords)}{$smarty.post.keywords}{/if}" class="form-control" placeholder="如：WAP网址,在线工具,网址大全"/>
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-sm-2 control-label">页面描述</label>
          <div class="col-sm-10">
            <input type="text" name="description" id="description" value="{if isset($smarty.post.description)}{$smarty.post.description}{/if}" class="form-control" placeholder="如：彩虹网址导航是一个综合性网址导航，为所有访客提供快捷方面的..."/>
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
            <input type="submit" class="btn btn-default" value="添加"/>
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
    </div>
    <div class="col-xs-12 col-sm-4">
      <div class="panel panel-default">
        <div class="panel-body">
          <p><span class="glyphicon glyphicon-info-sign"></span> 使用前，请先把域名解析以下服务器中的任意一个服务器！</p>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>记录类型</th>
                <th>记录值</th>
              </tr>
            </thead>
            <tbody>
          {foreach $CONFIG['server_list'] as $server}
            {foreach $server as $list}
              <tr>
                <td>{$list@key}</td>
                <td>{$list}</td>
              </tr>
            {/foreach}
          {/foreach}
            </tbody>
          </table><hr/>
	  <b>显性转发</b><br/>
      当访客访问您的域名时，直接跳转至您所指定的网址<hr/>
      <b>隐性转发</b><br/>
      当访客访问您的域名时，会显示您所指定的网址的内容，并且地址栏的网址不会发生变化
        </div>
      </div>
    </div>
  </div>
{include file="footer.tpl"}