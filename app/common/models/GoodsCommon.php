<?php

namespace Ypk\Models;

class GoodsCommon extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_commonid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $goods_name;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $goods_jingle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_3;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $gc_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $spec_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $spec_value;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $brand_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $brand_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_image;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $goods_attr;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $goods_custom;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $goods_body;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $mobile_body;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_state;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $goods_stateremark;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_verify;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $goods_verifyremark;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_lock;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_selltime;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_price;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_marketprice;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_costprice;

    /**
     *
     * @var double
     * @Column(type="double", nullable=false)
     */
    protected $goods_discount;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $goods_serial;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_storage_alarm;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $goods_barcode;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $transport_id;

    /**
     *
     * @var string
     * @Column(type="string", length=60, nullable=true)
     */
    protected $transport_title;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_commend;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_freight;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_vat;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $areaid_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $areaid_2;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $goods_stcids;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $plateid_top;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $plateid_bottom;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_virtual;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $virtual_indate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $virtual_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $virtual_invalid_refund;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sup_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_own_shop;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    private $doctor_id;

    /**
     * @return int
     */
    public function getDoctorId()
    {
        return $this->doctor_id;
    }

    /**
     * @param int $doctor_id
     */
    public function setDoctorId($doctor_id)
    {
        $this->doctor_id = $doctor_id;
    }

    /**
     * Method to set the value of field goods_commonid
     *
     * @param integer $goods_commonid
     * @return $this
     */
    public function setGoodsCommonid($goods_commonid)
    {
        $this->goods_commonid = $goods_commonid;

        return $this;
    }

    /**
     * Method to set the value of field goods_name
     *
     * @param string $goods_name
     * @return $this
     */
    public function setGoodsName($goods_name)
    {
        $this->goods_name = $goods_name;

        return $this;
    }

    /**
     * Method to set the value of field goods_jingle
     *
     * @param string $goods_jingle
     * @return $this
     */
    public function setGoodsJingle($goods_jingle)
    {
        $this->goods_jingle = $goods_jingle;

        return $this;
    }

    /**
     * Method to set the value of field gc_id
     *
     * @param integer $gc_id
     * @return $this
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_1
     *
     * @param integer $gc_id_1
     * @return $this
     */
    public function setGcId1($gc_id_1)
    {
        $this->gc_id_1 = $gc_id_1;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_2
     *
     * @param integer $gc_id_2
     * @return $this
     */
    public function setGcId2($gc_id_2)
    {
        $this->gc_id_2 = $gc_id_2;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_3
     *
     * @param integer $gc_id_3
     * @return $this
     */
    public function setGcId3($gc_id_3)
    {
        $this->gc_id_3 = $gc_id_3;

        return $this;
    }

    /**
     * Method to set the value of field gc_name
     *
     * @param string $gc_name
     * @return $this
     */
    public function setGcName($gc_name)
    {
        $this->gc_name = $gc_name;

        return $this;
    }

    /**
     * Method to set the value of field store_id
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

        return $this;
    }

    /**
     * Method to set the value of field store_name
     *
     * @param string $store_name
     * @return $this
     */
    public function setStoreName($store_name)
    {
        $this->store_name = $store_name;

        return $this;
    }

    /**
     * Method to set the value of field spec_name
     *
     * @param string $spec_name
     * @return $this
     */
    public function setSpecName($spec_name)
    {
        $this->spec_name = $spec_name;

        return $this;
    }

    /**
     * Method to set the value of field spec_value
     *
     * @param string $spec_value
     * @return $this
     */
    public function setSpecValue($spec_value)
    {
        $this->spec_value = $spec_value;

        return $this;
    }

    /**
     * Method to set the value of field brand_id
     *
     * @param integer $brand_id
     * @return $this
     */
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Method to set the value of field brand_name
     *
     * @param string $brand_name
     * @return $this
     */
    public function setBrandName($brand_name)
    {
        $this->brand_name = $brand_name;

        return $this;
    }

    /**
     * Method to set the value of field type_id
     *
     * @param integer $type_id
     * @return $this
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * Method to set the value of field goods_image
     *
     * @param string $goods_image
     * @return $this
     */
    public function setGoodsImage($goods_image)
    {
        $this->goods_image = $goods_image;

        return $this;
    }

    /**
     * Method to set the value of field goods_attr
     *
     * @param string $goods_attr
     * @return $this
     */
    public function setGoodsAttr($goods_attr)
    {
        $this->goods_attr = $goods_attr;

        return $this;
    }

    /**
     * Method to set the value of field goods_custom
     *
     * @param string $goods_custom
     * @return $this
     */
    public function setGoodsCustom($goods_custom)
    {
        $this->goods_custom = $goods_custom;

        return $this;
    }

    /**
     * Method to set the value of field goods_body
     *
     * @param string $goods_body
     * @return $this
     */
    public function setGoodsBody($goods_body)
    {
        $this->goods_body = $goods_body;

        return $this;
    }

    /**
     * Method to set the value of field mobile_body
     *
     * @param string $mobile_body
     * @return $this
     */
    public function setMobileBody($mobile_body)
    {
        $this->mobile_body = $mobile_body;

        return $this;
    }

    /**
     * Method to set the value of field goods_state
     *
     * @param integer $goods_state
     * @return $this
     */
    public function setGoodsState($goods_state)
    {
        $this->goods_state = $goods_state;

        return $this;
    }

    /**
     * Method to set the value of field goods_stateremark
     *
     * @param string $goods_stateremark
     * @return $this
     */
    public function setGoodsStateremark($goods_stateremark)
    {
        $this->goods_stateremark = $goods_stateremark;

        return $this;
    }

    /**
     * Method to set the value of field goods_verify
     *
     * @param integer $goods_verify
     * @return $this
     */
    public function setGoodsVerify($goods_verify)
    {
        $this->goods_verify = $goods_verify;

        return $this;
    }

    /**
     * Method to set the value of field goods_verifyremark
     *
     * @param string $goods_verifyremark
     * @return $this
     */
    public function setGoodsVerifyremark($goods_verifyremark)
    {
        $this->goods_verifyremark = $goods_verifyremark;

        return $this;
    }

    /**
     * Method to set the value of field goods_lock
     *
     * @param integer $goods_lock
     * @return $this
     */
    public function setGoodsLock($goods_lock)
    {
        $this->goods_lock = $goods_lock;

        return $this;
    }

    /**
     * Method to set the value of field goods_addtime
     *
     * @param integer $goods_addtime
     * @return $this
     */
    public function setGoodsAddtime($goods_addtime)
    {
        $this->goods_addtime = $goods_addtime;

        return $this;
    }

    /**
     * Method to set the value of field goods_selltime
     *
     * @param integer $goods_selltime
     * @return $this
     */
    public function setGoodsSelltime($goods_selltime)
    {
        $this->goods_selltime = $goods_selltime;

        return $this;
    }

    /**
     * Method to set the value of field goods_price
     *
     * @param double $goods_price
     * @return $this
     */
    public function setGoodsPrice($goods_price)
    {
        $this->goods_price = $goods_price;

        return $this;
    }

    /**
     * Method to set the value of field goods_marketprice
     *
     * @param double $goods_marketprice
     * @return $this
     */
    public function setGoodsMarketprice($goods_marketprice)
    {
        $this->goods_marketprice = $goods_marketprice;

        return $this;
    }

    /**
     * Method to set the value of field goods_costprice
     *
     * @param double $goods_costprice
     * @return $this
     */
    public function setGoodsCostprice($goods_costprice)
    {
        $this->goods_costprice = $goods_costprice;

        return $this;
    }

    /**
     * Method to set the value of field goods_discount
     *
     * @param double $goods_discount
     * @return $this
     */
    public function setGoodsDiscount($goods_discount)
    {
        $this->goods_discount = $goods_discount;

        return $this;
    }

    /**
     * Method to set the value of field goods_serial
     *
     * @param string $goods_serial
     * @return $this
     */
    public function setGoodsSerial($goods_serial)
    {
        $this->goods_serial = $goods_serial;

        return $this;
    }

    /**
     * Method to set the value of field goods_storage_alarm
     *
     * @param integer $goods_storage_alarm
     * @return $this
     */
    public function setGoodsStorageAlarm($goods_storage_alarm)
    {
        $this->goods_storage_alarm = $goods_storage_alarm;

        return $this;
    }

    /**
     * Method to set the value of field goods_barcode
     *
     * @param string $goods_barcode
     * @return $this
     */
    public function setGoodsBarcode($goods_barcode)
    {
        $this->goods_barcode = $goods_barcode;

        return $this;
    }

    /**
     * Method to set the value of field transport_id
     *
     * @param integer $transport_id
     * @return $this
     */
    public function setTransportId($transport_id)
    {
        $this->transport_id = $transport_id;

        return $this;
    }

    /**
     * Method to set the value of field transport_title
     *
     * @param string $transport_title
     * @return $this
     */
    public function setTransportTitle($transport_title)
    {
        $this->transport_title = $transport_title;

        return $this;
    }

    /**
     * Method to set the value of field goods_commend
     *
     * @param integer $goods_commend
     * @return $this
     */
    public function setGoodsCommend($goods_commend)
    {
        $this->goods_commend = $goods_commend;

        return $this;
    }

    /**
     * Method to set the value of field goods_freight
     *
     * @param double $goods_freight
     * @return $this
     */
    public function setGoodsFreight($goods_freight)
    {
        $this->goods_freight = $goods_freight;

        return $this;
    }

    /**
     * Method to set the value of field goods_vat
     *
     * @param integer $goods_vat
     * @return $this
     */
    public function setGoodsVat($goods_vat)
    {
        $this->goods_vat = $goods_vat;

        return $this;
    }

    /**
     * Method to set the value of field areaid_1
     *
     * @param integer $areaid_1
     * @return $this
     */
    public function setAreaid1($areaid_1)
    {
        $this->areaid_1 = $areaid_1;

        return $this;
    }

    /**
     * Method to set the value of field areaid_2
     *
     * @param integer $areaid_2
     * @return $this
     */
    public function setAreaid2($areaid_2)
    {
        $this->areaid_2 = $areaid_2;

        return $this;
    }

    /**
     * Method to set the value of field goods_stcids
     *
     * @param string $goods_stcids
     * @return $this
     */
    public function setGoodsStcids($goods_stcids)
    {
        $this->goods_stcids = $goods_stcids;

        return $this;
    }

    /**
     * Method to set the value of field plateid_top
     *
     * @param integer $plateid_top
     * @return $this
     */
    public function setPlateidTop($plateid_top)
    {
        $this->plateid_top = $plateid_top;

        return $this;
    }

    /**
     * Method to set the value of field plateid_bottom
     *
     * @param integer $plateid_bottom
     * @return $this
     */
    public function setPlateidBottom($plateid_bottom)
    {
        $this->plateid_bottom = $plateid_bottom;

        return $this;
    }

    /**
     * Method to set the value of field is_virtual
     *
     * @param integer $is_virtual
     * @return $this
     */
    public function setIsVirtual($is_virtual)
    {
        $this->is_virtual = $is_virtual;

        return $this;
    }

    /**
     * Method to set the value of field virtual_indate
     *
     * @param integer $virtual_indate
     * @return $this
     */
    public function setVirtualIndate($virtual_indate)
    {
        $this->virtual_indate = $virtual_indate;

        return $this;
    }

    /**
     * Method to set the value of field virtual_limit
     *
     * @param integer $virtual_limit
     * @return $this
     */
    public function setVirtualLimit($virtual_limit)
    {
        $this->virtual_limit = $virtual_limit;

        return $this;
    }

    /**
     * Method to set the value of field virtual_invalid_refund
     *
     * @param integer $virtual_invalid_refund
     * @return $this
     */
    public function setVirtualInvalidRefund($virtual_invalid_refund)
    {
        $this->virtual_invalid_refund = $virtual_invalid_refund;

        return $this;
    }

    /**
     * Method to set the value of field sup_id
     *
     * @param integer $sup_id
     * @return $this
     */
    public function setSupId($sup_id)
    {
        $this->sup_id = $sup_id;

        return $this;
    }

    /**
     * Method to set the value of field is_own_shop
     *
     * @param integer $is_own_shop
     * @return $this
     */
    public function setIsOwnShop($is_own_shop)
    {
        $this->is_own_shop = $is_own_shop;

        return $this;
    }

    /**
     * Returns the value of field goods_commonid
     *
     * @return integer
     */
    public function getGoodsCommonid()
    {
        return $this->goods_commonid;
    }

    /**
     * Returns the value of field goods_name
     *
     * @return string
     */
    public function getGoodsName()
    {
        return $this->goods_name;
    }

    /**
     * Returns the value of field goods_jingle
     *
     * @return string
     */
    public function getGoodsJingle()
    {
        return $this->goods_jingle;
    }

    /**
     * Returns the value of field gc_id
     *
     * @return integer
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Returns the value of field gc_id_1
     *
     * @return integer
     */
    public function getGcId1()
    {
        return $this->gc_id_1;
    }

    /**
     * Returns the value of field gc_id_2
     *
     * @return integer
     */
    public function getGcId2()
    {
        return $this->gc_id_2;
    }

    /**
     * Returns the value of field gc_id_3
     *
     * @return integer
     */
    public function getGcId3()
    {
        return $this->gc_id_3;
    }

    /**
     * Returns the value of field gc_name
     *
     * @return string
     */
    public function getGcName()
    {
        return $this->gc_name;
    }

    /**
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field spec_name
     *
     * @return string
     */
    public function getSpecName()
    {
        return $this->spec_name;
    }

    /**
     * Returns the value of field spec_value
     *
     * @return string
     */
    public function getSpecValue()
    {
        return $this->spec_value;
    }

    /**
     * Returns the value of field brand_id
     *
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Returns the value of field brand_name
     *
     * @return string
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Returns the value of field type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Returns the value of field goods_image
     *
     * @return string
     */
    public function getGoodsImage()
    {
        return $this->goods_image;
    }

    /**
     * Returns the value of field goods_attr
     *
     * @return string
     */
    public function getGoodsAttr()
    {
        return $this->goods_attr;
    }

    /**
     * Returns the value of field goods_custom
     *
     * @return string
     */
    public function getGoodsCustom()
    {
        return $this->goods_custom;
    }

    /**
     * Returns the value of field goods_body
     *
     * @return string
     */
    public function getGoodsBody()
    {
        return $this->goods_body;
    }

    /**
     * Returns the value of field mobile_body
     *
     * @return string
     */
    public function getMobileBody()
    {
        return $this->mobile_body;
    }

    /**
     * Returns the value of field goods_state
     *
     * @return integer
     */
    public function getGoodsState()
    {
        return $this->goods_state;
    }

    /**
     * Returns the value of field goods_stateremark
     *
     * @return string
     */
    public function getGoodsStateremark()
    {
        return $this->goods_stateremark;
    }

    /**
     * Returns the value of field goods_verify
     *
     * @return integer
     */
    public function getGoodsVerify()
    {
        return $this->goods_verify;
    }

    /**
     * Returns the value of field goods_verifyremark
     *
     * @return string
     */
    public function getGoodsVerifyremark()
    {
        return $this->goods_verifyremark;
    }

    /**
     * Returns the value of field goods_lock
     *
     * @return integer
     */
    public function getGoodsLock()
    {
        return $this->goods_lock;
    }

    /**
     * Returns the value of field goods_addtime
     *
     * @return integer
     */
    public function getGoodsAddtime()
    {
        return $this->goods_addtime;
    }

    /**
     * Returns the value of field goods_selltime
     *
     * @return integer
     */
    public function getGoodsSelltime()
    {
        return $this->goods_selltime;
    }

    /**
     * Returns the value of field goods_price
     *
     * @return double
     */
    public function getGoodsPrice()
    {
        return $this->goods_price;
    }

    /**
     * Returns the value of field goods_marketprice
     *
     * @return double
     */
    public function getGoodsMarketprice()
    {
        return $this->goods_marketprice;
    }

    /**
     * Returns the value of field goods_costprice
     *
     * @return double
     */
    public function getGoodsCostprice()
    {
        return $this->goods_costprice;
    }

    /**
     * Returns the value of field goods_discount
     *
     * @return double
     */
    public function getGoodsDiscount()
    {
        return $this->goods_discount;
    }

    /**
     * Returns the value of field goods_serial
     *
     * @return string
     */
    public function getGoodsSerial()
    {
        return $this->goods_serial;
    }

    /**
     * Returns the value of field goods_storage_alarm
     *
     * @return integer
     */
    public function getGoodsStorageAlarm()
    {
        return $this->goods_storage_alarm;
    }

    /**
     * Returns the value of field goods_barcode
     *
     * @return string
     */
    public function getGoodsBarcode()
    {
        return $this->goods_barcode;
    }

    /**
     * Returns the value of field transport_id
     *
     * @return integer
     */
    public function getTransportId()
    {
        return $this->transport_id;
    }

    /**
     * Returns the value of field transport_title
     *
     * @return string
     */
    public function getTransportTitle()
    {
        return $this->transport_title;
    }

    /**
     * Returns the value of field goods_commend
     *
     * @return integer
     */
    public function getGoodsCommend()
    {
        return $this->goods_commend;
    }

    /**
     * Returns the value of field goods_freight
     *
     * @return double
     */
    public function getGoodsFreight()
    {
        return $this->goods_freight;
    }

    /**
     * Returns the value of field goods_vat
     *
     * @return integer
     */
    public function getGoodsVat()
    {
        return $this->goods_vat;
    }

    /**
     * Returns the value of field areaid_1
     *
     * @return integer
     */
    public function getAreaid1()
    {
        return $this->areaid_1;
    }

    /**
     * Returns the value of field areaid_2
     *
     * @return integer
     */
    public function getAreaid2()
    {
        return $this->areaid_2;
    }

    /**
     * Returns the value of field goods_stcids
     *
     * @return string
     */
    public function getGoodsStcids()
    {
        return $this->goods_stcids;
    }

    /**
     * Returns the value of field plateid_top
     *
     * @return integer
     */
    public function getPlateidTop()
    {
        return $this->plateid_top;
    }

    /**
     * Returns the value of field plateid_bottom
     *
     * @return integer
     */
    public function getPlateidBottom()
    {
        return $this->plateid_bottom;
    }

    /**
     * Returns the value of field is_virtual
     *
     * @return integer
     */
    public function getIsVirtual()
    {
        return $this->is_virtual;
    }

    /**
     * Returns the value of field virtual_indate
     *
     * @return integer
     */
    public function getVirtualIndate()
    {
        return $this->virtual_indate;
    }

    /**
     * Returns the value of field virtual_limit
     *
     * @return integer
     */
    public function getVirtualLimit()
    {
        return $this->virtual_limit;
    }

    /**
     * Returns the value of field virtual_invalid_refund
     *
     * @return integer
     */
    public function getVirtualInvalidRefund()
    {
        return $this->virtual_invalid_refund;
    }

    /**
     * Returns the value of field sup_id
     *
     * @return integer
     */
    public function getSupId()
    {
        return $this->sup_id;
    }

    /**
     * Returns the value of field is_own_shop
     *
     * @return integer
     */
    public function getIsOwnShop()
    {
        return $this->is_own_shop;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_common';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsCommon[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsCommon
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
