{assign var="title" value="用户列表"}
{include file="header.tpl"}
{include file="admin_nav.tpl"}
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="./">管理后台</a></li>
      <li>{$title}</li>
    </ol>
  </div>
  <div class="container">
    {if isset($result)}
    <div class="alert alert-info">{$result['msg']}</div>
    {else}
    <div class="col-sm-12 table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th><th>邮箱</th><th>注册时间</th><th>状态</th><th>操作</th>
          </tr>
        </thead>
        <tbody>
        {foreach $rows as $row}
          <tr>
            <td>{$row['id']}</td>
            <td>{$row['email']}</td>
            <td>{$row['time']}</td>
            <td>{$row['status']}</td>
            <td>
              <a href="./forward-list.php?uid={$row['id']}" class="btn btn-xs btn-primary">域名</a>
              <a href="./user-info.php?id={$row['id']}" class="btn btn-xs btn-success">详情</a>
              <a href="./user-edit.php?id={$row['id']}" class="btn btn-xs btn-info">编辑</a>
              <a href="javascript:delete_confirm('{$row['id']}')" class="btn btn-xs btn-danger">删除</a>
            </td>
          </tr>
        {/foreach}
        </tbody>
      </table>
      {literal}<script>
        function delete_confirm(id){
          var del = confirm("你确定要删除该用户吗？");
          if(del == true){
            window.open("./user-delete.php?id="+id);
          }
        }
      </script>{/literal}
    </div>
    <div class="text-center">
      <ul class="pagination">
      {if $page['no']-1 >= 1}
        <li><a href="user-list.php?page={$page['no']-1}">&laquo;</a></li>
      {else}
        <li class="disabled"><a href="#">&laquo;</a></li>
      {/if}
      {assign var="i" value=1}
      {section name="page" loop=$page['no']-1}
        <li><a href="user-list.php?page={$i}">{$i}</a></li>
	{$i=$i+1}
      {/section}
        <li class="active"><a href="#">{$page['no']}</a></li>
      {$i=$page['no']+1}
      {section name="page" loop=$page['pages']-$page['no']}
        <li><a href="user-list.php?page={$i}">{$i}</a></li>
	{$i=$i+1}
      {/section}
      {if $page['no']+1 <= $page['pages']}
        <li><a href="user-list.php?page={$page['no']+1}">&raquo;</a></li>
      {else}
        <li  class="disabled"><a href="#">&raquo;</a></li>
      {/if}
      </ul>
    </div>
    {/if}
  </div>
{include file="footer.tpl"}