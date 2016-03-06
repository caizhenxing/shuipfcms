<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 留言板 插件
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Addon\GuestBook;

use \Addons\Util\Addon;

class GuestBookAddon extends Addon {

    //插件信息
    public $info = array(
        'name' => 'GuestBook',
        'title' => '留言板',
        'description' => '这是一个简单实用的留言板插件！',
        'status' => 1,
        'author' => '水平凡',
        'version' => '1.0.1',
        'has_adminlist' => 1,
    );
    //有开启插件后台情况下，添加对应的控制器方法
    //也就是插件目录下 Action/AdminAction.class.php中，public属性的方法！
    //每个方法都是一个数组形式，删除，修改类需要具体参数的，建议隐藏！
    public $adminlist = array(
        array(
            //方法名称
            "action" => "index",
            //附加参数 例如：a=12&id=777
            "data" => "",
            //类型，1：权限认证+菜单，0：只作为菜单
            "type" => 0,
            //状态，1是显示，2是不显示
            "status" => 1,
            //名称
            "name" => "留言管理",
            //备注
            "remark" => "",
            //排序
            "listorder" => 0,
        ),
        array(
            //方法名称
            "action" => "type",
            //附加参数 例如：a=12&id=777
            "data" => "",
            //类型，1：权限认证+菜单，0：只作为菜单
            "type" => 0,
            //状态，1是显示，2是不显示
            "status" => 1,
            //名称
            "name" => "分类管理",
            //备注
            "remark" => "",
            //排序
            "listorder" => 0,
        ),
        array(
            //方法名称
            "action" => "addtype",
            //附加参数 例如：a=12&id=777
            "data" => "",
            //类型，1：权限认证+菜单，0：只作为菜单
            "type" => 0,
            //状态，1是显示，2是不显示
            "status" => 1,
            //名称
            "name" => "添加分类",
            //备注
            "remark" => "",
            //排序
            "listorder" => 0,
        ),
        array(
            //方法名称
            "action" => "delete",
            //附加参数 例如：a=12&id=777
            "data" => "",
            //类型，1：权限认证+菜单，0：只作为菜单
            "type" => 0,
            //状态，1是显示，2是不显示
            "status" => 0,
            //名称
            "name" => "删除留言",
            //备注
            "remark" => "",
            //排序
            "listorder" => 0,
        ),
        array(
            //方法名称
            "action" => "deletetype",
            //附加参数 例如：a=12&id=777
            "data" => "",
            //类型，1：权限认证+菜单，0：只作为菜单
            "type" => 0,
            //状态，1是显示，2是不显示
            "status" => 0,
            //名称
            "name" => "删除分类",
            //备注
            "remark" => "",
            //排序
            "listorder" => 0,
        ),
        array(
            //方法名称
            "action" => "reply",
            //附加参数 例如：a=12&id=777
            "data" => "",
            //类型，1：权限认证+菜单，0：只作为菜单
            "type" => 0,
            //状态，1是显示，2是不显示
            "status" => 0,
            //名称
            "name" => "留言回复",
            //备注
            "remark" => "",
            //排序
            "listorder" => 0,
        ),
    );

    //安装
    public function install() {
        if (!file_exists(SITE_PATH . '/statics/addons/guestbook/')) {
            //创建目录
            if (mkdir(SITE_PATH . '/statics/addons/guestbook/', 0777, true) == false) {
			    $this->error = '创建目录 [statics/addons/guestbook] 失败！';
                return false;
            }
        }
        //移动文件
        $Dir = new \Dir();
        $Dir->copyDir($this->addonPath . "statics/", SITE_PATH . '/statics/addons/');

        $slq = $this->addonPath . 'guestbook.sql';
        $sql = file_get_contents($slq);
        $sql = $this->sqlSplit($sql, C("DB_PREFIX"));
        if (!empty($sql) && is_array($sql)) {
            foreach ($sql as $sql_split) {
                M()->execute($sql_split);
            }
        }
        return true;
    }

    //卸载
    public function uninstall() {
        $tablename = C("DB_PREFIX") . 'guestbook';
        M()->query("DROP TABLE $tablename");
        $tablename = C("DB_PREFIX") . 'guestbook_type';
        M()->query("DROP TABLE $tablename");
        //移动文件
        $Dir = new \Dir();
        $Dir->delDir(SITE_PATH . '/statics/addons/guestbook/');
        return true;
    }

    /**
     * 分析处理sql语句，执行替换前缀都功能。
     * @param string $sql 原始的sql
     * @param string $tablepre 表前缀
     */
    private function sqlSplit($sql, $tablepre) {
        if ($tablepre != "shuipfcms_")
            $sql = str_replace("shuipfcms_", $tablepre, $sql);
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);
        if ($r_tablepre != $s_tablepre)
            $sql = str_replace($s_tablepre, $r_tablepre, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }

}
