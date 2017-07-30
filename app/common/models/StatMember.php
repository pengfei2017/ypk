<?php

namespace Ypk\Models;

class StatMember extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $statm_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $statm_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $statm_membername;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $statm_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $statm_ordernum;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $statm_orderamount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $statm_goodsnum;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $statm_predincrease;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $statm_predreduce;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $statm_pointsincrease;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $statm_pointsreduce;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $statm_updatetime;

    /**
     * Method to set the value of field statm_id
     *
     * @param integer $statm_id
     * @return $this
     */
    public function setStatmId($statm_id)
    {
        $this->statm_id = $statm_id;

        return $this;
    }

    /**
     * Method to set the value of field statm_memberid
     *
     * @param integer $statm_memberid
     * @return $this
     */
    public function setStatmMemberid($statm_memberid)
    {
        $this->statm_memberid = $statm_memberid;

        return $this;
    }

    /**
     * Method to set the value of field statm_membername
     *
     * @param string $statm_membername
     * @return $this
     */
    public function setStatmMembername($statm_membername)
    {
        $this->statm_membername = $statm_membername;

        return $this;
    }

    /**
     * Method to set the value of field statm_time
     *
     * @param integer $statm_time
     * @return $this
     */
    public function setStatmTime($statm_time)
    {
        $this->statm_time = $statm_time;

        return $this;
    }

    /**
     * Method to set the value of field statm_ordernum
     *
     * @param integer $statm_ordernum
     * @return $this
     */
    public function setStatmOrdernum($statm_ordernum)
    {
        $this->statm_ordernum = $statm_ordernum;

        return $this;
    }

    /**
     * Method to set the value of field statm_orderamount
     *
     * @param double $statm_orderamount
     * @return $this
     */
    public function setStatmOrderamount($statm_orderamount)
    {
        $this->statm_orderamount = $statm_orderamount;

        return $this;
    }

    /**
     * Method to set the value of field statm_goodsnum
     *
     * @param integer $statm_goodsnum
     * @return $this
     */
    public function setStatmGoodsnum($statm_goodsnum)
    {
        $this->statm_goodsnum = $statm_goodsnum;

        return $this;
    }

    /**
     * Method to set the value of field statm_predincrease
     *
     * @param double $statm_predincrease
     * @return $this
     */
    public function setStatmPredincrease($statm_predincrease)
    {
        $this->statm_predincrease = $statm_predincrease;

        return $this;
    }

    /**
     * Method to set the value of field statm_predreduce
     *
     * @param double $statm_predreduce
     * @return $this
     */
    public function setStatmPredreduce($statm_predreduce)
    {
        $this->statm_predreduce = $statm_predreduce;

        return $this;
    }

    /**
     * Method to set the value of field statm_pointsincrease
     *
     * @param integer $statm_pointsincrease
     * @return $this
     */
    public function setStatmPointsincrease($statm_pointsincrease)
    {
        $this->statm_pointsincrease = $statm_pointsincrease;

        return $this;
    }

    /**
     * Method to set the value of field statm_pointsreduce
     *
     * @param integer $statm_pointsreduce
     * @return $this
     */
    public function setStatmPointsreduce($statm_pointsreduce)
    {
        $this->statm_pointsreduce = $statm_pointsreduce;

        return $this;
    }

    /**
     * Method to set the value of field statm_updatetime
     *
     * @param integer $statm_updatetime
     * @return $this
     */
    public function setStatmUpdatetime($statm_updatetime)
    {
        $this->statm_updatetime = $statm_updatetime;

        return $this;
    }

    /**
     * Returns the value of field statm_id
     *
     * @return integer
     */
    public function getStatmId()
    {
        return $this->statm_id;
    }

    /**
     * Returns the value of field statm_memberid
     *
     * @return integer
     */
    public function getStatmMemberid()
    {
        return $this->statm_memberid;
    }

    /**
     * Returns the value of field statm_membername
     *
     * @return string
     */
    public function getStatmMembername()
    {
        return $this->statm_membername;
    }

    /**
     * Returns the value of field statm_time
     *
     * @return integer
     */
    public function getStatmTime()
    {
        return $this->statm_time;
    }

    /**
     * Returns the value of field statm_ordernum
     *
     * @return integer
     */
    public function getStatmOrdernum()
    {
        return $this->statm_ordernum;
    }

    /**
     * Returns the value of field statm_orderamount
     *
     * @return double
     */
    public function getStatmOrderamount()
    {
        return $this->statm_orderamount;
    }

    /**
     * Returns the value of field statm_goodsnum
     *
     * @return integer
     */
    public function getStatmGoodsnum()
    {
        return $this->statm_goodsnum;
    }

    /**
     * Returns the value of field statm_predincrease
     *
     * @return double
     */
    public function getStatmPredincrease()
    {
        return $this->statm_predincrease;
    }

    /**
     * Returns the value of field statm_predreduce
     *
     * @return double
     */
    public function getStatmPredreduce()
    {
        return $this->statm_predreduce;
    }

    /**
     * Returns the value of field statm_pointsincrease
     *
     * @return integer
     */
    public function getStatmPointsincrease()
    {
        return $this->statm_pointsincrease;
    }

    /**
     * Returns the value of field statm_pointsreduce
     *
     * @return integer
     */
    public function getStatmPointsreduce()
    {
        return $this->statm_pointsreduce;
    }

    /**
     * Returns the value of field statm_updatetime
     *
     * @return integer
     */
    public function getStatmUpdatetime()
    {
        return $this->statm_updatetime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'stat_member';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StatMember[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StatMember
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
