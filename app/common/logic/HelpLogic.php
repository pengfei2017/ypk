<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/27
 * Time: 22:00
 */

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\Help;
use Ypk\Models\HelpType;
use Ypk\Models\StoreBindClass;
use Ypk\Models\Upload;

class HelpLogic extends Model
{

    /**
     * 增加帮助类型
     *
     * @param
     * @return int
     */
    public function addHelpType($type_array)
    {
        if (empty($type_array)) {
            return false;
        }
        if (is_array($type_array)) {
            $model = new HelpType();
            if ($model->save($type_array)) {
                $type_id = $model->getTypeId();
                return $type_id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 增加帮助
     *
     * @param
     * @return int
     */
    public function addHelp($help_array, $upload_ids = array())
    {
        //$help_id = $this->table('help')->insert($help_array);
        $model = new Help();
        if ($model->save($help_array)) {
            $help_id = $model->getHelpId();
            if ($help_id && !empty($upload_ids)) {
                $this->editHelpPic($help_id, $upload_ids);
            } else {
                return $help_id;
            }
        } else {
            return false;
        }

//        return $help_id;
    }

    /**
     * 删除帮助类型记录
     *
     * @param
     * @return bool
     */
    public function delHelpType($condition)
    {
        if (empty($condition)) {
            return false;
        } else {
            $where = parseWhere($condition);
//            $condition['help_code'] = 'auto';//只有auto的可删除
            $result = HelpType::findFirst(array('conditions' => $where));
            if ($result) {
                $result->delete();
                return true;
            } else {
                return false;
            }
////            $result = $this->table('help_type')->where($condition)->delete();
//            return $result;
        }
    }

    /**
     * 删除帮助记录
     *
     * @param
     * @return bool
     */
    public function delHelp($condition, $help_ids = array())
    {
        if (empty($condition)) {
            return false;
        } else {
            $where = parseWhere($condition);
            $result = Help::findFirst($where);
            if ($result->delete()) {
                return true;
            } else {
                return false;
            }
//            $result = $this->table('help')->where($condition)->delete();
//            if ($result && !empty($help_ids)) {
//                $condition = array();
//                $condition['item_id'] = array('in', $help_ids);
//                $this->delHelpPic($condition);//删除帮助中所用的图片
//            }
//            return $result;
        }
    }

    /**
     * 删除帮助图片
     *
     * @param
     * @return bool
     */
    public function delHelpPic($condition)
    {
        if (empty($condition)) {
            return false;
        } else {
            $upload_list = $this->getHelpPicList($condition);
            if (!empty($upload_list) && is_array($upload_list)) {
                foreach ($upload_list as $key => $value) {
                    @unlink(BASE_UPLOAD_PATH . DS . ATTACH_ARTICLE . DS . $value['file_name']);
                }
            }
            $result = Upload::findFirst($condition);
            if ($result->delete()) {
                return true;
            } else {
                return false;
            }
//            $result = $this->table('upload')->where($condition)->delete();
//            return $result;
        }
    }

    /**
     * 修改帮助类型记录
     *
     * @param
     * @return bool
     */
    public function editHelpType($condition, $data)
    {
        if (empty($condition)) {
            return false;
        }
        if (is_array($data)) {
            $result = HelpType::findFirst($condition);
            if ($result->save($data)) {
                return true;
            } else {
                return false;
            }
//            $result = $this->table('help_type')->where($condition)->update($data);
//            return $result;
//        } else {
//            return false;
        }
    }

    /**
     * 修改帮助记录
     *
     * @param
     * @return bool
     */
    public function editHelp($condition, $data)
    {
        if (empty($condition)) {
            return false;
        }
        if (is_array($data)) {
            $result = Help::findFirst($condition);
            if ($result->save($data)) {
                return true;
            } else {
                return false;
            }
//            $result = $this->table('help')->where($condition)->update($data);
//            return $result;
//        } else {
//            return false;
        }
    }

    /**
     * 更新帮助图片
     *
     * @param
     * @return bool
     */
    /*public function editHelpPic($help_id, $upload_ids = array()) {
        if ($help_id && !empty($upload_ids)) {
            $data = array();
            $where = '';
            if(empty($upload_ids)){
                $where .= ' upload_type=2';
                $where .= ' item_id=0';
            }else{
                $where .= ' upload_type=2';
                $where .= ' item_id=0';
                $where .=parseWhere($upload_ids);//array('in', $upload_ids);
            }
            $data['item_id'] = $help_id;
            $result = Upload::findFirst($where);
            if($result->save($data)){
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }*/
    public function editHelpPic($help_id, $upload_ids = array())
    {
        if ($help_id && !empty($upload_ids)) {
            $condition = array();
            $data = array();
            $condition['upload_id'] = array('in', $upload_ids);
            $condition['upload_type'] = '2';
            $condition['item_id'] = '0';
            $data['item_id'] = $help_id;
            $where = parseWhere($condition);
            $result = Upload::find($where);
            if ($result->save($data)) {
                return $result;
            } else {
                return false;
            }
//            //$result = $this->table('upload')->where($condition)->update($data);
//            return $result;
//        } else {
//            return false;
        }
    }

    /**
     * 帮助类型记录
     *
     * @param array $condition
     * @param string $page
     * @param string $limit
     * @param string $fields
     * @return array
     * @internal param $
     */
    public function getHelpTypeList($condition = array())
    {
        $result = HelpType::find($condition);
        if (count($result) > 0) {
            return $result->toArray();
        } else {
            return array();
        }
        //$result = $this->table('help_type')->field($fields)->where($condition)->page($page)->limit($limit)->order('type_sort asc,type_id desc')->select();
//        return array();
    }

    /**
     * 帮助记录
     *
     * @param array $condition
     * @param string $page
     * @param string $limit
     * @param string $fields
     * @param string $order
     * @return array
     * @internal param $
     */
    public function getHelpList($condition = array(), $page = '', $limit = '', $fields = '*', $order = 'help_sort asc,help_id desc')
    {
        $result = $this->table('help')->field($fields)->where($condition)->page($page)->limit($limit)->order($order)->select();
        return $result;
    }

    /**
     * 帮助图片记录
     *
     * @param array $condition
     * @return array
     * @internal param $
     */
    public function getHelpPicList($condition = array())
    {
//        $condition['upload_type'] = '2';//帮助内容图片
//        $result = $this->table('upload')->where($condition)->select();
        $result = Upload::find($condition);
        if (count($result) > 0) {
            return $result->toArray();
        } else {
            return array();
        }
    }

    /**
     * 医生页面帮助类型记录
     *
     * @param array $condition
     * @param string $page
     * @param int $limit
     * @param string $order
     * @return array
     * @internal param $
     */
    public function getStoreHelpTypeList($condition = array())
    {
        $result = HelpType::find($condition);
        if (count($result) > 0) {
            return $result->toArray();
        } else {
            return array();
        }
    }

    /**
     * 医生页面帮助记录
     *
     * @param array $condition
     * @param string $page
     * @param string $order
     * @return array
     * @internal param $
     */
    public function getStoreHelpList($condition)
    {
        $result = Help::find($condition);
        if (count($result) > 0) {
            return $result->toArray();
        } else {
            return array();
        }
//        $condition['page_show'] = '1';//页面类型:1为医生,2为会员
//        $result = $this->getHelpList($condition, $page, '', '*', $order);
    }

    /**
     * 前台商家帮助显示数据
     *
     * @param array $condition
     * @return array
     * @internal param $
     */
    public function getShowStoreHelpList($condition = array())
    {
        $list = array();
        $help_list = array();//帮助内容
        $condition['help_show'] = '1';//是否显示,0为否,1为是
        $list = $this->getStoreHelpTypeList($condition);//帮助类型
        if (!empty($list) && is_array($list)) {
            $type_ids = array_keys($list);//类型编号数组
            $condition = array();
            $condition['type_id'] = array('in', $type_ids);
            $help_list = $this->getStoreHelpList($condition);
            if (!empty($help_list) && is_array($help_list)) {
                foreach ($help_list as $key => $value) {
                    $type_id = $value['type_id'];//类型编号
                    $help_id = $value['help_id'];//帮助编号
                    $list[$type_id]['help_list'][$help_id] = $value;
                }
            }
        }
        return $list;
    }
}