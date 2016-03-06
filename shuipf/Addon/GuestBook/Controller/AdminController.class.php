<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 插件后台管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Addon\GuestBook\Controller;

use Addons\Util\Adminaddonbase;

class AdminController extends Adminaddonbase {

    //留言模型
    private $db = NULL;

    protected function _initialize() {
        parent::_initialize();
        import('Addon.GuestBook.GuestbookModel');
        $this->db = new \Addon\GuestBook\GuestbookModel();
    }

    //后台首页
    public function index() {
        $where = array();
        $typeId = I('get.typeid');
        $typeList = M('GuestbookType')->order(array('typeid' => 'DESC'))->getField('typeid,name', true);
        if ($typeId) {
            $where['typeid'] = $typeId;
        }
        $count = $this->db->where($where)->count();
        $page = $this->page($count, 20);
        $data = $this->db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "DESC"))->select();

        $this->assign('data', $data);
        $this->assign("Page", $page->show('Admin'));
        $this->assign('typeList', $typeList);
        $this->assign('typeid', $typeId);
        $this->display();
    }

    //留言回复
    public function reply() {
        if (IS_POST) {
            $id = I('post.id', 0, 'intval');
            if (empty($id)) {
                $this->error('回复留言错误！');
            }
            $info = $this->db->where(array('id' => $id))->find();
            if (empty($info)) {
                $this->error('该留言不存在！');
            }
            $reply = I('post.reply');
            if (empty($reply)) {
                $this->error('回复内容不能为空！');
            }
            if ($this->db->replyGuestBook(array('id' => $id, 'reply' => $reply))) {
                //邮件回复
                $configs = $this->getAddonConfig();
                if ($configs['mailreply'] && $info['email']) {
                    $title = \Admin\Service\User::getInstance()->username . ' 回复了你在 ' . cache('Config.sitename') . ' 中的留言！';
                    $message = \Admin\Service\User::getInstance()->username . ' 回复了你在 ' . cache('Config.sitename') . ' 中的留言！' . "<br/>回复内容：<br/>{$reply}";
                    SendMail($info['email'], $title, $message);
                }
                $this->success('留言成功！', U('index', "typeid={$info['tupeid']}&isadmin=1"));
            } else {
                $error = $this->db->getError();
                $this->error($error ? $error : '回复失败！');
            }
        } else {
            $id = I('get.id', 0, 'intval');
            $info = $this->db->where(array('id' => $id))->find();
            if (empty($info)) {
                $this->error('该留言不存在！');
            }
            $this->assign('info', $info);
            $this->display();
        }
    }

    //删除留言
    public function delete() {
        if (IS_POST) {
            $ids = I('post.ids');
        } else {
            $ids = I('get.id', 0, 'intval');
        }
        if (empty($ids)) {
            $this->error('请指定需要删除的留言！');
        }
        if ($this->db->deleteGuestBook($ids)) {
            $this->success('留言删除成功！');
        } else {
            $error = $this->db->getError();
            $this->error($error ? $error : '删除失败！');
        }
    }

    //分类管理
    public function type() {
        $db = M('GuestbookType');
        if (IS_POST) {
            $typeid = I('post.typeid');
            $name = I('post.name');
            if (empty($typeid) || !is_array($typeid)) {
                $this->error('请选择需要更新的内容！');
            }
            foreach ($typeid as $id) {
                if ($name[$id]) {
                    $db->where(array('typeid' => $id))->save(array('name' => $name[$id]));
                }
            }
            $this->success('更新成功！');
        } else {
            $data = $db->order(array('typeid' => 'DESC'))->select();
            $this->assign('data', $data);
            $this->display();
        }
    }

    //添加分类
    public function addtype() {
        if (IS_POST) {
            $post = I('post.');
            if ($this->db->addType($post)) {
                $this->success('分类添加成功！', U('type', 'isadmin=1'));
            } else {
                $error = $this->db->getError();
                $this->error($error ? $error : '分类添加失败！');
            }
        } else {
            $this->display();
        }
    }

    //删除分类
    public function deletetype() {
        $typeid = I('get.typeid', 0, 'intval');
        if (empty($typeid)) {
            $this->error('请指定需要删除的留言分类！');
        }
        if ($this->db->deleteType($typeid)) {
            $this->success('删除留言分类成功！');
        } else {
            $error = $this->db->getError();
            $this->error($error ? $error : '删除失败！');
        }
    }

}
