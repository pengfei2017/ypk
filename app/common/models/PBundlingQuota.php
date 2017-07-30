<?php

namespace Ypk\Models;

class PBundlingQuota extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $bl_quota_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
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
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $bl_quota_month;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $bl_quota_starttime;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $bl_quota_endtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $bl_state;

    /**
     * Method to set the value of field bl_quota_id
     *
     * @param integer $bl_quota_id
     * @return $this
     */
    public function setBlQuotaId($bl_quota_id)
    {
        $this->bl_quota_id = $bl_quota_id;

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
     * Method to set the value of field bl_quota_month
     *
     * @param integer $bl_quota_month
     * @return $this
     */
    public function setBlQuotaMonth($bl_quota_month)
    {
        $this->bl_quota_month = $bl_quota_month;

        return $this;
    }

    /**
     * Method to set the value of field bl_quota_starttime
     *
     * @param string $bl_quota_starttime
     * @return $this
     */
    public function setBlQuotaStarttime($bl_quota_starttime)
    {
        $this->bl_quota_starttime = $bl_quota_starttime;

        return $this;
    }

    /**
     * Method to set the value of field bl_quota_endtime
     *
     * @param string $bl_quota_endtime
     * @return $this
     */
    public function setBlQuotaEndtime($bl_quota_endtime)
    {
        $this->bl_quota_endtime = $bl_quota_endtime;

        return $this;
    }

    /**
     * Method to set the value of field bl_state
     *
     * @param integer $bl_state
     * @return $this
     */
    public function setBlState($bl_state)
    {
        $this->bl_state = $bl_state;

        return $this;
    }

    /**
     * Returns the value of field bl_quota_id
     *
     * @return integer
     */
    public function getBlQuotaId()
    {
        return $this->bl_quota_id;
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
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
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
     * Returns the value of field bl_quota_month
     *
     * @return integer
     */
    public function getBlQuotaMonth()
    {
        return $this->bl_quota_month;
    }

    /**
     * Returns the value of field bl_quota_starttime
     *
     * @return string
     */
    public function getBlQuotaStarttime()
    {
        return $this->bl_quota_starttime;
    }

    /**
     * Returns the value of field bl_quota_endtime
     *
     * @return string
     */
    public function getBlQuotaEndtime()
    {
        return $this->bl_quota_endtime;
    }

    /**
     * Returns the value of field bl_state
     *
     * @return integer
     */
    public function getBlState()
    {
        return $this->bl_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_bundling_quota';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBundlingQuota[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBundlingQuota
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
