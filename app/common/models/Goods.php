<?php

namespace Ypk\Models;

class Goods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var integer
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
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_name;

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
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $brand_id;

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
    protected $goods_promotion_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_promotion_type;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_marketprice;

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
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_click;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_salenum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_collect;

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
    protected $goods_spec;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_storage;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_image;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $goods_body;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
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
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_verify;

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
    protected $goods_edittime;

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
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $color_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $transport_id;

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
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_commend;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $goods_stcids;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $evaluation_good_star;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $evaluation_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_virtual;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $virtual_indate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
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
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_fcode;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_presell;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $presell_deliverdate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_book;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $book_down_payment;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $book_final_payment;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $book_down_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $book_buyers;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $have_gift;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_own_shop;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_4;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_5;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_6;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_7;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_8;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_9;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $contract_10;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_chain;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $invite_rate;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $doctor_private_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $goods_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $doctor_service_start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $doctor_id;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $hispital_address;


    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $depart_address;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $hispital_zuozhen;

    /**
     * @return string
     */
    public function getHispitalZuozhen()
    {
        return $this->hispital_zuozhen;
    }

    /**
     * @param string $hispital_zuozhen
     */
    public function setHispitalZuozhen($hispital_zuozhen)
    {
        $this->hispital_zuozhen = $hispital_zuozhen;
    }

    /**
     * @return string
     */
    public function getHispitalAddress()
    {
        return $this->hispital_address;
    }

    /**
     * @param string $hispital_address
     */
    public function setHispitalAddress($hispital_address)
    {
        $this->hispital_address = $hispital_address;
    }

    /**
     * @return string
     */
    public function getDepartAddress()
    {
        return $this->depart_address;
    }

    /**
     * @param string $depart_address
     */
    public function setDepartAddress($depart_address)
    {
        $this->depart_address = $depart_address;
    }

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
     * @return int
     */
    public function getDoctorServiceStartTime()
    {
        return $this->doctor_service_start_time;
    }

    /**
     * @param int $doctor_service_start_time
     */
    public function setDoctorServiceStartTime($doctor_service_start_time)
    {
        $this->doctor_service_start_time = $doctor_service_start_time;
    }

    /**
     * @return int
     */
    public function getDoctorServiceEndTime()
    {
        return $this->doctor_service_end_time;
    }

    /**
     * @param int $doctor_service_end_time
     */
    public function setDoctorServiceEndTime($doctor_service_end_time)
    {
        $this->doctor_service_end_time = $doctor_service_end_time;
    }

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $doctor_service_end_time;

    /**
     * Method to set the value of field goods_id
     *
     * @param integer $goods_id
     * @return $this
     */
    public function setGoodsId($goods_id)
    {
        $this->goods_id = $goods_id;

        return $this;
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
     * Method to set the value of field goods_promotion_price
     *
     * @param double $goods_promotion_price
     * @return $this
     */
    public function setGoodsPromotionPrice($goods_promotion_price)
    {
        $this->goods_promotion_price = $goods_promotion_price;

        return $this;
    }

    /**
     * Method to set the value of field goods_promotion_type
     *
     * @param integer $goods_promotion_type
     * @return $this
     */
    public function setGoodsPromotionType($goods_promotion_type)
    {
        $this->goods_promotion_type = $goods_promotion_type;

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
     * Method to set the value of field goods_click
     *
     * @param integer $goods_click
     * @return $this
     */
    public function setGoodsClick($goods_click)
    {
        $this->goods_click = $goods_click;

        return $this;
    }

    /**
     * Method to set the value of field goods_salenum
     *
     * @param integer $goods_salenum
     * @return $this
     */
    public function setGoodsSalenum($goods_salenum)
    {
        $this->goods_salenum = $goods_salenum;

        return $this;
    }

    /**
     * Method to set the value of field goods_collect
     *
     * @param integer $goods_collect
     * @return $this
     */
    public function setGoodsCollect($goods_collect)
    {
        $this->goods_collect = $goods_collect;

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
     * Method to set the value of field goods_spec
     *
     * @param string $goods_spec
     * @return $this
     */
    public function setGoodsSpec($goods_spec)
    {
        $this->goods_spec = $goods_spec;

        return $this;
    }

    /**
     * Method to set the value of field goods_storage
     *
     * @param integer $goods_storage
     * @return $this
     */
    public function setGoodsStorage($goods_storage)
    {
        $this->goods_storage = $goods_storage;

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
     * Method to set the value of field goods_edittime
     *
     * @param integer $goods_edittime
     * @return $this
     */
    public function setGoodsEdittime($goods_edittime)
    {
        $this->goods_edittime = $goods_edittime;

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
     * Method to set the value of field color_id
     *
     * @param integer $color_id
     * @return $this
     */
    public function setColorId($color_id)
    {
        $this->color_id = $color_id;

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
     * Method to set the value of field evaluation_good_star
     *
     * @param integer $evaluation_good_star
     * @return $this
     */
    public function setEvaluationGoodStar($evaluation_good_star)
    {
        $this->evaluation_good_star = $evaluation_good_star;

        return $this;
    }

    /**
     * Method to set the value of field evaluation_count
     *
     * @param integer $evaluation_count
     * @return $this
     */
    public function setEvaluationCount($evaluation_count)
    {
        $this->evaluation_count = $evaluation_count;

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
     * Method to set the value of field is_fcode
     *
     * @param integer $is_fcode
     * @return $this
     */
    public function setIsFcode($is_fcode)
    {
        $this->is_fcode = $is_fcode;

        return $this;
    }

    /**
     * Method to set the value of field is_presell
     *
     * @param integer $is_presell
     * @return $this
     */
    public function setIsPresell($is_presell)
    {
        $this->is_presell = $is_presell;

        return $this;
    }

    /**
     * Method to set the value of field presell_deliverdate
     *
     * @param integer $presell_deliverdate
     * @return $this
     */
    public function setPresellDeliverdate($presell_deliverdate)
    {
        $this->presell_deliverdate = $presell_deliverdate;

        return $this;
    }

    /**
     * Method to set the value of field is_book
     *
     * @param integer $is_book
     * @return $this
     */
    public function setIsBook($is_book)
    {
        $this->is_book = $is_book;

        return $this;
    }

    /**
     * Method to set the value of field book_down_payment
     *
     * @param double $book_down_payment
     * @return $this
     */
    public function setBookDownPayment($book_down_payment)
    {
        $this->book_down_payment = $book_down_payment;

        return $this;
    }

    /**
     * Method to set the value of field book_final_payment
     *
     * @param double $book_final_payment
     * @return $this
     */
    public function setBookFinalPayment($book_final_payment)
    {
        $this->book_final_payment = $book_final_payment;

        return $this;
    }

    /**
     * Method to set the value of field book_down_time
     *
     * @param integer $book_down_time
     * @return $this
     */
    public function setBookDownTime($book_down_time)
    {
        $this->book_down_time = $book_down_time;

        return $this;
    }

    /**
     * Method to set the value of field book_buyers
     *
     * @param integer $book_buyers
     * @return $this
     */
    public function setBookBuyers($book_buyers)
    {
        $this->book_buyers = $book_buyers;

        return $this;
    }

    /**
     * Method to set the value of field have_gift
     *
     * @param integer $have_gift
     * @return $this
     */
    public function setHaveGift($have_gift)
    {
        $this->have_gift = $have_gift;

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
     * Method to set the value of field contract_1
     *
     * @param integer $contract_1
     * @return $this
     */
    public function setContract1($contract_1)
    {
        $this->contract_1 = $contract_1;

        return $this;
    }

    /**
     * Method to set the value of field contract_2
     *
     * @param integer $contract_2
     * @return $this
     */
    public function setContract2($contract_2)
    {
        $this->contract_2 = $contract_2;

        return $this;
    }

    /**
     * Method to set the value of field contract_3
     *
     * @param integer $contract_3
     * @return $this
     */
    public function setContract3($contract_3)
    {
        $this->contract_3 = $contract_3;

        return $this;
    }

    /**
     * Method to set the value of field contract_4
     *
     * @param integer $contract_4
     * @return $this
     */
    public function setContract4($contract_4)
    {
        $this->contract_4 = $contract_4;

        return $this;
    }

    /**
     * Method to set the value of field contract_5
     *
     * @param integer $contract_5
     * @return $this
     */
    public function setContract5($contract_5)
    {
        $this->contract_5 = $contract_5;

        return $this;
    }

    /**
     * Method to set the value of field contract_6
     *
     * @param integer $contract_6
     * @return $this
     */
    public function setContract6($contract_6)
    {
        $this->contract_6 = $contract_6;

        return $this;
    }

    /**
     * Method to set the value of field contract_7
     *
     * @param integer $contract_7
     * @return $this
     */
    public function setContract7($contract_7)
    {
        $this->contract_7 = $contract_7;

        return $this;
    }

    /**
     * Method to set the value of field contract_8
     *
     * @param integer $contract_8
     * @return $this
     */
    public function setContract8($contract_8)
    {
        $this->contract_8 = $contract_8;

        return $this;
    }

    /**
     * Method to set the value of field contract_9
     *
     * @param integer $contract_9
     * @return $this
     */
    public function setContract9($contract_9)
    {
        $this->contract_9 = $contract_9;

        return $this;
    }

    /**
     * Method to set the value of field contract_10
     *
     * @param integer $contract_10
     * @return $this
     */
    public function setContract10($contract_10)
    {
        $this->contract_10 = $contract_10;

        return $this;
    }

    /**
     * Method to set the value of field is_chain
     *
     * @param integer $is_chain
     * @return $this
     */
    public function setIsChain($is_chain)
    {
        $this->is_chain = $is_chain;

        return $this;
    }

    /**
     * Method to set the value of field invite_rate
     *
     * @param double $invite_rate
     * @return $this
     */
    public function setInviteRate($invite_rate)
    {
        $this->invite_rate = $invite_rate;

        return $this;
    }

    /**
     * Method to set the value of field doctor_private_price
     *
     * @param double $doctor_private_price
     * @return $this
     */
    public function setDoctorPrivatePrice($doctor_private_price)
    {
        $this->doctor_private_price = $doctor_private_price;

        return $this;
    }

    /**
     * Method to set the value of field goods_points
     *
     * @param integer $goods_points
     * @return $this
     */
    public function setGoodsPoints($goods_points)
    {
        $this->goods_points = $goods_points;

        return $this;
    }

    /**
     * Returns the value of field goods_id
     *
     * @return integer
     */
    public function getGoodsId()
    {
        return $this->goods_id;
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
     * Returns the value of field brand_id
     *
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brand_id;
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
     * Returns the value of field goods_promotion_price
     *
     * @return double
     */
    public function getGoodsPromotionPrice()
    {
        return $this->goods_promotion_price;
    }

    /**
     * Returns the value of field goods_promotion_type
     *
     * @return integer
     */
    public function getGoodsPromotionType()
    {
        return $this->goods_promotion_type;
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
     * Returns the value of field goods_click
     *
     * @return integer
     */
    public function getGoodsClick()
    {
        return $this->goods_click;
    }

    /**
     * Returns the value of field goods_salenum
     *
     * @return integer
     */
    public function getGoodsSalenum()
    {
        return $this->goods_salenum;
    }

    /**
     * Returns the value of field goods_collect
     *
     * @return integer
     */
    public function getGoodsCollect()
    {
        return $this->goods_collect;
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
     * Returns the value of field goods_spec
     *
     * @return string
     */
    public function getGoodsSpec()
    {
        return $this->goods_spec;
    }

    /**
     * Returns the value of field goods_storage
     *
     * @return integer
     */
    public function getGoodsStorage()
    {
        return $this->goods_storage;
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
     * Returns the value of field goods_verify
     *
     * @return integer
     */
    public function getGoodsVerify()
    {
        return $this->goods_verify;
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
     * Returns the value of field goods_edittime
     *
     * @return integer
     */
    public function getGoodsEdittime()
    {
        return $this->goods_edittime;
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
     * Returns the value of field color_id
     *
     * @return integer
     */
    public function getColorId()
    {
        return $this->color_id;
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
     * Returns the value of field goods_commend
     *
     * @return integer
     */
    public function getGoodsCommend()
    {
        return $this->goods_commend;
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
     * Returns the value of field evaluation_good_star
     *
     * @return integer
     */
    public function getEvaluationGoodStar()
    {
        return $this->evaluation_good_star;
    }

    /**
     * Returns the value of field evaluation_count
     *
     * @return integer
     */
    public function getEvaluationCount()
    {
        return $this->evaluation_count;
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
     * Returns the value of field is_fcode
     *
     * @return integer
     */
    public function getIsFcode()
    {
        return $this->is_fcode;
    }

    /**
     * Returns the value of field is_presell
     *
     * @return integer
     */
    public function getIsPresell()
    {
        return $this->is_presell;
    }

    /**
     * Returns the value of field presell_deliverdate
     *
     * @return integer
     */
    public function getPresellDeliverdate()
    {
        return $this->presell_deliverdate;
    }

    /**
     * Returns the value of field is_book
     *
     * @return integer
     */
    public function getIsBook()
    {
        return $this->is_book;
    }

    /**
     * Returns the value of field book_down_payment
     *
     * @return double
     */
    public function getBookDownPayment()
    {
        return $this->book_down_payment;
    }

    /**
     * Returns the value of field book_final_payment
     *
     * @return double
     */
    public function getBookFinalPayment()
    {
        return $this->book_final_payment;
    }

    /**
     * Returns the value of field book_down_time
     *
     * @return integer
     */
    public function getBookDownTime()
    {
        return $this->book_down_time;
    }

    /**
     * Returns the value of field book_buyers
     *
     * @return integer
     */
    public function getBookBuyers()
    {
        return $this->book_buyers;
    }

    /**
     * Returns the value of field have_gift
     *
     * @return integer
     */
    public function getHaveGift()
    {
        return $this->have_gift;
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
     * Returns the value of field contract_1
     *
     * @return integer
     */
    public function getContract1()
    {
        return $this->contract_1;
    }

    /**
     * Returns the value of field contract_2
     *
     * @return integer
     */
    public function getContract2()
    {
        return $this->contract_2;
    }

    /**
     * Returns the value of field contract_3
     *
     * @return integer
     */
    public function getContract3()
    {
        return $this->contract_3;
    }

    /**
     * Returns the value of field contract_4
     *
     * @return integer
     */
    public function getContract4()
    {
        return $this->contract_4;
    }

    /**
     * Returns the value of field contract_5
     *
     * @return integer
     */
    public function getContract5()
    {
        return $this->contract_5;
    }

    /**
     * Returns the value of field contract_6
     *
     * @return integer
     */
    public function getContract6()
    {
        return $this->contract_6;
    }

    /**
     * Returns the value of field contract_7
     *
     * @return integer
     */
    public function getContract7()
    {
        return $this->contract_7;
    }

    /**
     * Returns the value of field contract_8
     *
     * @return integer
     */
    public function getContract8()
    {
        return $this->contract_8;
    }

    /**
     * Returns the value of field contract_9
     *
     * @return integer
     */
    public function getContract9()
    {
        return $this->contract_9;
    }

    /**
     * Returns the value of field contract_10
     *
     * @return integer
     */
    public function getContract10()
    {
        return $this->contract_10;
    }

    /**
     * Returns the value of field is_chain
     *
     * @return integer
     */
    public function getIsChain()
    {
        return $this->is_chain;
    }

    /**
     * Returns the value of field invite_rate
     *
     * @return double
     */
    public function getInviteRate()
    {
        return $this->invite_rate;
    }

    /**
     * Returns the value of field doctor_private_price
     *
     * @return double
     */
    public function getDoctorPrivatePrice()
    {
        return $this->doctor_private_price;
    }

    /**
     * Returns the value of field goods_points
     *
     * @return integer
     */
    public function getGoodsPoints()
    {
        return $this->goods_points;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Goods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Goods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
