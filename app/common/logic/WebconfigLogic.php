<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/17
 * Time: 14:21
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\AdvPosition;
use Ypk\Models\Web;
use Ypk\Models\WebCode;

class WebconfigLogic extends Model
{
    /**
     * 获取样式列表
     * @param string $style_id 样式名称
     * @return mixed
     */
    public function getStyleList($style_id = 'index')
    {
        $lang = getTranslation('web_config'); //读取语言包
        $style_data = array(
            'red' => $lang->_('web_config_style_red'),
            'pink' => $lang->_('web_config_style_pink'),
            'orange' => $lang->_('web_config_style_orange'),
            'green' => $lang->_('web_config_style_green'),
            'blue' => $lang->_('web_config_style_blue'),
            'purple' => $lang->_('web_config_style_purple'),
            'brown' => $lang->_('web_config_style_brown'),
            'default' => $lang->_('web_config_style_default')
        );
        $result['index'] = $style_data;
        return $result[$style_id];
    }

    /**
     * 读取模块内容记录列表
     * @param array $condition
     * @return WebCode[]
     */
    public function getCodeList($condition = array())
    {
        $condition = parseWhere($condition);
        $result = WebCode::find(array(
            "conditions" => getConditionsByParamArray($condition),
            "bind" => $condition,
            'order' => 'web_id'
        ));

        return $result;
    }

    /**
     * 读取记录列表
     * @param array $condition
     * @param string $page
     * @param string $order
     * @return Web[]
     */
    public function getWebList($condition = array('web_page' => 'index'), $page = '', $order = 'web_sort')
    {
        $result = Web::find(array('conditions' => parseWhere($condition), 'order' => $order));
        return $result;
    }

    /**
     * 转换字符串
     * @param $code_info
     * @param $code_type
     * @return array|mixed|string
     */
    public function get_array($code_info, $code_type)
    {
        $data = '';
        switch ($code_type) {
            case "array":
                if (is_string($code_info)) $code_info = unserialize($code_info);
                if (!is_array($code_info)) $code_info = array();
                $data = $code_info;
                break;
            case "html":
                if (!is_string($code_info)) $code_info = '';
                $data = $code_info;
                break;
            default:
                $data = '';
                break;
        }
        return $data;
    }

    /**
     * 更新模块信息
     * @param $condition
     * @param $data
     * @return bool
     */
    public function updateWeb($condition, $data)
    {
        if (empty($condition)) {
            return false;
        }
        if (is_array($data)) {
            $model = Web::findFirst(array(
                "conditions" => getConditionsByParamArray($condition),
                "bind" => $condition
            ));
            $result = $model->save($data);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 更新模块html信息
     * @param int $web_id
     * @param array $web_array
     * @return string
     */
    public function updateWebHtml($web_id = 1, $web_array = array())
    {
        $web_html = '';
        $code_list = $this->getCodeList(array('web_id' => $web_id));
        if (!empty($code_list) && count($code_list) > 0) {
            $code_list = $code_list->toArray();
            $lang = getTranslation('web_config,home_index_index');
            $output = array();
            if (empty($web_array)) {
                $web_list = $this->getWebList(array('web_id' => $web_id));
                $web_array = $web_list[0];
            }
            $output['web_id'] = $web_id;
            $output['style_name'] = $web_array['style_name'];
            foreach ($code_list as $key => $val) {
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $this->get_array($code_info, $code_type);
                $output['code_' . $var_name] = $val;
            }
            $web_page = $web_array['web_page'];
            switch ($web_page) {
                case 'index':
                    $style_file = RESOURCE_PATH . DS . 'web_config' . DS . 'default.php';
                    break;
                case 'index_pic':
                    $style_file = RESOURCE_PATH . DS . 'web_config' . DS . 'focus.php';
                    break;
                case 'index_sale':
                    $style_file = RESOURCE_PATH . DS . 'web_config' . DS . 'sale_goods.php';
                    break;
                case 'channel_tp':
                    $style_file = RESOURCE_PATH . DS . 'web_config' . DS . 'channel_top.php';
                    break;
                case 'channel_fl':
                    $style_file = RESOURCE_PATH . DS . 'web_config' . DS . 'channel_floor.php';
                    break;
                default:
                    $style_file = RESOURCE_PATH . DS . 'web_config' . DS . 'default.php';
                    break;
            }
            if (file_exists($style_file)) {
                ob_start();
                include $style_file;
                $web_html = ob_get_contents();
                ob_end_clean();
            }
            $web_array = array();
            $web_array['web_html'] = addslashes($web_html);
            $web_array['update_time'] = time();

            $this->updateWeb(array('web_id' => $web_id), $web_array);
        }
        return $web_html;
    }

    /**
     * 读取广告位记录列表
     *
     * @param string $type 广告类型
     * @return AdvPosition[]
     */
    public function getAdvList($type = 'screen')
    {
        $condition = array();
        $condition['screen'] = array(
            'ap_class' => '0',//图片
            'is_use' => '1',//启用
            'ap_width' => '1920',//宽度
            'ap_height' => '481'//高度
        );
        $condition['focus'] = array(
            'ap_class' => '0',//图片
            'is_use' => '1',//启用
            'ap_width' => '259',//宽度
            'ap_height' => '180'//高度
        );

        $strWhere = parseWhere($condition[$type]);
        $result = AdvPosition::find(array('conditions' => $strWhere, 'order' => 'ap_id desc'));
        return $result;
    }

    /**
     * 商品列表，价格以促销价显示
     *
     * @param array $condition
     * @param string $order
     * @param string $page
     * @internal param $
     * @return array 数组格式的返回结果
     */
    public function getGoodsList($condition = array(), $order = 'goods_id desc', $page = '')
    {
        $list = array();
        $model_goods = new GoodsLogic();
        $field = 'goods_id,goods_commonid,goods_name,goods_image,goods_price,goods_marketprice,goods_promotion_price';
        $goods_list = $model_goods->getGoodsListByColorDistinct($condition, $field, $order, $page);
        if (!empty($goods_list) && is_array($goods_list)) {
            $goods_commonlist = array();//商品公共ID关联商品ID数组
            foreach ($goods_list as $key => $value) {
                $goods_id = $value['goods_id'];
                $goods_commonid = $value['goods_commonid'];
                $goods_commonlist[$goods_commonid][] = $goods_id;
                $value['goods_type'] = 1;
                $value['goods_price'] = $value['goods_promotion_price'];
                $list[$goods_id] = $value;
            }
            $goods_ids = array_keys($list);//商品ID数组
            if (getConfig('promotion_allow')) {//限时折扣
                $xianshi_list = (new PXianshiGoodsLogic())->getXianshiGoodsListByGoodsString(implode(',', $goods_ids));
                if (!empty($xianshi_list) && is_array($xianshi_list)) {
                    foreach ($xianshi_list as $key => $value) {
                        $goods_id = $value['goods_id'];
                        $goods_price = $value['xianshi_price'];
                        $list[$goods_id]['goods_price'] = $goods_price;
                        $list[$goods_id]['goods_type'] = 3;
                    }
                }
            }
            $common_ids = array_keys($goods_commonlist);//商品公共ID数组
            if (getConfig('groupbuy_allow')) {//最终以抢购价为准
                $groupbuy_list = (new GroupBuyLogic())->getGroupbuyListByGoodsCommonIDString(implode(',', $common_ids));
                if (!empty($groupbuy_list) && is_array($groupbuy_list)) {
                    foreach ($groupbuy_list as $key => $value) {
                        $goods_commonid = $value['goods_commonid'];
                        $goods_price = $value['groupbuy_price'];
                        foreach ($goods_commonlist[$goods_commonid] as $k => $v) {
                            $goods_id = $v;
                            $list[$goods_id]['goods_price'] = $goods_price;
                            $list[$goods_id]['goods_type'] = 2;
                        }
                    }
                }
            }
        }
        return $list;
    }

    /**
     * 转换数组
     *
     * @param $code_info
     * @param $code_type
     * @return string
     */
    public function get_str($code_info, $code_type)
    {
        $str = '';
        switch ($code_type) {
            case "array":
                if (!is_array($code_info)) $code_info = array();
                $code_info = $this->stripslashes_deep($code_info);
                $str = serialize($code_info);
                $str = addslashes($str);
                break;
            case "html":
                if (!is_string($code_info)) $code_info = '';
                $str = $code_info;
                break;
            default:
                $str = '';
                break;
        }
        return $str;
    }

    /**
     * 递归去斜线
     *
     * @param $value
     * @return array|string
     */
    public function stripslashes_deep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripslashes_deep'), $value) : stripslashes($value);
        return $value;
    }

    /**
     * 读取模块内容记录
     *
     * @param $code_id
     * @param $web_id
     * @return array
     */
    public function getCodeRow($code_id, $web_id)
    {
        //$param = array();
        //$param['code_id']   = $code_id;
        //$param['web_id']    = $web_id;
        //$result = $this->table('web_code')->where($param)->find();
        $result = WebCode::findFirst('code_id=' . $code_id . ' and web_id=' . $web_id);
        if ($result) {
            $result = $result->toArray();
        } else {
            $result = array();
        }
        return $result;
    }

    /**
     * 更新模块内容数据
     *
     * @param array $condition 更新条件
     * @param array $data 要更新的数据
     * @return bool
     */
    public function updateCode($condition, $data)
    {
        if (intval($condition['code_id']) < 1) {
            return false;
        }
        if (is_array($data)) {
            $web_code = WebCode::findFirst(array(
                "conditions" => getConditionsByParamArray($condition),
                "bind" => $condition
            ));
            if ($web_code) {
                $data['code_info'] = str_replace('\\', '', $data['code_info']);
                return $web_code->save($data);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 模块html信息
     *
     */
    public function getWebHtml($web_page = 'index', $update_all = 0)
    {
        $web_array = array();
        //$web_list = $this->getWebList(array('web_show'=>1,'web_page'=> array('like',$web_page.'%')));
        $web_list = Web::find(array('conditions' => "web_show=1 and web_page like '" . $web_page . "%'", 'order' => 'web_sort'));
        if (count($web_list) > 0) {
            $web_list = $web_list->toArray();
        } else {
            $web_list = array();
        }
        if (!empty($web_list) && is_array($web_list)) {
            foreach ($web_list as $k => $v) {
                $key = $v['web_page'];
                if ($update_all == 1 || empty($v['web_html'])) {//强制更新或内容为空时查询数据库
                    $web_array[$key] .= $this->updateWebHtml($v['web_id'], $v);
                } else {
                    $web_array[$key] .= stripslashes($v['web_html']);
                }
            }
        }
        return $web_array;
    }
}