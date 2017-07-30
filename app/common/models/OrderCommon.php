<?php

namespace Ypk\Models;

class OrderCommon extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $order_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $shipping_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $shipping_express_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $evaluation_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $evalseller_time;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $order_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $order_pointscount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $voucher_price;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    protected $voucher_code;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $deliver_explain;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=false)
     */
    protected $daddress_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $reciver_name;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $reciver_info;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $reciver_province_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $reciver_city_id;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $invoice_info;

    /**
     *
     * @var string
     * @Column(type="string", length=800, nullable=true)
     */
    protected $promotion_info;

    /**
     *
     * @var string
     * @Column(type="string", length=6, nullable=true)
     */
    protected $dlyo_pickup_code;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $promotion_total;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $discount;

    /**
     * Method to set the value of field order_id
     *
     * @param integer $order_id
     * @return $this
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;

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
     * Method to set the value of field shipping_time
     *
     * @param integer $shipping_time
     * @return $this
     */
    public function setShippingTime($shipping_time)
    {
        $this->shipping_time = $shipping_time;

        return $this;
    }

    /**
     * Method to set the value of field shipping_express_id
     *
     * @param integer $shipping_express_id
     * @return $this
     */
    public function setShippingExpressId($shipping_express_id)
    {
        $this->shipping_express_id = $shipping_express_id;

        return $this;
    }

    /**
     * Method to set the value of field evaluation_time
     *
     * @param integer $evaluation_time
     * @return $this
     */
    public function setEvaluationTime($evaluation_time)
    {
        $this->evaluation_time = $evaluation_time;

        return $this;
    }

    /**
     * Method to set the value of field evalseller_time
     *
     * @param integer $evalseller_time
     * @return $this
     */
    public function setEvalsellerTime($evalseller_time)
    {
        $this->evalseller_time = $evalseller_time;

        return $this;
    }

    /**
     * Method to set the value of field order_message
     *
     * @param string $order_message
     * @return $this
     */
    public function setOrderMessage($order_message)
    {
        $this->order_message = $order_message;

        return $this;
    }

    /**
     * Method to set the value of field order_pointscount
     *
     * @param integer $order_pointscount
     * @return $this
     */
    public function setOrderPointscount($order_pointscount)
    {
        $this->order_pointscount = $order_pointscount;

        return $this;
    }

    /**
     * Method to set the value of field voucher_price
     *
     * @param integer $voucher_price
     * @return $this
     */
    public function setVoucherPrice($voucher_price)
    {
        $this->voucher_price = $voucher_price;

        return $this;
    }

    /**
     * Method to set the value of field voucher_code
     *
     * @param string $voucher_code
     * @return $this
     */
    public function setVoucherCode($voucher_code)
    {
        $this->voucher_code = $voucher_code;

        return $this;
    }

    /**
     * Method to set the value of field deliver_explain
     *
     * @param string $deliver_explain
     * @return $this
     */
    public function setDeliverExplain($deliver_explain)
    {
        $this->deliver_explain = $deliver_explain;

        return $this;
    }

    /**
     * Method to set the value of field daddress_id
     *
     * @param integer $daddress_id
     * @return $this
     */
    public function setDaddressId($daddress_id)
    {
        $this->daddress_id = $daddress_id;

        return $this;
    }

    /**
     * Method to set the value of field reciver_name
     *
     * @param string $reciver_name
     * @return $this
     */
    public function setReciverName($reciver_name)
    {
        $this->reciver_name = $reciver_name;

        return $this;
    }

    /**
     * Method to set the value of field reciver_info
     *
     * @param string $reciver_info
     * @return $this
     */
    public function setReciverInfo($reciver_info)
    {
        $this->reciver_info = $reciver_info;

        return $this;
    }

    /**
     * Method to set the value of field reciver_province_id
     *
     * @param integer $reciver_province_id
     * @return $this
     */
    public function setReciverProvinceId($reciver_province_id)
    {
        $this->reciver_province_id = $reciver_province_id;

        return $this;
    }

    /**
     * Method to set the value of field reciver_city_id
     *
     * @param integer $reciver_city_id
     * @return $this
     */
    public function setReciverCityId($reciver_city_id)
    {
        $this->reciver_city_id = $reciver_city_id;

        return $this;
    }

    /**
     * Method to set the value of field invoice_info
     *
     * @param string $invoice_info
     * @return $this
     */
    public function setInvoiceInfo($invoice_info)
    {
        $this->invoice_info = $invoice_info;

        return $this;
    }

    /**
     * Method to set the value of field promotion_info
     *
     * @param string $promotion_info
     * @return $this
     */
    public function setPromotionInfo($promotion_info)
    {
        $this->promotion_info = $promotion_info;

        return $this;
    }

    /**
     * Method to set the value of field dlyo_pickup_code
     *
     * @param string $dlyo_pickup_code
     * @return $this
     */
    public function setDlyoPickupCode($dlyo_pickup_code)
    {
        $this->dlyo_pickup_code = $dlyo_pickup_code;

        return $this;
    }

    /**
     * Method to set the value of field promotion_total
     *
     * @param double $promotion_total
     * @return $this
     */
    public function setPromotionTotal($promotion_total)
    {
        $this->promotion_total = $promotion_total;

        return $this;
    }

    /**
     * Method to set the value of field discount
     *
     * @param integer $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Returns the value of field order_id
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
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
     * Returns the value of field shipping_time
     *
     * @return integer
     */
    public function getShippingTime()
    {
        return $this->shipping_time;
    }

    /**
     * Returns the value of field shipping_express_id
     *
     * @return integer
     */
    public function getShippingExpressId()
    {
        return $this->shipping_express_id;
    }

    /**
     * Returns the value of field evaluation_time
     *
     * @return integer
     */
    public function getEvaluationTime()
    {
        return $this->evaluation_time;
    }

    /**
     * Returns the value of field evalseller_time
     *
     * @return integer
     */
    public function getEvalsellerTime()
    {
        return $this->evalseller_time;
    }

    /**
     * Returns the value of field order_message
     *
     * @return string
     */
    public function getOrderMessage()
    {
        return $this->order_message;
    }

    /**
     * Returns the value of field order_pointscount
     *
     * @return integer
     */
    public function getOrderPointscount()
    {
        return $this->order_pointscount;
    }

    /**
     * Returns the value of field voucher_price
     *
     * @return integer
     */
    public function getVoucherPrice()
    {
        return $this->voucher_price;
    }

    /**
     * Returns the value of field voucher_code
     *
     * @return string
     */
    public function getVoucherCode()
    {
        return $this->voucher_code;
    }

    /**
     * Returns the value of field deliver_explain
     *
     * @return string
     */
    public function getDeliverExplain()
    {
        return $this->deliver_explain;
    }

    /**
     * Returns the value of field daddress_id
     *
     * @return integer
     */
    public function getDaddressId()
    {
        return $this->daddress_id;
    }

    /**
     * Returns the value of field reciver_name
     *
     * @return string
     */
    public function getReciverName()
    {
        return $this->reciver_name;
    }

    /**
     * Returns the value of field reciver_info
     *
     * @return string
     */
    public function getReciverInfo()
    {
        return $this->reciver_info;
    }

    /**
     * Returns the value of field reciver_province_id
     *
     * @return integer
     */
    public function getReciverProvinceId()
    {
        return $this->reciver_province_id;
    }

    /**
     * Returns the value of field reciver_city_id
     *
     * @return integer
     */
    public function getReciverCityId()
    {
        return $this->reciver_city_id;
    }

    /**
     * Returns the value of field invoice_info
     *
     * @return string
     */
    public function getInvoiceInfo()
    {
        return $this->invoice_info;
    }

    /**
     * Returns the value of field promotion_info
     *
     * @return string
     */
    public function getPromotionInfo()
    {
        return $this->promotion_info;
    }

    /**
     * Returns the value of field dlyo_pickup_code
     *
     * @return string
     */
    public function getDlyoPickupCode()
    {
        return $this->dlyo_pickup_code;
    }

    /**
     * Returns the value of field promotion_total
     *
     * @return double
     */
    public function getPromotionTotal()
    {
        return $this->promotion_total;
    }

    /**
     * Returns the value of field discount
     *
     * @return integer
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'order_common';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderCommon[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderCommon
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
