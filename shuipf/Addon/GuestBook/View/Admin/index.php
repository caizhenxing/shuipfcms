<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">搜索</div>
    <div class="search_type cc mb10">
      <div class="mb10"> 
       <form name="searchform" action="{$config_siteurl}index.php" method="get" >
        <input type="hidden" value="Addons" name="g">
        <input type="hidden" value="GuestBook" name="m">
        <input type="hidden" value="index" name="a">
        <input type="hidden" value="1" name="isadmin">
       <span class="mr20"> 搜索类型：
        <select name="searchtype">
          <option value="1" <if condition="$_GET['searchtype'] eq '1'">selected</if>>留言内容</option>
          <option value="2" <if condition="$_GET['searchtype'] eq '2'">selected</if> >姓名</option>
          <option value="2" <if condition="$_GET['searchtype'] eq '3'">selected</if> >QQ</option>
          <option value="2" <if condition="$_GET['searchtype'] eq '4'">selected</if> >手机</option>
          <option value="2" <if condition="$_GET['searchtype'] eq '5'">selected</if> >邮箱</option>
        </select>
        关键字：
        <input type="text" class="input length_3" name="keyword" size='10' value="{$Think.get.keyword}" placeholder="关键字">
        <button class="btn">搜索</button>
        </span> 
        </form>
       </div>
    </div>
  <form name="myform"  class="J_ajaxForm" action="{:U('delete','isadmin=1')}" method="post" >
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td width="20" align="center"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></td>
            <td width="50" align="center">ID</td>
            <td width="100" align="center">姓名</td>
            <td ></td>
            <td width="180" align="center">
            类别：<select name="searchtype" onChange="window.location.href=this.value">
            <option value="{:U('index' ,array('isadmin'=>1)  )}">全部</option>
            <volist name="typeList" id="vo">
          <option value="{:U('index' ,array('typeid'=>$key,'isadmin'=>1)  )}" <if condition=" $typeid eq $key">selected</if>>{$vo}</option>
          </volist>
           </select>
            </td>
            <td width="180" align="center">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="center"><input class="checkbox J_check "  data-yid="J_check_y" data-xid="J_check_x"  name="ids[]" value="{$vo.id}" type="checkbox"></td>
              <td align="center">{$vo.id}</td>
              <td align="center">{$vo.name}</td>
              <td >性别：{$vo.sex} ，QQ：{$vo.lxqq} ，Email：{$vo.email}， 手机：{$vo.shouji}
              <br/>留言内容：<br/>
              {$vo.introduce}
              <br/>留言时间：{$vo.createtime|date="Y-m-d H:i:s",###}
              <if condition=" $vo['reply'] ">
              <br/>
              <p> 管理员回复：{$vo.reply}</p>
              </if>
              </td>
              <td align="center">{$typeList[$vo['typeid']]}</td>
              <td align="center"><a class="J_ajax_del" href="{:U("delete",array("id"=>$vo['id'],'isadmin'=>1))}">删除</a> | <a href="{:U("reply",array("id"=>$vo['id'],'isadmin'=>1))}">回复</a></td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">
      	<label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label>
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">删除</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>