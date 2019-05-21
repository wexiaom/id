{assign var="title" value="域名详情"}
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
  {if isset($result)}
    <div class="alert alert-info">
      <button type="button" onclick="location.href=document.referrer" class="pull-right btn btn-xs btn-primary">返回</button>
      {$result['msg']}
    </div>
  {else}
    <div class="col-xs-12 col-sm-8">
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label">域名</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input type="text" value="{$Res['domain']}" class="form-control" id="domain">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="window.open('http://'+document.getElementById('domain').value)">Go!</button>
              </span>
            </div>
          </div>
        </div>
        {if $Res['mode']=='0' || $Res['mode']=='1'}
        <div class="form-group">
          <label class="col-sm-2 control-label">目标地址</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input type="text" value="{$Res['url']}" class="form-control" id="url">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="window.open('http://'+document.getElementById('url').value)">Go!</button>
              </span>
            </div>
          </div>
        </div>
        {/if}
        <div class="form-group">
          <label class="col-sm-2 control-label">类型</label>
          <div class="col-sm-10">
            <select name="mode" id="mode" class="form-control">
                <option value="0">显性转发</option>
                <option value="1"{if $Res['mode']=='1'} selected="selected"{/if}>隐性转发</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">编号</label>
          <div class="col-sm-10">
            <input type="text" value="{$Res['id']}" class="form-control">
          </div>
        </div>
        {if $Res['mode']=='1'}
        <div class="form-group">
          <label class="col-sm-2 control-label">标题</label>
          <div class="col-sm-10">
            <input type="text" value="{$Res['title']}" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">关键字</label>
          <div class="col-sm-10">
            <input type="text" value="{$Res['keywords']}" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">页面描述</label>
          <div class="col-sm-10">
            <input type="text" value="{$Res['description']}" class="form-control">
          </div>
        </div>
        {/if}
        <div class="form-group">
          <label class="col-sm-2 control-label">添加时间</label>
          <div class="col-sm-10">
            <input type="text" value="{$Res['time']}" class="form-control">
          </div>
        </div>
      </form>
    </div>
    <div class="col-xs-12 col-sm-4">
      <b>显性转发</b><br/>
      当访客访问您的域名时，直接跳转至您所指定的网址<hr/>
      <b>隐性转发</b><br/>
      当访客访问您的域名时，会显示您所指定的网址的内容，并且地址栏的网址不会发生变化
    </div>
  {/if}
  </div>
{include file="footer.tpl"}