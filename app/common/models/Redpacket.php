<?php

namespace Ypk\Models;

class Redpacket extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_id;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $rpacket_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $rpacket_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $rpacket_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_start_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_end_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_price;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $rpacket_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $rpacket_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_active_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_owner_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $rpacket_owner_name;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $rpacket_order_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $rpacket_pwd;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $rpacket_pwd2;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=true)
     */
    protected $rpacket_customimg;

    /**
     * Method to set the value of field rpacket_id
     *
     * @param integer $rpacket_id
     * @return $this
     */
    public function setRpacketId($rpacket_id)
    {
        $this->rpacket_id = $rpacket_id;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_code
     *
     * @param string $rpacket_code
     * @return $this
     */
    public function setRpacketCode($rpacket_code)
    {
        $this->rpacket_code = $rpacket_code;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_id
     *
     * @param integer $rpacket_t_id
     * @return $this
     */
    public function setRpacketTId($rpacket_t_id)
    {
        $this->rpacket_t_id = $rpacket_t_id;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_title
     *
     * @param string $rpacket_title
     * @return $this
     */
    public function setRpacketTitle($rpacket_title)
    {
        $this->rpacket_title = $rpacket_title;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_desc
     *
     * @param string $rpacket_desc
     * @return $this
     */
    public function setRpacketDesc($rpacket_desc)
    {
        $this->rpacket_desc = $rpacket_desc;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_start_date
     *
     * @param integer $rpacket_start_date
     * @return $this
     */
    public function setRpacketStartDate($rpacket_start_date)
    {
        $this->rpacket_start_date = $rpacket_start_date;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_end_date
     *
     * @param integer $rpacket_end_date
     * @return $this
     */
    public function setRpacketEndDate($rpacket_end_date)
    {
        $this->rpacket_end_date = $rpacket_end_date;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_price
     *
     * @param integer $rpacket_price
     * @return $this
     */
    public function setRpacketPrice($rpacket_price)
    {
        $this->rpacket_price = $rpacket_price;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_limit
     *
     * @param double $rpacket_limit
     * @return $this
     */
    public function setRpacketLimit($rpacket_limit)
    {
        $this->rpacket_limit = $rpacket_limit;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_state
     *
     * @param integer $rpacket_state
     * @return $this
     */
    public function setRpacketState($rpacket_state)
    {
        $this->rpacket_state = $rpacket_state;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_active_date
     *
     * @param integer $rpacket_active_date
     * @return $this
     */
    public function setRpacketActiveDate($rpacket_active_date)
    {
        $this->rpacket_active_date = $rpacket_active_date;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_owner_id
     *
     * @param integer $rpacket_owner_id
     * @return $this
     */
    public function setRpacketOwnerId($rpacket_owner_id)
    {
        $this->rpacket_owner_id = $rpacket_owner_id;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_owner_name
     *
     * @param string $rpacket_owner_name
     * @return $this
     */
    public function setRpacketOwnerName($rpacket_owner_name)
    {
        $this->rpacket_owner_name = $rpacket_owner_name;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_order_id
     *
     * @param string $rpacket_order_id
     * @return $this
     */
    public function setRpacketOrderId($rpacket_order_id)
    {
        $this->rpacket_order_id = $rpacket_order_id;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_pwd
     *
     * @param string $rpacket_pwd
     * @return $this
     */
    public function setRpacketPwd($rpacket_pwd)
    {
        $this->rpacket_pwd = $rpacket_pwd;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_pwd2
     *
     * @param string $rpacket_pwd2
     * @return $this
     */
    public function setRpacketPwd2($rpacket_pwd2)
    {
        $this->rpacket_pwd2 = $rpacket_pwd2;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_customimg
     *
     * @param string $rpacket_customimg
     * @return $this
     */
    public function setRpacketCustomimg($rpacket_customimg)
    {
        $this->rpacket_customimg = $rpacket_customimg;

        return $this;
    }

    /**
     * Returns the value of field rpacket_id
     *
     * @return integer
     */
    public function getRpacketId()
    {
        return $this->rpacket_id;
    }

    /**
     * Returns the value of field rpacket_code
     *
     * @return string
     */
    public function getRpacketCode()
    {
        return $this->rpacket_code;
    }

    /**
     * Returns the value of field rpacket_t_id
     *
     * @return integer
     */
    public function getRpacketTId()
    {
        return $this->rpacket_t_id;
    }

    /**
     * Returns the value of field rpacket_title
     *
     * @return string
     */
    public function getRpacketTitle()
    {
        return $this->rpacket_title;
    }

    /**
     * Returns the value of field rpacket_desc
     *
     * @return string
     */
    public function getRpacketDesc()
    {
        return $this->rpacket_desc;
    }

    /**
     * Returns the value of field rpacket_start_date
     *
     * @return integer
     */
    public function getRpacketStartDate()
    {
        return $this->rpacket_start_date;
    }

    /**
     * Returns the value of field rpacket_end_date
     *
     * @return integer
     */
    public function getRpacketEndDate()
    {
        return $this->rpacket_end_date;
    }

    /**
     * Returns the value of field rpacket_price
     *
     * @return integer
     */
    public function getRpacketPrice()
    {
        return $this->rpacket_price;
    }

    /**
     * Returns the value of field rpacket_limit
     *
     * @return double
     */
    public function getRpacketLimit()
    {
        return $this->rpacket_limit;
    }

    /**
     * Returns the value of field rpacket_state
     *
     * @return integer
     */
    public function getRpacketState()
    {
        return $this->rpacket_state;
    }

    /**
     * Returns the value of field rpacket_active_date
     *
     * @return integer
     */
    public function getRpacketActiveDate()
    {
        return $this->rpacket_active_date;
    }

    /**
     * Returns the value of field rpacket_owner_id
     *
     * @return integer
     */
    public function getRpacketOwnerId()
    {
        return $this->rpacket_owner_id;
    }

    /**
     * Returns the value of field rpacket_owner_name
     *
     * @return string
     */
    public function getRpacketOwnerName()
    {
        return $this->rpacket_owner_name;
    }

    /**
     * Returns the value of field rpacket_order_id
     *
     * @return string
     */
    public function getRpacketOrderId()
    {
        return $this->rpacket_order_id;
    }

    /**
     * Returns the value of field rpacket_pwd
     *
     * @return string
     */
    public function getRpacketPwd()
    {
        return $this->rpacket_pwd;
    }

    /**
     * Returns the value of field rpacket_pwd2
     *
     * @return string
     */
    public function getRpacketPwd2()
    {
        return $this->rpacket_pwd2;
    }

    /**
     * Returns the value of field rpacket_customimg
     *
     * @return string
     */
    public function getRpacketCustomimg()
    {
        return $this->rpacket_customimg;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'redpacket';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Redpacket[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Redpacket
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
