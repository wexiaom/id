{assign var="title" value="域名列表"}
{include file="header.tpl"}
{include file="user_nav.tpl"}
  <div class="container">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索域名</h4>
      </div>
      <div class="modal-body">
      <form action="forward-list.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入域名"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <ol class="breadcrumb">
      <li><a href="./">用户中心</a></li>
      <li>{$title}</li>
    </ol>
  </div>
  <div class="container">
    {if isset($result)}
    <div class="alert alert-info">{$result['msg']}</div>
    {else}
    <a href="./forward-add.php" class="btn btn-success btn-sm">添加域名</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-info btn-sm">搜索</a>
    <div class="col-sm-12 table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>域名</th><th>转发方式</th><th>添加时间</th>{if $config['audit']==1}<th>状态</th>{/if}<th>操作</th>
          </tr>
        </thead>
        <tbody>
        {foreach $rows as $row}
          <tr>
            <td><a href="http://{$row['domain']}" target="_blank" title="点击打开">{$row['domain']}</a></td>
            <td>{$row['mode']}</td>
            <td>{$row['time']}</td>
	    {if $config['audit']==1}<td>{if $row['status']==1}<font color="green">正常</font>{else}<font color="red">待审</font>{/if}</td>{/if}
            <td>
              <a href="./forward-info.php?id={$row['id']}" class="btn btn-xs btn-info">详情</a>
              <a href="./forward-edit.php?id={$row['id']}" class="btn btn-xs btn-primary">编辑</a>
              <a href="javascript:delete_confirm('{$row['id']}')" class="btn btn-xs btn-danger">删除</a>
            </td>
          </tr>
        {/foreach}
        </tbody>
      </table>
      {literal}<script>
        function delete_confirm(id){
          var del = confirm("你确定要删除该域名吗？");
          if(del == true){
            window.open("./forward-delete.php?id="+id);
          }
        }
      </script>{/literal}
    </div>
{if $config['audit']==1}添加后工作人员将在24小时之内尽快完成审核，审核之后即可使用！{/if}
    <div class="text-center">
      <ul class="pagination">
      {if $page['no']-1 >= 1}
        <li><a href="forward-list.php?page={$page['no']-1}">&laquo;</a></li>
      {else}
        <li class="disabled"><a href="#">&laquo;</a></li>
      {/if}
      {assign var="i" value=1}
      {section name="page" loop=$page['no']-1}
        <li><a href="forward-list.php?page={$i}">{$i}</a></li>
	{$i=$i+1}
      {/section}
        <li class="active"><a href="#">{$page['no']}</a></li>
      {$i=$page['no']+1}
      {section name="page" loop=$page['pages']-$page['no']}
        <li><a href="forward-list.php?page={$i}">{$i}</a></li>
	{$i=$i+1}
      {/section}
      {if $page['no']+1 <= $page['pages']}
        <li><a href="forward-list.php?page={$page['no']+1}">&raquo;</a></li>
      {else}
        <li class="disabled"><a href="#">&raquo;</a></li>
      {/if}
      </ul>
    </div>
    {/if}
  </div>
{include file="footer.tpl"}