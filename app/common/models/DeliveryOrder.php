<?php

namespace Ypk\Models;

class DeliveryOrder extends \Phalcon\Mvc\Model
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
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $order_sn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $dlyp_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $shipping_code;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $express_code;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $express_name;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $reciver_name;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $reciver_telphone;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=true)
     */
    protected $reciver_mobphone;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $dlyo_state;

    /**
     *
     * @var string
     * @Column(type="string", length=6, nullable=true)
     */
    protected $dlyo_pickup_code;

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
     * Method to set the value of field addtime
     *
     * @param integer $addtime
     * @return $this
     */
    public function setAddtime($addtime)
    {
        $this->addtime = $addtime;

        return $this;
    }

    /**
     * Method to set the value of field order_sn
     *
     * @param string $order_sn
     * @return $this
     */
    public function setOrderSn($order_sn)
    {
        $this->order_sn = $order_sn;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_id
     *
     * @param integer $dlyp_id
     * @return $this
     */
    public function setDlypId($dlyp_id)
    {
        $this->dlyp_id = $dlyp_id;

        return $this;
    }

    /**
     * Method to set the value of field shipping_code
     *
     * @param string $shipping_code
     * @return $this
     */
    public function setShippingCode($shipping_code)
    {
        $this->shipping_code = $shipping_code;

        return $this;
    }

    /**
     * Method to set the value of field express_code
     *
     * @param string $express_code
     * @return $this
     */
    public function setExpressCode($express_code)
    {
        $this->express_code = $express_code;

        return $this;
    }

    /**
     * Method to set the value of field express_name
     *
     * @param string $express_name
     * @return $this
     */
    public function setExpressName($express_name)
    {
        $this->express_name = $express_name;

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
     * Method to set the value of field reciver_telphone
     *
     * @param string $reciver_telphone
     * @return $this
     */
    public function setReciverTelphone($reciver_telphone)
    {
        $this->reciver_telphone = $reciver_telphone;

        return $this;
    }

    /**
     * Method to set the value of field reciver_mobphone
     *
     * @param string $reciver_mobphone
     * @return $this
     */
    public function setReciverMobphone($reciver_mobphone)
    {
        $this->reciver_mobphone = $reciver_mobphone;

        return $this;
    }

    /**
     * Method to set the value of field dlyo_state
     *
     * @param integer $dlyo_state
     * @return $this
     */
    public function setDlyoState($dlyo_state)
    {
        $this->dlyo_state = $dlyo_state;

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
     * Returns the value of field order_id
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Returns the value of field addtime
     *
     * @return integer
     */
    public function getAddtime()
    {
        return $this->addtime;
    }

    /**
     * Returns the value of field order_sn
     *
     * @return string
     */
    public function getOrderSn()
    {
        return $this->order_sn;
    }

    /**
     * Returns the value of field dlyp_id
     *
     * @return integer
     */
    public function getDlypId()
    {
        return $this->dlyp_id;
    }

    /**
     * Returns the value of field shipping_code
     *
     * @return string
     */
    public function getShippingCode()
    {
        return $this->shipping_code;
    }

    /**
     * Returns the value of field express_code
     *
     * @return string
     */
    public function getExpressCode()
    {
        return $this->express_code;
    }

    /**
     * Returns the value of field express_name
     *
     * @return string
     */
    public function getExpressName()
    {
        return $this->express_name;
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
     * Returns the value of field reciver_telphone
     *
     * @return string
     */
    public function getReciverTelphone()
    {
        return $this->reciver_telphone;
    }

    /**
     * Returns the value of field reciver_mobphone
     *
     * @return string
     */
    public function getReciverMobphone()
    {
        return $this->reciver_mobphone;
    }

    /**
     * Returns the value of field dlyo_state
     *
     * @return integer
     */
    public function getDlyoState()
    {
        return $this->dlyo_state;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'delivery_order';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DeliveryOrder[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DeliveryOrder
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
