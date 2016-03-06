SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `shuipfcms_guestbook`
-- ----------------------------
DROP TABLE IF EXISTS `shuipfcms_guestbook`;
CREATE TABLE `shuipfcms_guestbook` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言ID',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '留言类别',
  `username` varchar(30) NOT NULL COMMENT '会员用户名',
  `userid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `sex` varchar(50) NOT NULL COMMENT '性别',
  `lxqq` varchar(50) NOT NULL COMMENT '联系QQ',
  `email` varchar(50) NOT NULL COMMENT '联系邮箱',
  `shouji` varchar(50) NOT NULL COMMENT '手机',
  `introduce` text NOT NULL COMMENT '留言内容',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '留言状态',
  `secrecy` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否公开',
  `reply` text NOT NULL COMMENT '回复内容',
  `replytime` int(10) NOT NULL COMMENT '回复时间',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '留言时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言板';
-- ----------------------------
-- Table structure for `shuipfcms_guestbook_type`
-- ----------------------------
DROP TABLE IF EXISTS `shuipfcms_guestbook_type`;
CREATE TABLE `shuipfcms_guestbook_type` (
  `typeid` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`typeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言分类';
