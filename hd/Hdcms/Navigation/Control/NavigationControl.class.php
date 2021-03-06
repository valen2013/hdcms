<?php

/**
 * 前台导航
 * Class NavigationControl
 */
class NavigationControl extends AuthControl
{
    //操作模型
    private $_db;
    //导航缓存
    private $_navigation;

    public function __init()
    {
        $this->_db = K("Navigation");
        $this->_navigation = F('navigation');
    }

    public function index()
    {
        $this->navigation = $this->_navigation;
        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            if ($this->_db->add_nav()) {
                $this->ajax(array('state' => 1, 'message' => '添加导航成功！'));
            }
        } else {
            $this->nav = $this->_navigation;
            $this->display();
        }
    }

    /**
     * 修改导航
     */
    public function edit()
    {
        if (IS_POST) {
            if ($this->_db->edit_nav()) {
                $this->ajax(array('state' => 1, 'message' => '修改导航成功！'));
            }
        } else {
            $this->nav = $this->_navigation;
            $this->field = $this->_navigation[Q('nid')];
            $this->display();
        }
    }

    /**
     * 删除导航
     */
    public function del()
    {
        if ($this->_db->del_nav()) {
            $this->ajax(array('state' => 1, 'message' => '删除导航成功'));
        } else {
            $this->ajax(array('state' => 0, 'message' => $this->_db->error));
        }
    }

    /**
     * 更新排序
     */
    public function update_order()
    {
        if ($this->_db->update_order()) {
            $this->ajax(array('state' => 1, 'message' => '更改排序成功'));
        }
    }

    public function update_cache()
    {
        if ($this->_db->update_cache()) {
            $this->ajax(array('state' => 1, 'message' => '缓存更新成功！'));
        }
    }
}