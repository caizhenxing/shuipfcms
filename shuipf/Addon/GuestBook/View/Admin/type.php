<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
<Admintemplate file="Common/Nav"/>
<div class="h_a">说明</div>
<div class="prompt_text">
  <p>删除分类会同时删除该分类下的信息！</p>
</div>
<form class="J_ajaxForm" action="{:U('type','isadmin=1')}" method="post">
  <div class="table_list">
    <table width="100%" cellspacing="0">
      <thead>
        <tr>
          <td width="80" align="left">选择</td>
          <td  align="left">分类名称</td>
        </tr>
      </thead>
      <tbody>
        <volist name="data" id="vo">
          <tr>
            <td><input class="input-text" type="checkbox" name="typeid[]" value="{$vo.typeid}" ></td>
            <td><input type="text" class="input" size="30" name="name[{$vo.typeid}]" value="{$vo.name}" > <a href="{:U('deletetype','isadmin=1&typeid='.$vo['typeid'])}" class="J_ajax_del">删除分类</a> | 前台访问地址：<a href="{:U('index',array('typeid'=>$vo['typeid']))}" target="_blank">{:U('index',array('typeid'=>$vo['typeid']))}</a></td>
          </tr>
        </volist>
      </tbody>
    </table>
  </div>
  <div class="">
    <div class="btn_wrap_pd">
      <button class="btn btn_submit mr10 J_ajax_submit_btn1" type="submit">更新</button>
    </div>
  </div>
</form>
<div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>