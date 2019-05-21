{assign var="title" value="用户帐户激活"}
{include file="header.tpl"}
{include file="nav.tpl"}
  <div class="container">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    {if $result['status'] == '1'}
      <div class="alert alert-success">
        {$result['msg']}
        <script>location.href = "./login.php?msg={$result['msg']}";</script>
      </div>
    {else}
      <div class="alert alert-warning">
        {$result['msg']}
      </div>
    {/if}
    </div>
  </div>
{include file="footer.tpl"}