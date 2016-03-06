<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 插件前台管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Addon\GuestBook\Controller;

use Addons\Util\AddonsBase;

class IndexController extends AddonsBase {

    //留言类别
    private $typeId = 0;
    //留言模型
    private $db = NULL;
    //配置
    private $configs = array();

    protected function _initialize() {
        parent::_initialize();
        $this->configs = $this->getAddonConfig();
        $this->typeId = I('typeid', 0, 'intval');
        if (empty($this->typeId)) {
            $this->error('留言类别错误！');
        }
        $this->assign('typeid', $this->typeId);
        import('Addon.GuestBook.GuestbookModel');
        $this->db = new \Addon\GuestBook\GuestbookModel() ;
    }

    //留言首页
    public function index() {
        $where = array(
            'typeid' => $this->typeId,
            'secrecy' => 1,
        );
        $typeList = M('GuestbookType')->order(array('typeid' => 'DESC'))->select();

        $count = $this->db->where($where)->count();
        $page = page($count, 10);
        $data = $this->db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "DESC"))->select();

        //$this->assign('data', $data);
		$this->assign('dataList', $data);
        $this->assign("Page", $page->show('Admin'));
        $this->assign('typeList', $typeList);
        $this->display();
    }

    //增加留言
    public function add() {
        //是否允许留言
        if (empty($this->configs['allowcomments'])) {
            $this->error('系统设置不允许留言！');
        }
        //只允许会员留言
        if ($this->configs['ismember'] && isModuleInstall('Member') && service("Passport")->userid < 1) {
            $this->error('请先登陆后才可以留言！');
        }
        if (IS_POST) {
            //验证码
            if ($this->configs['captcha']) {
                $validate = I('post.validate');
                if (empty($validate)) {
                    $this->error('验证码不能为空！');
                }
                //验证
                if ($this->verify($validate, 'guestbook') == false) {
                    $this->error('验证码错误，请重新输入！');
                }
            }
            //提交
            $post = I('post.');
            if (isModuleInstall('Member') && service("Passport")->userid > 0) {
                $post['username'] = service("Passport")->usename;
                $post['userid'] = (int)service("Passport")->userid;
            }
            if ($this->db->addGuestBook($post)) {
                $this->success('留言成功！', U('GuestBook/index', array('typeid' => $post['typeid'])));
            } else {
                $error = $this->db->getError();
                $this->error($error ? $error : '留言失败！');
            }
        } else {
            //开启验证码
            $this->assign('captcha', $this->configs['captcha']);
            $this->display();
        }
    }

}
