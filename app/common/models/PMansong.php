<?php

namespace Ypk\Models;

class PMansong extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mansong_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $mansong_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $quota_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $end_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

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
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $state;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $remark;

    /**
     * Method to set the value of field mansong_id
     *
     * @param integer $mansong_id
     * @return $this
     */
    public function setMansongId($mansong_id)
    {
        $this->mansong_id = $mansong_id;

        return $this;
    }

    /**
     * Method to set the value of field mansong_name
     *
     * @param string $mansong_name
     * @return $this
     */
    public function setMansongName($mansong_name)
    {
        $this->mansong_name = $mansong_name;

        return $this;
    }

    /**
     * Method to set the value of field quota_id
     *
     * @param integer $quota_id
     * @return $this
     */
    public function setQuotaId($quota_id)
    {
        $this->quota_id = $quota_id;

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
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

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
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

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
     * Method to set the value of field state
     *
     * @param integer $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Method to set the value of field remark
     *
     * @param string $remark
     * @return $this
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Returns the value of field mansong_id
     *
     * @return integer
     */
    public function getMansongId()
    {
        return $this->mansong_id;
    }

    /**
     * Returns the value of field mansong_name
     *
     * @return string
     */
    public function getMansongName()
    {
        return $this->mansong_name;
    }

    /**
     * Returns the value of field quota_id
     *
     * @return integer
     */
    public function getQuotaId()
    {
        return $this->quota_id;
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
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
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
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
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
     * Returns the value of field state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Returns the value of field remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_mansong';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PMansong[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PMansong
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
