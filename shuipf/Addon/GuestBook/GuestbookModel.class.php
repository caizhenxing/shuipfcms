<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 留言模型
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Addon\GuestBook;

use Common\Model\Model;

class GuestbookModel extends Model {

    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        array('typeid', 'require', '留言类型不能为空！', 1, 'regex', 3),
        array('name', 'require', '姓名不能为空！', 1, 'regex', 3),
        array('email', 'require', '联系邮箱不能为空！', 1, 'regex', 3),
        array('email', 'email', '联系邮箱填写错误！', 1, 'regex', 3),
        array('introduce', 'require', '留言内容不能为空！', 1, 'regex', 3),
    );
    //自动完成
    protected $_auto = array(
        //array(填充字段,填充内容,填充条件,附加规则)
        array('createtime', 'time', 1, 'function'),
        array('listorder', 0),
    );

    /**
     * 添加分类
     * @param type $data
     * @return boolean
     */
    public function addType($data) {
        if (empty($data)) {
            $this->error = '分类名称不能为空！';
            return false;
        }
        if (empty($data['name'])) {
            $this->error = '分类名称不能为空！';
            return false;
        }
        $db = M('GuestbookType');
        $data = $db->create($data, 1);
        if ($data) {
            $typeId = $db->add($data);
            if ($typeId) {
                return $typeId;
            } else {
                $this->error = '分类添加失败！';
                return false;
            }
        }
        return false;
    }

    /**
     * 删除留言分类
     * @param type $typeId 分类ID
     * @return boolean
     */
    public function deleteType($typeId) {
        if (empty($typeId)) {
            $this->error = '请指定需要删除的留言分类！';
            return false;
        }
        $db = M('GuestbookType');
        if ($db->where(array('typeid' => $typeId))->delete() !== false) {
            $this->where(array('typeid' => $typeId))->delete();
            return true;
        } else {
            $this->error = '分类删除失败！';
            return fale;
        }
    }

    /**
     * 回复留言
     * @param type $data
     * @return boolean
     */
    public function replyGuestBook($data) {
        if (empty($data['reply']) || empty($data['id'])) {
            $this->error = '回复内容不能为空！';
            return false;
        }
        $saveData = array(
            'reply' => $data['reply'],
            'replytime' => time(),
        );
        if ($this->where(array('id' => $data['id']))->save($saveData) !== false) {
            return true;
        } else {
            $this->error = '回复失败！';
            return false;
        }
    }

    /**
     * 添加留言
     * @param type $data
     * @return boolean
     */
    public function addGuestBook($data) {
        if (empty($data)) {
            $this->error = '留言内容不能为空！';
            return false;
        }
        $data = $this->create($data, 1);
        if (!$data) {
            return false;
        }
        //检查留言类别是否存在
        $db = M('GuestbookType');
        if ($db->where(array('typeid' => $data['typeid']))->count() == 0) {
            $this->error = '该留言类别不存在！';
            return false;
        }
        $id = $this->add($data);
        if ($id) {
            return $id;
        }
        $this->error = '留言失败！';
        return false;
    }

    /**
     * 留言删除
     * @param type $ids 留言ID
     * @return boolean
     */
    public function deleteGuestBook($ids) {
        if (empty($ids)) {
            $this->error = '请指定需要删除的留言！';
            return false;
        }
        $where = array();
        if (is_array($ids)) {
            $where['id'] = array('IN', $ids);
        } else {
            $where['id'] = $ids;
        }
        $this->where($where)->delete();
        return true;
    }

}
