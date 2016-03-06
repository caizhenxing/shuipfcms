<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link rel="shortcut icon" href="/favicon.ico" />
<title>留言板</title>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
	list-style: none;
	border: 0;
}
body {
	font: normal 12px/normal Verdana, Geneva, sans-serif;
color#666;
}
#ask_main {
	width: 980px;
	margin: 0 auto;
}
.toubu {
	margin: 10px 0;
	border-radius: 3px;
}
.liuyan {
	border: 1px solid #d2d2d2;
	height: 368px;
	border-radius: 3px;
}
.liuyan input, .liuyan textarea {
	outline: none;
	padding: 5px;
	color: #999;
	border-radius: 3px;
	resize: none;
}
.liuyan .input {
	border: 1px solid #d2d2d2;
	height: 20px;
	width: 240px;
	line-height: 20px;
}
.form_sets {
	padding: 10px 10px 0;
	width: 450px;
	overflow: hidden;
}
.liuyan .p1 {
height:;
}
.liuyan .p2 {
height:;
}
.liuyan .p3 {
height:;
}
.liuyan .p4 {
	height: 104;
}
.liuyan .p5 {
height:;
}
.liuyan .textarea {
	width: 375px;
	height: 100px;
	border: 1px solid #d2d2d2;
}
.liuyan .btn {
	width: 79px;
	height: 33px;
	background: url( {$Config.siteurl}statics/addons/guestbook/btn.gif) no-repeat left top;
	cursor: pointer;
	text-align: center;
	margin-right: 10px;
}
.btn_tab {
	margin-left: 65px;
}
.rebox {
	background: none;
}
/*----------*/
#words {
	margin-top: 15px;
}
.wd_con {
	border: 1px solid #d2d2d2;
	padding: 15px;
	margin-bottom: 15px;
	border-radius: 3px;
}
.wd_con h3 {
	font: normal 12px/1 Verdana, Geneva, sans-serif;
	color: #666;
	border-bottom: 1px dashed #d2d2d2;
	padding-bottom: 12px;
}
.wd_con h3 .gname {
	color: #ba2b7f;
	padding-right: 10px;
}
.wd_con h3 .gtime {
	float: right;
	font: normal 14px/normal Georgia, "Times New Roman", Times, serif;
}
.wd_con .g_question {
	padding-top: 10px;
	line-height: 1.8;
	color: #555;
	text-indent: 1.5em;
}
.wd_con .g_answer {
	border-top: 1px dashed #d2d2d2;
	padding-top: 10px;
	margin-top: 10px;
	line-height: 1.8;
	text-indent: 1.5em;
	color: #F00;
}
.wd_con .g_answer span {
	color: #F00;
}
/*page*/
.g_pages {
	text-align: left;
	margin-bottom: 10px;
}
.g_pages a {
	background: #f7f7f7;
	border: 1px solid #D5D0D6;
	text-decoration: none;
	display: block;
	float: left;
	font-size: 12px;
	height: 26px;
	line-height: 26px;
	margin: 0 5px;
	padding-left: 10px;
	padding-right: 10px;
	color: #bb2c80;
	border-radius: 3px;
}
.g_pages a:hover {
	background: #bb2c80;
	border: 1px solid #bb2c80;
	color: #fff;
}
.g_pages strong {
	background: #bb2c80;
	border: 1px solid #bb2c80;
	color: white;
	display: block;
	float: left;
	font-size: 12px;
	height: 26px;
	line-height: 26px;
	margin: 0 5px;
	padding-left: 10px;
	padding-right: 10px;
	border-radius: 3px;
}
.g_pages span, .g_pages .indexPage {
	background: #f7f7f7;
	border: 1px solid #D5D0D6;
	color: bb2c80;
	display: block;
	float: left;
	font-size: 12px;
	height: 26px;
	line-height: 26px;
	margin: 0 5px;
	padding-left: 10px;
	padding-right: 10px;
	border-radius: 3px;
}
.g_footer {
	text-align: center;
	border-top: 3px solid #bb2c80;
	padding: 10px 0px;
}
.g_footer p {
	text-align: center;
	line-height: 1.8;
	color: #444;
}
.g_footer p a {
	color: #bb2c80;
	text-decoration: none;
}
</style>
<script type="text/javascript">
function iC(ipt){
ipt.onfocus=function(){
	if(this.value==this.defaultValue){this.value='';this.style.color='#000';}
	this.style.border="1px solid #ba2b7f";
	this.style.boxShadow="0 0 2px #ba2b7f";
	this.style.transition="all 0.2s ease-out"
};
ipt.onblur=function(){
	if(this.value==''){this.value=this.defaultValue;this.style.color='#999';}
	this.style.border="1px solid #ccc";
	this.style.boxShadow="0 0 0px #fff";
	};
ipt.onfocus();}

window.onload = function(){
	var oGuestBook = document.getElementById("words").getElementsByTagName("div");
	for(var i = 0;i<oGuestBook.length;i++){
		if(i%2==0){
			oGuestBook[i].style.backgroundColor ="#f9ffe0";
			}
			else{
				oGuestBook[i].style.backgroundColor ="#fff";
				}
		}
	}

</script>
</head>
<body>
<div id="ask_main">
  <div class="toubu"><a href="{:U('add',array('typeid'=>$typeid))}">发表留言</a></div>
  <div id="words">
    <volist name="dataList" id="vo">
    <div class="wd_con">
      <h3><span class="gtime">Time:{$vo.createtime|date="Y-m-d H:i:s",###}</span><span class="gname">姓名：{$vo.name}</span></h3>
      <p class="g_question">{$vo.introduce}</p>
      <if condition=" $vo['reply'] "> 
      <p class="g_answer"> 管理员回复：{$vo.reply}</p>
      </if>
    </div>
    </volist>
  </div>
  <div class="g_pages"> 
  {$Page}
  </div>
</div>
</body>
</html>