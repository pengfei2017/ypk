<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/17
 * Time: 15:35
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\GoodsClass;
use Ypk\QueueClient;

/**
 * 商品管理
 *
 * Class GoodsClassLogic
 * @package Ypk\Logic
 */
class GoodsClassLogic1 extends Model
{
    public function __construct()
    {

    }

    const STATE1 = 1;       // 出售中
    const STATE0 = 0;       // 下架
    const STATE10 = 10;     // 违规
    const VERIFY1 = 1;      // 审核通过
    const VERIFY0 = 0;      // 审核失败
    const VERIFY10 = 10;    // 等待审核

    /**
     * 取分类列表，最多为三级
     * @param string $show_deep
     * @param array $condition
     * @return array
     */
    public function getTreeClassList($show_deep = '3', $condition = array())
    {
        $class_list = $this->getGoodsClassList($condition);
        $goods_class = array();//分类数组
        if (is_array($class_list) && !empty($class_list)) {
            $show_deep = intval($show_deep);
            if ($show_deep == 1) {//只显示第一级时用循环给分类加上深度deep号码
                foreach ($class_list as $val) {
                    if ($val['gc_parent_id'] == 0) {
                        $val['deep'] = 1;
                        $goods_class[] = $val;
                    } else {
                        break;//父类编号不为0时退出循环
                    }
                }
            } else {//显示第二和三级时用递归
                $goods_class = $this->_getTreeClassList($show_deep, $class_list);
            }
        }
        return $goods_class;
    }

    /**
     * 类别列表
     * @param $condition
     * @param string $field
     * @return array
     */
    public function getGoodsClassList($condition, $field = '*')
    {
        $strWhere = parseWhere($condition);
        $result = GoodsClass::find(array('coditions' => $strWhere, 'columns' => $field, 'order' => 'gc_parent_id asc,gc_sort asc,gc_id asc'));
        if (count($result) > 0) {
            $result = $result->toArray();
        } else {
            $result = array();
        }
        return $result;
    }

    /**
     * 递归 整理分类
     *
     * @param int $show_deep 显示深度
     * @param array $class_list 类别内容集合
     * @param int $deep 深度
     * @param int $parent_id 父类编号
     * @param int $i 上次循环编号
     * @return array $show_class 返回数组形式的查询结果
     */
    private function _getTreeClassList($show_deep, $class_list, $deep = 1, $parent_id = 0, $i = 0)
    {
        static $show_class = array();//树状的平行数组
        if (is_array($class_list) && !empty($class_list)) {
            $size = count($class_list);
            if ($i == 0) $show_class = array();//从0开始时清空数组，防止多次调用后出现重复
            for ($i; $i < $size; $i++) {//$i为上次循环到的分类编号，避免重新从第一条开始
                $val = $class_list[$i];
                $gc_id = $val['gc_id'];
                $gc_parent_id = $val['gc_parent_id'];
                if ($gc_parent_id == $parent_id) {
                    $val['deep'] = $deep;
                    $show_class[] = $val;
                    if ($deep < $show_deep && $deep < 3) {//本次深度小于显示深度时执行，避免取出的数据无用
                        $this->_getTreeClassList($show_deep, $class_list, $deep + 1, $gc_id, $i + 1);
                    }
                }
                if ($gc_parent_id > $parent_id) break;//当前分类的父编号大于本次递归的时退出循环
            }
        }
        return $show_class;
    }

    /**
     * 从缓存获取分类 通过上级分类id
     *
     * @param int $pid 上级分类id 若传0则返回1级分类
     * @return array
     */
    public function getGoodsClassListByParentId($pid)
    {
        $data = $this->getCache();
        $ret = array();
        foreach ((array)$data['children'][$pid] as $i) {
            if ($data['data'][$i]) {
                $ret[] = $data['data'][$i];
            }
        }
        return $ret;
    }

    /**
     * 获取缓存数据
     *
     * @return array
     * array(
     *   'data' => array(
     *     // Id => 记录
     *   ),
     *   'parent' => array(
     *     // 子Id => 父Id
     *   ),
     *   'children' => array(
     *     // 父Id => 子Id数组
     *   ),
     *   'children2' => array(
     *     // 1级Id => 3级Id数组
     *   ),
     * )
     */
    public function getCache()
    {
        $data = read_file_cache('gc_class'); //从缓存中读取数据
        if (!$data) {
            $data = array();
            foreach ((array)$this->getGoodsClassList(array()) as $v) {
                $id = $v['gc_id'];
                $pid = $v['gc_parent_id'];
                $data['data'][$id] = $v;
                $data['parent'][$id] = $pid;
                $data['children'][$pid][] = $id;
            }
            foreach ((array)$data['children'][0] as $id) {
                foreach ((array)$data['children'][$id] as $cid) {
                    foreach ((array)$data['children'][$cid] as $ccid) {
                        $data['children2'][$id][] = $ccid;
                    }
                }
            }
            write_file_cache('gc_class', $data);
        }
        return $data;
    }

    /**
     * 返回缓存数据
     * @return array|mixed
     */
    public function getGoodsClassForCacheModel()
    {
        $data = $this->getCache();
        $r = $data['data'];
        $p = $data['parent'];
        $c = $data['children'];
        $c2 = $data['children2'];

        $r = (array)$r;

        foreach ($r as $k => & $v) {
            if ((string)$p[$k] == '0') {
                $v['depth'] = 1;
                if ($data['children'][$k]) {
                    $v['child'] = implode(',', $c[$k]);
                }
                if ($data['children2'][$k]) {
                    $v['childchild'] = implode(',', $c2[$k]);
                }
            } else if ((string)$p[$p[$k]] == '0') {
                $v['depth'] = 2;
                if ($data['children'][$k]) {
                    $v['child'] = implode(',', $c[$k]);
                }
            } else if ((string)$p[$p[$p[$k]]] == '0') {
                $v['depth'] = 3;
            }
        }
        return $r;
    }

    /**
     * 前台头部的商品分类
     *
     * @param int|number $update_all 更新
     * @return array 数组
     */
    public function get_all_category($update_all = 0)
    {

        // 不存在时更新或者强制更新时执行
        if ($update_all == 1 || !($gc_list = read_file_cache('all_categories'))) {
            $class_list = $this->getGoodsClassListAll();
            $gc_list = array();
            $class1_deep = array();//第1级关联第3级数组
            $class2_ids = array();//第2级关联第1级ID数组
            if (is_array($class_list) && !empty($class_list)) {
                foreach ($class_list as $key => $value) {
                    $p_id = $value['gc_parent_id'];//父级ID
                    $gc_id = $value['gc_id'];
                    $sort = $value['gc_sort'];
                    if ($p_id == 0) {//第1级分类
                        $nav_info = $this->_getGoodsClassNavById($gc_id);
                        $gc_list[$gc_id] = array_merge($value, $nav_info);
                    } elseif (array_key_exists($p_id, $gc_list)) {//第2级
                        $class2_ids[$gc_id] = $p_id;
                        $gc_list[$p_id]['class2'][$gc_id] = $value;
                    } elseif (array_key_exists($p_id, $class2_ids)) {//第3级
                        $parent_id = $class2_ids[$p_id];//取第1级ID
                        $gc_list[$parent_id]['class2'][$p_id]['class3'][$gc_id] = $value;
                        $class1_deep[$parent_id][$sort][] = $value;
                    }
                }
            }
            write_file_cache('all_categories', $gc_list); //把数据写入缓存
        }
        return $gc_list;
    }

    /**
     * 从缓存获取全部分类
     */
    public function getGoodsClassListAll()
    {
        $data = $this->getCache();
        return array_values((array)$data['data']);
    }

    private function _getGoodsClassNavById($gc_id)
    {
        $model_class_nav = new GoodsClassNavLogic();
        $model_brand = new BrandLogic();

        $nav_info = $model_class_nav->getGoodsClassNavInfoByGcId($gc_id);
        if (empty($nav_info)) {
            return array();
        }

        $pic_name = BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_pic'];
        if (file_exists($pic_name)) {
            $nav_info['cn_pic'] = UPLOAD_SITE_URL . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_pic'];
        } else {
            unset($nav_info['cn_pic']);
        }
        $pic_name = BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv1'];
        if (file_exists($pic_name)) {
            $nav_info['cn_adv1'] = UPLOAD_SITE_URL . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv1'];
        } else {
            unset($nav_info['cn_adv1']);
        }
        $pic_name = BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv2'];
        if (file_exists($pic_name)) {
            $nav_info['cn_adv2'] = UPLOAD_SITE_URL . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv2'];
        } else {
            unset($nav_info['cn_adv2']);
        }
        if ($nav_info['cn_brandids'] != '') {
            $nav_info['cn_brands'] = $model_brand->getBrandList(array('brand_id' => array('in', $nav_info['cn_brandids'])));
            unset($nav_info['cn_brandids']);
        }
        if ($nav_info['cn_classids'] != '') {
            $nav_info['cn_classs'] = $this->getGoodsClassList(array('gc_id' => array('in', $nav_info['cn_classids'])));
            unset($nav_info['cn_classids']);
        }
        if ($nav_info['cn_alias'] != '') {
            $nav_info['gc_name'] = $nav_info['cn_alias'];
            unset($nav_info['cn_alias']);
        }
        return $nav_info;
    }

    /**
     * 新增商品数据
     *
     * @param array $insert 数据
     * @param string $table 表名
     */
    public function addGoods($insert)
    {
        $result = $this->table('goods')->insert($insert);
        if ($result) {
            $this->_dGoodsCache($result);
            $this->_dGoodsCommonCache($insert['goods_commonid']);
            $this->_dGoodsSpecCache($insert['goods_commonid']);
        }
        return $result;
    }

    /**
     * 新增商品公共数据
     *
     * @param array $insert 数据
     * @param string $table 表名
     */
    public function addGoodsCommon($insert)
    {
        return $this->table('goods_common')->insert($insert);
    }

    /**
     * 新增多条商品数据
     *
     * @param unknown $insert
     */
    public function addGoodsImagesAll($insert)
    {
        $result = $this->table('goods_images')->insertAll($insert);
        if ($result) {
            $commonid_array = array();
            foreach ($insert as $val) {
                $this->_dGoodsImageCache($val['goods_commonid'] . '|' . $val['color_id']);
                $this->_dGoodsCommonCache($val['goods_commonid']);
                $this->_dGoodsSpecCache($val['goods_commonid']);
                $commonid_array[] = $val['goods_commonid'];
            }
            if (getConfig('cache_open') && !empty($commonid_array)) {
                $commonid_array = array_unique($commonid_array);
                $goodsid_list = $this->getGoodsList(array('goods_commonid' => array('in', $commonid_array)), 'goods_id');
                foreach ($goodsid_list as $val) {
                    $this->_dGoodsCache($val['goods_id']);
                }
            }
        }
        return $result;
    }

    /**
     * 商品SKU列表
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @return array 二维数组
     */
    public function getGoodsList($condition, $field = '*', $group = '', $order = '', $limit = 0, $page = 0, $count = 0)
    {
        $condition = $this->_getRecursiveClass($condition);
        return $this->table('goods')->field($field)->where($condition)->group($group)->order($order)->limit($limit)->page($page, $count)->select();
    }

    /**
     * 获取指定分类指定医生下的随机商品列表
     *
     * @param int $gcId 一级分类ID
     * @param int $storeId 医生ID
     * @param int $notEqualGoodsId 此商品ID除外
     * @param int $size 列表最大长度
     *
     * @return array|null
     */
    public function getGoodsGcStoreRandList($gcId, $storeId, $notEqualGoodsId = 0, $size = 4)
    {
        $condition = array(
            'store_id' => (int)$storeId,
            'gc_id_1' => (int)$gcId,
        );

        if ($notEqualGoodsId > 0) {
            $condition['goods_id'] = array('neq', (int)$notEqualGoodsId);
        }

        return $this->getGoodsOnlineList($condition, '*', 0, 'rand()', $size);
    }

    /**
     * 出售中的商品SKU列表（只显示不同颜色的商品，前台商品索引，医生也商品列表等使用）
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param number $page
     * @param number $limit
     * @return array
     */
    public function getGoodsListByColorDistinct($condition, $field = '*', $order = 'goods_id asc', $page = 0, $limit = 0)
    {
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        $condition = $this->_getRecursiveClass($condition);
        $_field = "CONCAT(goods_commonid,',',color_id)";
        $_distinct = 'nc_distinct';

        // 只查询固定条数不分页时，不计算商品总数
        if ($limit == 0) {
            $count = $this->getGoodsOnlineCount($condition, "distinct " . $_field);
            if ($count == 0) {
                pagecmd('settotalpagebynum', 0);
                return array();
            }
        }
        $goods_list = $this->getGoodsOnlineList($condition, $_field . ' nc_distinct,' . $field, $page, $order, $limit, $_distinct, false, $count);
        return $goods_list;
    }

    /**
     * 普通列表，即不包括虚拟商品、F码商品、预售商品、预定商品
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @param boolean $lock 是否锁定
     * @return array
     */
    public function getGeneralGoodsList($condition, $field = '*', $page = 0, $order = 'goods_id desc')
    {
        $condition['is_virtual'] = 0;
        $condition['is_fcode'] = 0;
        $condition['is_presell'] = 0;
        $condition['is_book'] = 0;
        return $this->getGoodsList($condition, $field, '', $order, 0, $page, 0);
    }

    /**
     * 出售中普通列表，即不包括虚拟商品、F码商品、预售商品、预定商品
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @param boolean $lock 是否锁定
     * @return array
     */
    public function getGeneralGoodsOnlineList($condition, $field = '*', $page = 0, $order = 'goods_id desc')
    {
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGeneralGoodsList($condition, $field, $page, $order);
    }

    /**
     * 在售商品SKU列表
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @param boolean $lock 是否锁定
     * @return array
     */
    public function getGoodsOnlineList($condition, $field = '*', $page = 0, $order = 'goods_id desc', $limit = 0, $group = '', $lock = false, $count = 0)
    {
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsList($condition, $field, $group, $order, $limit, $page, $count);
    }

    /**
     * 商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonList($condition, $field = '*', $page = 10, $order = 'goods_commonid desc', $limit = '')
    {
        $condition = $this->_getRecursiveClass($condition);
        return $this->table('goods_common')->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
    }

    /**
     * 出售中的商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonOnlineList($condition, $field = '*', $page = 10, $order = "goods_commonid desc")
    {
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsCommonList($condition, $field, $page, $order);
    }

    /**
     * 出售中的普通商品列表，即不包括虚拟商品、F码商品、预售商品
     */
    public function getGeneralGoodsCommonList($condition, $field = '*', $page = 10)
    {
        $condition['is_virtual'] = 0;
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsCommonList($condition, $field, $page);
    }

    /**
     * 出售中的未参加促销的虚拟商品列表
     */
    public function getVrGoodsCommonList($condition, $field = '*', $page = 10)
    {
        $condition['is_virtual'] = 1;
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsCommonList($condition, $field, $page);
    }

    /**
     * 仓库中的商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonOfflineList($condition, $field = '*', $page = 10, $order = "goods_commonid desc")
    {
        $condition['goods_state'] = self::STATE0;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsCommonList($condition, $field, $page, $order);
    }

    /**
     * 违规的商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonLockUpList($condition, $field = '*', $page = 10, $order = "goods_commonid desc", $limit = '')
    {
        $condition['goods_state'] = self::STATE10;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsCommonList($condition, $field, $page, $order, $limit);
    }

    /**
     * 等待审核或审核失败的商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonWaitVerifyList($condition, $field = '*', $page = 10, $order = "goods_commonid desc", $limit = '')
    {
        if (!isset($condition['goods_verify'])) {
            $condition['goods_verify'] = array('neq', self::VERIFY1);
        }
        return $this->getGoodsCommonList($condition, $field, $page, $order, $limit);
    }

    /**
     * 查询商品SUK及其医生信息
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getGoodsStoreList($condition, $field = '*')
    {
        $condition = $this->_getRecursiveClass($condition);
        return $this->table('goods,store')->field($field)->join('inner')->on('goods.store_id = store.store_id')->where($condition)->select();
    }

    /**
     * 查询推荐商品(随机排序)
     *
     * @param int $store_id 医生
     * @param int $limit 限制
     * @return array
     */
    public function getGoodsCommendList($store_id, $limit = 5)
    {
        $goods_commend_list = $this->getGoodsOnlineList(array('store_id' => $store_id, 'goods_commend' => 1), 'goods_id,goods_name,goods_jingle,goods_image,store_id,goods_promotion_price', 0, 'rand()', $limit, 'goods_commonid');
        if (!empty($goods_id_list)) {
            $tmp = array();
            foreach ($goods_id_list as $v) {
                $tmp[] = $v['goods_id'];
            }
            $goods_commend_list = $this->getGoodsOnlineList(array('goods_id' => array('in', $tmp)), 'goods_id,goods_name,goods_jingle,goods_image,store_id,goods_promotion_price', 0, 'rand()', $limit);
        }
        return $goods_commend_list;
    }

    /**
     * 计算商品库存
     *
     * @param array $goods_list
     * @return array|boolean
     */
    public function calculateStorage($goods_list)
    {
        // 计算库存
        if (!empty($goods_list)) {
            $goodsid_array = array();
            foreach ($goods_list as $value) {
                $goodscommonid_array[] = $value['goods_commonid'];
            }
            $goods_storage = $this->getGoodsList(array('goods_commonid' => array('in', $goodscommonid_array)), 'goods_storage,goods_commonid,goods_id,goods_storage_alarm', '', '', false);
            $storage_array = array();
            foreach ($goods_storage as $val) {
                if ($val['goods_storage_alarm'] != 0 && $val['goods_storage'] <= $val['goods_storage_alarm']) {
                    $storage_array[$val['goods_commonid']]['alarm'] = true;
                }
                $storage_array[$val['goods_commonid']]['sum'] += $val['goods_storage'];
                $storage_array[$val['goods_commonid']]['goods_id'] = $val['goods_id'];
            }
            return $storage_array;
        } else {
            return false;
        }
    }

    /**
     * 更新商品SUK数据
     *
     * @param array $update 更新数据
     * @param array $condition 条件
     * @return boolean
     */
    public function editGoods($update, $condition, $updateXS = false)
    {
        $goods_list = $this->getGoodsList($condition, 'goods_id');
        if (empty($goods_list)) {
            return true;
        }
        $goodsid_array = array();
        foreach ($goods_list as $value) {
            $goodsid_array[] = $value['goods_id'];
        }
        return $this->editGoodsById($update, $goodsid_array, $updateXS);
    }

    /**
     * 更新商品SUK数据
     * @param array $update
     * @param int|array $goodsid_array
     * @return boolean|unknown
     */
    public function editGoodsById($update, $goodsid_array, $updateXS = false)
    {
        if (empty($goodsid_array)) {
            return true;
        }
        $condition['goods_id'] = array('in', $goodsid_array);
        $update['goods_edittime'] = TIMESTAMP;
        $result = $this->table('goods')->where($condition)->update($update);
        if ($result) {
            foreach ((array)$goodsid_array as $value) {
                $this->_dGoodsCache($value);
            }
            if (getConfig('fullindexer.open') && $updateXS) {
                QueueClient::push('updateXS', $goodsid_array);
            }
        }
        return $result;
    }

    /**
     * 更新商品促销价 (需要验证抢购和限时折扣是否进行)
     *
     * @param array $update 更新数据
     * @param array $condition 条件
     * @return boolean
     */
    public function editGoodsPromotionPrice($condition)
    {
        $goods_list = $this->getGoodsList($condition, '*');
        $goods_array = array();
        foreach ($goods_list as $val) {
            $goods_array[$val['goods_commonid']][$val['goods_id']] = $val;
        }
        $model_groupbuy = Model('groupbuy');
        $model_xianshigoods = Model('p_xianshi_goods');
        foreach ($goods_array as $key => $val) {
            // 验证预定商品是否进行
            foreach ($val as $k => $v) {
                if ($v['is_book'] == '1') {
                    if ($v['book_down_time'] > time()) {
                        // 更新价格
                        $this->editGoodsById(array('goods_promotion_price' => ($v['book_down_payment'] + $v['book_final_payment']), 'goods_promotion_type' => 0), $k);
                    } else {
                        $this->editGoodsById(array('is_book' => 0, 'book_down_payment' => 0, 'book_final_payment' => 0, 'book_down_time' => 0), $k);
                    }
                }
            }
            // 查询抢购是否进行
            $groupbuy = $model_groupbuy->getGroupbuyOnlineInfo(array('goods_commonid' => $key));
            if (!empty($groupbuy)) {
                // 更新价格
                $this->editGoods(array('goods_promotion_price' => $groupbuy['groupbuy_price'], 'goods_promotion_type' => 1), array('goods_commonid' => $key, 'is_book' => 0));
                continue;
            }
            foreach ($val as $k => $v) {
                if ($v['is_book'] == '1') {
                    continue;
                }
                // 查询限时折扣是否进行
                $xianshigoods = $model_xianshigoods->getXianshiGoodsInfo(array('goods_id' => $k, 'start_time' => array('lt', TIMESTAMP), 'end_time' => array('gt', TIMESTAMP)));
                if (!empty($xianshigoods)) {
                    // 更新价格
                    $this->editGoodsById(array('goods_promotion_price' => $xianshigoods['xianshi_price'], 'goods_promotion_type' => 2), $k);
                    continue;
                }

                // 没有促销使用原价
                $this->editGoodsById(array('goods_promotion_price' => array('exp', 'goods_price'), 'goods_promotion_type' => 0), $k);
            }
        }
        return true;
    }

    /**
     * 更新商品数据
     * @param array $update 更新数据
     * @param array $condition 条件
     * @return boolean
     */
    public function editGoodsCommon($update, $condition)
    {
        $common_list = $this->getGoodsCommonList($condition, 'goods_commonid', 0);
        if (empty($common_list)) {
            return false;
        }
        $commonid_array = array();
        foreach ($common_list as $val) {
            $commonid_array[] = $val['goods_commonid'];
        }
        return $this->editGoodsCommonById($update, $commonid_array);
    }

    /**
     * 更新商品数据
     * @param array $update
     * @param int|array $commonid_array
     * @return boolean|unknown
     */
    public function editGoodsCommonById($update, $commonid_array)
    {
        if (empty($commonid_array)) {
            return true;
        }
        $condition['goods_commonid'] = array('in', $commonid_array);
        $result = $this->table('goods_common')->where($condition)->update($update);
        if ($result) {
            foreach ((array)$commonid_array as $val) {
                $this->_dGoodsCommonCache($val);
            }
        }
        return $result;
    }

    /**
     * 锁定商品
     * @param unknown $condition
     * @return boolean
     */
    public function editGoodsCommonLock($condition)
    {
        $update = array('goods_lock' => 1);
        return $this->editGoodsCommon($update, $condition);
    }

    /**
     * 解锁商品
     * @param unknown $condition
     * @return boolean
     */
    public function editGoodsCommonUnlock($condition)
    {
        $update = array('goods_lock' => 0);
        return $this->editGoodsCommon($update, $condition);
    }

    /**
     * 更新商品信息
     *
     * @param array $condition
     * @param array $update1
     * @param array $update2
     * @return boolean
     */
    public function editProduces($condition, $update1, $update2 = array(), $updateXS = false)
    {
        $update2 = empty($update2) ? $update1 : $update2;
        $goods_array = $this->getGoodsCommonList($condition, 'goods_commonid', 0);
        if (empty($goods_array)) {
            return true;
        }
        $commonid_array = array();
        foreach ($goods_array as $val) {
            $commonid_array[] = $val['goods_commonid'];
        }
        $return1 = $this->editGoodsCommonById($update1, $commonid_array);
        $return2 = $this->editGoods($update2, array('goods_commonid' => array('in', $commonid_array)), $updateXS);
        if ($return1 && $return2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新商品信息（审核失败）
     *
     * @param array $condition
     * @param array $update1
     * @param array $update2
     * @return boolean
     */
    public function editProducesVerifyFail($condition, $update1, $update2 = array())
    {
        $result = $this->editProduces($condition, $update1, $update2);
        if ($result) {
            $commonlist = $this->getGoodsCommonList($condition, 'goods_commonid,store_id,goods_verifyremark', 0);
            foreach ($commonlist as $val) {
                $param = array();
                $param['common_id'] = $val['goods_commonid'];
                $param['remark'] = $val['goods_verifyremark'];
                $this->_sendStoreMsg('goods_verify', $val['store_id'], $param);
            }
        }
    }

    /**
     * 更新未锁定商品信息
     *
     * @param array $condition
     * @param array $update1
     * @param array $update2
     * @return boolean
     */
    public function editProducesNoLock($condition, $update1, $update2 = array(), $updateXS = false)
    {
        $condition['goods_lock'] = 0;
        return $this->editProduces($condition, $update1, $update2, $updateXS);
    }

    /**
     * 商品下架
     * @param array $condition 条件
     * @return boolean
     */
    public function editProducesOffline($condition)
    {
        $update = array('goods_state' => self::STATE0);
        return $this->editProducesNoLock($condition, $update, array(), true);
    }

    /**
     * 商品上架
     * @param array $condition 条件
     * @return boolean
     */
    public function editProducesOnline($condition)
    {
        $update = array('goods_state' => self::STATE1);
        // 禁售商品、审核失败商品不能上架。
        $condition['goods_state'] = self::STATE0;
        $condition['goods_verify'] = array('neq', self::VERIFY0);
        return $this->editProduces($condition, $update);
    }

    /**
     * 违规下架
     *
     * @param array $update
     * @param array $condition
     * @return boolean
     */
    public function editProducesLockUp($update, $condition)
    {
        $update_param['goods_state'] = self::STATE10;
        $update = array_merge($update, $update_param);
        $return = $this->editProduces($condition, $update, $update_param, true);
        if ($return) {
            // 商品违规下架发送医生消息
            $common_list = $this->getGoodsCommonList($condition, 'goods_commonid,store_id,goods_stateremark', 0);
            foreach ($common_list as $val) {
                $param = array();
                $param['remark'] = $val['goods_stateremark'];
                $param['common_id'] = $val['goods_commonid'];
                $this->_sendStoreMsg('goods_violation', $val['store_id'], $param);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取单条商品SKU信息
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getGoodsInfo($condition, $field = '*')
    {
        return $this->table('goods')->field($field)->where($condition)->find();
    }

    /**
     * 获取单条商品SKU信息及其促销信息
     *
     * @param int $goods_id
     * @param string $field
     * @return array
     */
    public function getGoodsOnlineInfoForShare($goods_id)
    {
        $goods_info = $this->getGoodsOnlineInfoAndPromotionById($goods_id);
        if (empty($goods_info)) {
            return array();
        }
        //抢购
        if (isset($goods_info['groupbuy_info'])) {
            $goods_info['promotion_type'] = '抢购';
            $goods_info['promotion_price'] = $goods_info['groupbuy_info']['groupbuy_price'];
        }

        if (isset($goods_info['xianshi_info'])) {
            $goods_info['promotion_type'] = '限时折扣';
            $goods_info['promotion_price'] = $goods_info['xianshi_info']['xianshi_price'];
        }
        return $goods_info;
    }

    /**
     * 查询出售中的商品详细信息及其促销信息
     * @param int $goods_id
     * @return array
     */
    public function getGoodsOnlineInfoAndPromotionById($goods_id)
    {
        $goods_info = $this->getGoodsInfoAndPromotionById($goods_id);
        if (empty($goods_info) || $goods_info['goods_state'] != self::STATE1 || $goods_info['goods_verify'] != self::VERIFY1) {
            return array();
        }
        return $goods_info;
    }

    /**
     * 查询商品详细信息及其促销信息
     * @param int $goods_id
     * @return array
     */
    public function getGoodsInfoAndPromotionById($goods_id)
    {
        $goods_info = $this->getGoodsInfoByID($goods_id);
        if (empty($goods_info)) {
            return array();
        }
        // 手机专享
        if (getConfig('promotion_allow') && APP_ID == 'mobile') {
            $goods_info['sole_info'] = Model('p_sole')->getSoleGoodsInfoOpenByGoodsID($goods_info['goods_id']);
        }

        //抢购
        if (getConfig('groupbuy_allow') && empty($goods_info['sole_info'])) {
            $goods_info['groupbuy_info'] = Model('groupbuy')->getGroupbuyInfoByGoodsCommonID($goods_info['goods_commonid']);
        }

        //限时折扣
        if (getConfig('promotion_allow') && empty($goods_info['sole_info']) && empty($goods_info['groupbuy_info'])) {
            $goods_info['xianshi_info'] = Model('p_xianshi_goods')->getXianshiGoodsInfoByGoodsID($goods_info['goods_id']);
        }

        // 加价购
        if (getConfig('promotion_allow')) {
            $goods_info['jjg_info'] = Model('p_cou')->getCachedRelationalCouDetailBySingleSku($goods_info['goods_id']);
        }

        return $goods_info;
    }

    /**
     * 查询出售中的商品列表及其促销信息
     * @param array $goodsid_array
     * @return array
     */
    public function getGoodsOnlineListAndPromotionByIdArray($goodsid_array)
    {
        if (empty($goodsid_array) || !is_array($goodsid_array)) return array();

        $goods_list = array();
        foreach ($goodsid_array as $goods_id) {
            $goods_info = $this->getGoodsOnlineInfoAndPromotionById($goods_id);
            if (!empty($goods_info)) $goods_list[] = $goods_info;
        }

        return $goods_list;
    }

    /**
     * 获取单条商品信息
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getGoodsCommonInfo($condition, $field = '*')
    {
        return $this->table('goods_common')->field($field)->where($condition)->find();
    }

    /**
     * 取得商品详细信息（优先查询缓存）
     * 如果未找到，则缓存所有字段
     * @param int $goods_commonid
     * @param string $fields 需要取得的缓存键值, 例如：'*','goods_name,store_name'
     * @return array
     */
    public function getGoodsCommonInfoByID($goods_commonid, $fields = '*')
    {
        $common_info = $this->_rGoodsCommonCache($goods_commonid, $fields);
        if (empty($common_info)) {
            $common_info = $this->getGoodsCommonInfo(array('goods_commonid' => $goods_commonid));
            $this->_wGoodsCommonCache($goods_commonid, $common_info);
        }
        return $common_info;
    }

    /**
     * 获得商品SKU某字段的和
     *
     * @param array $condition
     * @param string $field
     * @return boolean
     */
    public function getGoodsSum($condition, $field)
    {
        return $this->table('goods')->where($condition)->sum($field);
    }

    /**
     * 获得商品SKU数量
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getGoodsCount($condition)
    {
        return $this->table('goods')->where($condition)->count();
    }

    /**
     * 获得出售中商品SKU数量
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getGoodsOnlineCount($condition, $field = '*')
    {
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->table('goods')->where($condition)->group('')->count1($field);
    }

    /**
     * 获得商品数量
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getGoodsCommonCount($condition)
    {
        return $this->table('goods_common')->where($condition)->count();
    }

    /**
     * 出售中的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonOnlineCount($condition)
    {
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 仓库中的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonOfflineCount($condition)
    {
        $condition['goods_state'] = self::STATE0;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 等待审核的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonWaitVerifyCount($condition)
    {
        $condition['goods_verify'] = self::VERIFY10;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 审核失败的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonVerifyFailCount($condition)
    {
        $condition['goods_verify'] = self::VERIFY0;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 违规下架的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonLockUpCount($condition)
    {
        $condition['goods_state'] = self::STATE10;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 商品图片列表
     *
     * @param array $condition
     * @param array $order
     * @param string $field
     * @return array
     */
    public function getGoodsImageList($condition, $field = '*', $order = 'is_default desc,goods_image_sort asc')
    {
        $this->cls();
        return $this->table('goods_images')->field($field)->where($condition)->order($order)->select();
    }

    /**
     * 删除商品SKU信息
     *
     * @param array $condition
     * @return boolean
     */
    public function delGoods($condition)
    {
        $goods_list = $this->getGoodsList($condition, 'goods_id,goods_commonid,store_id');
        if (!empty($goods_list)) {
            $goodsid_array = array();
            // 删除商品二维码
            foreach ($goods_list as $val) {
                $goodsid_array[] = $val['goods_id'];
                @unlink(BASE_UPLOAD_PATH . DS . ATTACH_STORE . DS . $val['store_id'] . DS . $val['goods_id'] . '.png');
                // 删除商品缓存
                $this->_dGoodsCache($val['goods_id']);
                // 删除商品规格缓存
                $this->_dGoodsSpecCache($val['goods_commonid']);
            }

            if (getConfig('fullindexer.open')) {
                QueueClient::push('updateXS', $goodsid_array);
            }
            // 删除属性关联表数据
            $this->table('goods_attr_index')->where(array('goods_id' => array('in', $goodsid_array)))->delete();
            // 删除优惠套装商品
            Model('p_bundling')->delBundlingGoods(array('goods_id' => array('in', $goodsid_array)));
            // 优惠套餐活动下架
            Model('p_bundling')->editBundlingCloseByGoodsIds(array('goods_id' => array('in', $goodsid_array)));
            // 推荐展位商品
            Model('p_booth')->delBoothGoods(array('goods_id' => array('in', $goodsid_array)));
            // 限时折扣
            Model('p_xianshi_goods')->delXianshiGoods(array('goods_id' => array('in', $goodsid_array)));
            //删除商品浏览记录
            Model('goods_browse')->delGoodsbrowse(array('goods_id' => array('in', $goodsid_array)));
            // 删除买家收藏表数据
            Model('favorites')->delFavorites(array('fav_id' => array('in', $goodsid_array), 'fav_type' => 'goods'));
            // 删除商品赠品
            Model('goods_gift')->delGoodsGift(array('goods_id' => array('in', $goodsid_array), 'gift_goodsid' => array('in', $goodsid_array), '_op' => 'or'));
            // 删除推荐组合
            Model('p_combo_goods')->delComboGoods(array('goods_id' => array('in', $goodsid_array), 'combo_goodsid' => array('in', $goodsid_array), '_op' => 'or'));
            // 删除商品F码
            Model('goods_fcode')->delGoodsFCode(array('goods_id' => array('in', $goodsid_array)));
            // 删除门店商品关联
            Model('chain_stock')->delChainStock(array('goods_id' => array('in', $goodsid_array)));
        }
        return $this->table('goods')->where($condition)->delete();
    }

    /**
     * 删除商品图片表信息
     *
     * @param array $condition
     * @return boolean
     */
    public function delGoodsImages($condition)
    {
        $image_list = $this->getGoodsImageList($condition, 'goods_commonid,color_id');
        if (empty($image_list)) {
            return true;
        }
        $result = $this->table('goods_images')->where($condition)->delete();
        if ($result) {
            foreach ($image_list as $val) {
                $this->_dGoodsImageCache($val['goods_commonid'] . '|' . $val['color_id']);
            }
        }
        return $result;
    }

    /**
     * 商品删除及相关信息
     *
     * @param   array $condition 列表条件
     * @return boolean
     */
    public function delGoodsAll($condition)
    {
        $common_list = $this->getGoodsCommonList($condition, 'goods_commonid,store_id');
        if (empty($common_list)) {
            return false;
        }
        $commonid_array = array();
        foreach ($common_list as $val) {
            $commonid_array[] = $val['goods_commonid'];
            // 商品公共缓存
            $this->_dGoodsCommonCache($val['goods_commonid']);
            // 商品规格缓存
            $this->_dGoodsSpecCache($val['goods_commonid']);
        }
        $commonid_array = array_unique($commonid_array);

        // 删除商品表数据
        $this->delGoods(array('goods_commonid' => array('in', $commonid_array)));
        // 删除商品公共表数据
        $this->table('goods_common')->where(array('goods_commonid' => array('in', $commonid_array)))->delete();
        // 删除商品图片表数据
        $this->delGoodsImages(array('goods_commonid' => array('in', $commonid_array)));
        return true;
    }

    /**
     * 删除未锁定商品
     * @param unknown $condition
     */
    public function delGoodsNoLock($condition)
    {
        $condition['goods_lock'] = 0;
        $common_array = $this->getGoodsCommonList($condition, 'goods_commonid', 0);
        $common_array = array_under_reset($common_array, 'goods_commonid');
        $commonid_array = array_keys($common_array);
        return $this->delGoodsAll(array('goods_commonid' => array('in', $commonid_array)));
    }

    /**
     * 发送医生消息
     * @param string $code
     * @param int $store_id
     * @param array $param
     */
    private function _sendStoreMsg($code, $store_id, $param)
    {
        QueueClient::push('sendStoreMsg', array('code' => $code, 'store_id' => $store_id, 'param' => $param));
    }

    /**
     * 获得商品子分类的ID
     * @param array $condition
     * @return array
     */
    private function _getRecursiveClass($condition)
    {
        if (isset($condition['gc_id']) && !is_array($condition['gc_id'])) {
            $gc_list = Model('goods_class')->getGoodsClassForCacheModel();
            if (!empty($gc_list[$condition['gc_id']])) {
                $gc_id[] = $condition['gc_id'];
                $gcchild_id = empty($gc_list[$condition['gc_id']]['child']) ? array() : explode(',', $gc_list[$condition['gc_id']]['child']);
                $gcchildchild_id = empty($gc_list[$condition['gc_id']]['childchild']) ? array() : explode(',', $gc_list[$condition['gc_id']]['childchild']);
                $gc_id = array_merge($gc_id, $gcchild_id, $gcchildchild_id);
                $condition['gc_id'] = array('in', $gc_id);
            }
        }
        return $condition;
    }

    /**
     * 由ID取得在售单个虚拟商品信息
     * @param unknown $goods_id
     * @param string $field 需要取得的缓存键值, 例如：'*','goods_name,store_name'
     * @return array
     */
    public function getVirtualGoodsOnlineInfoByID($goods_id)
    {
        $goods_info = $this->getGoodsInfoByID($goods_id, '*');
        return $goods_info['is_virtual'] == 1 && $goods_info['virtual_indate'] >= TIMESTAMP ? $goods_info : array();
    }

    /**
     * 取得商品详细信息（优先查询缓存）（在售）
     * 如果未找到，则缓存所有字段
     * @param int $goods_id
     * @param string $field 需要取得的缓存键值, 例如：'*','goods_name,store_name'
     * @return array
     */
    public function getGoodsOnlineInfoByID($goods_id, $field = '*')
    {
        if ($field != '*') {
            $field .= ',goods_state,goods_verify';
        }
        $goods_info = $this->getGoodsInfoByID($goods_id, trim($field, ','));
        if ($goods_info['goods_state'] != self::STATE1 || $goods_info['goods_verify'] != self::VERIFY1) {
            $goods_info = array();
        }
        return $goods_info;
    }

    /**
     * 取得商品详细信息（优先查询缓存）
     * 如果未找到，则缓存所有字段
     * @param int $goods_id
     * @param string $fields 需要取得的缓存键值, 例如：'*','goods_name,store_name'
     * @return array
     */
    public function getGoodsInfoByID($goods_id, $fields = '*')
    {
        $goods_info = $this->_rGoodsCache($goods_id, $fields);
        if (empty($goods_info)) {
            $goods_info = $this->getGoodsInfo(array('goods_id' => $goods_id));
            $this->_wGoodsCache($goods_id, $goods_info);
        }
        return $goods_info;
    }

    /**
     * 验证是否为普通商品
     * @param array $goods 商品数组
     * @return boolean
     */
    public function checkIsGeneral($goods)
    {
        if ($goods['is_virtual'] == 1 || $goods['is_fcode'] == 1 || $goods['is_presell'] == 1 || $goods['is_book'] == 1) {
            return false;
        }
        return true;
    }

    public function checkOnline($goods)
    {
        if ($goods['goods_state'] == 1 && $goods['goods_verify'] == 1) {
            return true;
        }
        return false;
    }

    /**
     * 验证是否允许送赠品
     * @param unknown $goods
     * @return boolean
     */
    public function checkGoodsIfAllowGift($goods)
    {
        if ($goods['is_virtual'] == 1) {
            return false;
        }
        return true;
    }

    /**
     * 获得商品规格数组
     * @param unknown $common_id
     */
    public function getGoodsSpecListByCommonId($common_id)
    {
        $spec_list = $this->_rGoodsSpecCache($common_id);
        if (empty($spec_list)) {
            $spec_array = $this->getGoodsList(array('goods_commonid' => $common_id), 'goods_spec,goods_id,store_id,goods_image,color_id');
            $spec_list['spec'] = serialize($spec_array);
            $this->_wGoodsSpecCache($common_id, $spec_list);
        }
        $spec_array = unserialize($spec_list['spec']);
        return $spec_array;
    }

    /**
     * 获得商品图片数组
     * @param int $goods_id
     * @param array $condition
     */
    public function getGoodsImageByKey($key)
    {
        $image_list = $this->_rGoodsImageCache($key);
        if (empty($image_list)) {
            $array = explode('|', $key);
            list($common_id, $color_id) = $array;
            $image_more = $this->getGoodsImageList(array('goods_commonid' => $common_id, 'color_id' => $color_id), 'goods_image');
            $image_list['image'] = serialize($image_more);
            $this->_wGoodsImageCache($key, $image_list);
        }
        $image_more = unserialize($image_list['image']);
        return $image_more;
    }

    /**
     * 读取商品缓存
     * @param int $goods_id
     * @param string $fields
     * @return array
     */
    private function _rGoodsCache($goods_id, $fields)
    {
        return read_file_cache($goods_id, false, null, 'goods/');
    }

    /**
     * 写入商品缓存
     * @param int $goods_id
     * @param array $goods_info
     * @return boolean
     */
    private function _wGoodsCache($goods_id, $goods_info)
    {
        return write_file_cache($goods_id, $goods_info, null, 'goods/');
    }

    /**
     * 删除商品缓存
     * @param int $goods_id
     * @return boolean
     */
    private function _dGoodsCache($goods_id)
    {
        return delete_file_cache($goods_id, 'goods/');
    }

    /**
     * 读取商品公共缓存
     * @param int $goods_commonid
     * @param string $fields
     * @return array
     */
    private function _rGoodsCommonCache($goods_commonid, $fields)
    {
        return read_file_cache($goods_commonid, false, null, 'goods_common/');
    }

    /**
     * 写入商品公共缓存
     * @param int $goods_commonid
     * @param array $common_info
     * @return boolean
     */
    private function _wGoodsCommonCache($goods_commonid, $common_info)
    {
        return write_file_cache($goods_commonid, $common_info, null, 'goods_common/');
    }

    /**
     * 删除商品公共缓存
     * @param int $goods_commonid
     * @return boolean
     */
    private function _dGoodsCommonCache($goods_commonid)
    {
        return delete_file_cache($goods_commonid, 'goods_common/');
    }

    /**
     * 读取商品规格缓存
     * @param int $goods_commonid
     * @param string $fields
     * @return array
     */
    private function _rGoodsSpecCache($goods_commonid)
    {
        return read_file_cache($goods_commonid, false, null, 'goods_spec/');
    }

    /**
     * 写入商品规格缓存
     * @param int $goods_commonid
     * @param array $spec_list
     * @return boolean
     */
    private function _wGoodsSpecCache($goods_commonid, $spec_list)
    {
        return write_file_cache($goods_commonid, $spec_list, null, 'goods_spec/');
    }

    /**
     * 删除商品规格缓存
     * @param int $goods_commonid
     * @return boolean
     */
    private function _dGoodsSpecCache($goods_commonid)
    {
        return delete_file_cache($goods_commonid, 'goods_spec/');
    }

    /**
     * 读取商品图片缓存
     * @param int $key ($goods_commonid .'|'. $color_id)
     * @param string $fields
     * @return array
     */
    private function _rGoodsImageCache($key)
    {
        return read_file_cache($key, false, null, 'goods_image/');
    }

    /**
     * 写入商品图片缓存
     * @param int $key ($goods_commonid .'|'. $color_id)
     * @param array $image_list
     * @return boolean
     */
    private function _wGoodsImageCache($key, $image_list)
    {
        return write_file_cache($key, $image_list, null, 'goods_image/');
    }

    /**
     * 删除商品图片缓存
     * @param int $key ($goods_commonid .'|'. $color_id)
     * @return boolean
     */
    private function _dGoodsImageCache($key)
    {
        return delete_file_cache($key, 'goods_image/');
    }

    /**
     * 获取单条商品信息
     *
     * @param int $goods_id
     * @return array
     */
    public function getGoodsDetail($goods_id)
    {
        if ($goods_id <= 0) {
            return null;
        }
        $result1 = $this->getGoodsInfoAndPromotionById($goods_id);

        if (empty($result1)) {
            return null;
        }
        if ($result1['goods_body'] == '') unset($result1['goods_body']);
        if ($result1['mobile_body'] == '') unset($result1['mobile_body']);
        $result2 = $this->getGoodsCommonInfoByID($result1['goods_commonid']);
        $goods_info = array_merge($result2, $result1);

        $goods_info['spec_value'] = unserialize($goods_info['spec_value']);
        $goods_info['spec_name'] = unserialize($goods_info['spec_name']);
        $goods_info['goods_spec'] = unserialize($goods_info['goods_spec']);
        $goods_info['goods_attr'] = unserialize($goods_info['goods_attr']);
        $goods_info['goods_custom'] = unserialize($goods_info['goods_custom']);

        // 手机商品描述
        if ($goods_info['mobile_body'] != '') {
            $mobile_body_array = unserialize($goods_info['mobile_body']);
            $mobile_body = '';
            if (is_array($mobile_body_array)) {
                foreach ($mobile_body_array as $val) {
                    switch ($val['type']) {
                        case 'text':
                            $mobile_body .= '<div>' . $val['value'] . '</div>';
                            break;
                        case 'image':
                            $mobile_body .= '<img src="' . $val['value'] . '">';
                            break;
                    }
                }
            }
            $goods_info['mobile_body'] = $mobile_body;
        }

        // 查询所有规格商品
        $spec_array = $this->getGoodsSpecListByCommonId($goods_info['goods_commonid']);
        $spec_list = array();       // 各规格商品地址，js使用
        $spec_list_mobile = array();       // 各规格商品地址，js使用
        $spec_image = array();      // 各规格商品主图，规格颜色图片使用
        foreach ($spec_array as $key => $value) {
            $s_array = unserialize($value['goods_spec']);
            $tmp_array = array();
            if (!empty($s_array) && is_array($s_array)) {
                foreach ($s_array as $k => $v) {
                    $tmp_array[] = $k;
                }
            }
            sort($tmp_array);
            $spec_sign = implode('|', $tmp_array);
            $tpl_spec = array();
            $tpl_spec['sign'] = $spec_sign;
            $tpl_spec['url'] = getUrl('shop/goods/index', array('goods_id' => $value['goods_id']));
            $spec_list[] = $tpl_spec;
            $spec_list_mobile[$spec_sign] = $value['goods_id'];
            $spec_image[$value['color_id']] = thumb($value, 60);
        }
        $spec_list = json_encode($spec_list);

        // 商品多图
        $image_more = $this->getGoodsImageByKey($goods_info['goods_commonid'] . '|' . $goods_info['color_id']);
        $goods_image = array();
        $goods_image_mobile = array();
        if (!empty($image_more)) {
            array_splice($image_more, 5);
            foreach ($image_more as $val) {

                //放大镜
                $goods_image[] = array(cthumb($val['goods_image'], 60, $goods_info['store_id']), cthumb($val['goods_image'], 360, $goods_info['store_id']), cthumb($val['goods_image'], 1280, $goods_info['store_id']));
                $goods_image_mobile[] = cthumb($val['goods_image'], 360, $goods_info['store_id']);
            }
        } else {
            // 33 ha o.co m V4. 2 修复编辑产品保存后，无法显示图片
            $goods_image[] = array(thumb($goods_info, 60), thumb($goods_info, 360), thumb($goods_info, 1280));
            $goods_image_mobile[] = thumb($goods_info, 360);
        }


        if ($goods_info['is_book'] != '1') {
            //限时折扣
            if (!empty($goods_info['xianshi_info'])) {
                $goods_info['promotion_type'] = 'xianshi';
                $goods_info['title'] = $goods_info['xianshi_info']['xianshi_title'];
                $goods_info['remark'] = $goods_info['xianshi_info']['xianshi_title'];
                $goods_info['promotion_price'] = $goods_info['xianshi_info']['xianshi_price'];
                $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['xianshi_info']['xianshi_price']);
                $goods_info['lower_limit'] = $goods_info['xianshi_info']['lower_limit'];
                $goods_info['explain'] = $goods_info['xianshi_info']['xianshi_explain'];
                $goods_info['xs_time'] = $goods_info['xianshi_info']['end_time'];
                unset($goods_info['xianshi_info']);
            }
            //抢购
            if (!empty($goods_info['groupbuy_info'])) {
                $goods_info['promotion_type'] = 'groupbuy';
                $goods_info['title'] = '抢购';
                $goods_info['remark'] = $goods_info['groupbuy_info']['remark'];
                $goods_info['promotion_price'] = $goods_info['groupbuy_info']['groupbuy_price'];
                $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['groupbuy_info']['groupbuy_price']);
                $goods_info['upper_limit'] = $goods_info['groupbuy_info']['upper_limit'];
                unset($goods_info['groupbuy_info']);
            }
            // 手机专享
            if (!empty($goods_info['sole_info'])) {
                $goods_info['promotion_type'] = 'sole';
                $goods_info['title'] = '手机专享';
                $goods_info['promotion_price'] = $goods_info['sole_info']['sole_price'];
                unset($goods_info['sole_info']);
            }
            // 加价购
            if (!empty($goods_info['jjg_info'])) {
                $jjgFirstLevel = $goods_info['jjg_info']['firstLevel'];
                if ($jjgFirstLevel && $jjgFirstLevel['mincost'] > 0) {
                    $goods_info['jjg_explain'] = sprintf(
                        '购满<em>&yen;%.2f</em>，再加<em>&yen;%.2f</em>，可换购商品',
                        $jjgFirstLevel['mincost'],
                        $jjgFirstLevel['plus']
                    );
                }
            }

            // 验证是否允许送赠品
            if ($this->checkGoodsIfAllowGift($goods_info)) {
                $gift_array = Model('goods_gift')->getGoodsGiftListByGoodsId($goods_id);
                if (!empty($gift_array)) {
                    $goods_info['have_gift'] = 'gift';
                }
            }

            //满即送
            $mansong_info = ($goods_info['is_virtual'] == 1) ? array() : Model('p_mansong')->getMansongInfoByStoreID($goods_info['store_id']);
        }

        // 加入购物车按钮
        $goods_info['cart'] = 1;
        //虚拟、F码、预售不显示加入购物车，不显示门店
        if ($goods_info['is_virtual'] == 1 || $goods_info['is_fcode'] == 1 || $goods_info['is_presell'] == 1 || $goods_info['is_book'] == 1) {
            $goods_info['is_chain'] = 0;
            $goods_info['cart'] = 0;
        }

        // 立即购买按钮
        $goods_info['buynow'] = 1;
        // 加价购不显示立即购买按钮
        if (!empty($goods_info['jjg_info'])) {
            $goods_info['buynow'] = 0;
        }

        // 立即购买文字显示
        $goods_info['buynow_text'] = '立即购买';
        if ($goods_info['is_presell'] == 1) {
            $goods_info['buynow_text'] = '预售购买';
        } elseif ($goods_info['is_book'] == 1) {
            $goods_info['buynow_text'] = '支付定金';
        } elseif ($goods_info['is_fcode'] == 1) {
            $goods_info['buynow_text'] = 'F码购买';
        }


        $model_plate = Model('store_plate');
        // 顶部关联版式
        $goods_body = '';
        if ($goods_info['plateid_top'] > 0) {
            $plate_top = $model_plate->getStorePlateInfoByID($goods_info['plateid_top']);
            if (!empty($plate_top)) $goods_body .= '<div class="top-template">' . $plate_top['plate_content'] . '</div>';
        }
        $goods_body .= '<div class="default">' . $goods_info['goods_body'] . '</div>';
        // 底部关联版式
        if ($goods_info['plateid_bottom'] > 0) {
            $plate_bottom = $model_plate->getStorePlateInfoByID($goods_info['plateid_bottom']);
            if (!empty($plate_bottom)) $goods_body .= '<div class="bottom-template">' . $plate_bottom['plate_content'] . '</div>';
        }
        $goods_info['goods_body'] = $goods_body;

        // 商品受关注次数加1
        $goods_info['goods_click'] = intval($goods_info['goods_click']) + 1;
        if (getConfig('cache_open')) {
            $this->_wGoodsCache($goods_id, array('goods_click' => $goods_info['goods_click']));
            write_file_cache('updateRedisDate', array($goods_id => $goods_info['goods_click']), null, 'goodsClick/');
        } else {
            $this->editGoodsById(array('goods_click' => array('exp', 'goods_click + 1')), $goods_id);
        }
        $result = array();
        $result['goods_info'] = $goods_info;
        $result['spec_list'] = $spec_list;
        $result['spec_list_mobile'] = $spec_list_mobile;
        $result['spec_image'] = $spec_image;
        $result['goods_image'] = $goods_image;
        $result['goods_image_mobile'] = $goods_image_mobile;
        $result['mansong_info'] = $mansong_info;
        $result['gift_array'] = $gift_array;
        return $result;
    }

    /**
     * 处理商品消费者保障服务信息
     */
    public function getGoodsContract($goods_list, $contract_item = array())
    {
        if (!$goods_list) {
            return array();
        }
        //查询消费者保障服务
        if (getConfig('contract_allow') == 1) {
            if (!$contract_item) {
                $contract_item = Model('contract')->getContractItemByCache();
            }
        }
        if (!$contract_item) {
            return $goods_list;
        }
        foreach ($goods_list as $k => $v) {
            $v['contractlist'] = array();
            foreach ($contract_item as $citem_k => $citem_v) {
                if ($v["contract_$citem_k"] == 1) {
                    $v['contractlist'][$citem_k] = $citem_v;
                }
            }
            $goods_list[$k] = $v;
        }
        return $goods_list;
    }
}
