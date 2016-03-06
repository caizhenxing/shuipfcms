<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">回复评论</div>
  <form name="myform" action="{:U("reply","isadmin=1")}" method="post" class="J_ajaxForm">
    <input type="hidden" name="id" value="{$info.id}">
    <div class="table_full"> 
    <table width="100%" class="table_form contentWrap">
        <tbody>
        <tr>
          <th width="100">姓名</th>
          <td>{$info.name}</td>
        </tr>
        <tr>
          <th>性别</th>
          <td>{$info.sex}</td>
        </tr>
        <tr>
          <th>基本联系方式</th>
          <td>性别：{$info.sex} ，QQ：{$info.lxqq} ，Email：{$info.email}， 手机：{$info.shouji}</td>
        </tr>
        <tr>
          <th>回复内容</th>
          <td><textarea name="reply" style="width:600px; height:200px;"></textarea></td>
        </tr>
      </tbody></table>
    </div>
     <div class="btn_wrap" style="z-index:999;">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">回复</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>