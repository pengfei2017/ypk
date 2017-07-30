<?php

namespace Ypk\Models;

class MemberBuyServiceNum extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $end_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $buyer_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $buyer_number;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $doctor_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $is_use;

    /**
     * @return int
     */
    public function getIsUse()
    {
        return $this->is_use;
    }

    /**
     * @param int $is_use
     */
    public function setIsUse($is_use)
    {
        $this->is_use = $is_use;
    }

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $is_new;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $is_exchange;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $order_sn;

    /**
     * @return string
     */
    public function getOrderSn()
    {
        return $this->order_sn;
    }

    /**
     * @param string $order_sn
     */
    public function setOrderSn($order_sn)
    {
        $this->order_sn = $order_sn;
    }

    /**
     * @return int
     */
    public function getIsExchange()
    {
        return $this->is_exchange;
    }

    /**
     * @param int $is_exchange
     */
    public function setIsExchange($is_exchange)
    {
        $this->is_exchange = $is_exchange;
    }

    /**
     * @return int
     */
    public function getIsNew()
    {
        return $this->is_new;
    }

    /**
     * @param int $is_new
     */
    public function setIsNew($is_new)
    {
        $this->is_new = $is_new;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Method to set the value of field start_time
     *
     * @param integer $start_time
     * @return $this
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * Method to set the value of field end_time
     *
     * @param integer $end_time
     * @return $this
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;

        return $this;
    }

    /**
     * Method to set the value of field buyer_id
     *
     * @param integer $buyer_id
     * @return $this
     */
    public function setBuyerId($buyer_id)
    {
        $this->buyer_id = $buyer_id;

        return $this;
    }

    /**
     * Method to set the value of field buyer_number
     *
     * @param integer $buyer_number
     * @return $this
     */
    public function setBuyerNumber($buyer_number)
    {
        $this->buyer_number = $buyer_number;

        return $this;
    }

    /**
     * Method to set the value of field doctor_id
     *
     * @param integer $doctor_id
     * @return $this
     */
    public function setDoctorId($doctor_id)
    {
        $this->doctor_id = $doctor_id;

        return $this;
    }

    /**
     * Method to set the value of field add_time
     *
     * @param integer $add_time
     * @return $this
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Returns the value of field start_time
     *
     * @return integer
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Returns the value of field end_time
     *
     * @return integer
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * Returns the value of field buyer_id
     *
     * @return integer
     */
    public function getBuyerId()
    {
        return $this->buyer_id;
    }

    /**
     * Returns the value of field buyer_number
     *
     * @return integer
     */
    public function getBuyerNumber()
    {
        return $this->buyer_number;
    }

    /**
     * Returns the value of field doctor_id
     *
     * @return integer
     */
    public function getDoctorId()
    {
        return $this->doctor_id;
    }

    /**
     * Returns the value of field add_time
     *
     * @return integer
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_buy_service_num';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberBuyServiceNum[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberBuyServiceNum
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
