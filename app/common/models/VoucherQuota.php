<?php

namespace Ypk\Models;

class VoucherQuota extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $quota_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $quota_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $quota_membername;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $quota_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $quota_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $quota_starttime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $quota_endtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $quota_state;

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
     * Method to set the value of field quota_memberid
     *
     * @param integer $quota_memberid
     * @return $this
     */
    public function setQuotaMemberid($quota_memberid)
    {
        $this->quota_memberid = $quota_memberid;

        return $this;
    }

    /**
     * Method to set the value of field quota_membername
     *
     * @param string $quota_membername
     * @return $this
     */
    public function setQuotaMembername($quota_membername)
    {
        $this->quota_membername = $quota_membername;

        return $this;
    }

    /**
     * Method to set the value of field quota_storeid
     *
     * @param integer $quota_storeid
     * @return $this
     */
    public function setQuotaStoreid($quota_storeid)
    {
        $this->quota_storeid = $quota_storeid;

        return $this;
    }

    /**
     * Method to set the value of field quota_storename
     *
     * @param string $quota_storename
     * @return $this
     */
    public function setQuotaStorename($quota_storename)
    {
        $this->quota_storename = $quota_storename;

        return $this;
    }

    /**
     * Method to set the value of field quota_starttime
     *
     * @param integer $quota_starttime
     * @return $this
     */
    public function setQuotaStarttime($quota_starttime)
    {
        $this->quota_starttime = $quota_starttime;

        return $this;
    }

    /**
     * Method to set the value of field quota_endtime
     *
     * @param integer $quota_endtime
     * @return $this
     */
    public function setQuotaEndtime($quota_endtime)
    {
        $this->quota_endtime = $quota_endtime;

        return $this;
    }

    /**
     * Method to set the value of field quota_state
     *
     * @param integer $quota_state
     * @return $this
     */
    public function setQuotaState($quota_state)
    {
        $this->quota_state = $quota_state;

        return $this;
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
     * Returns the value of field quota_memberid
     *
     * @return integer
     */
    public function getQuotaMemberid()
    {
        return $this->quota_memberid;
    }

    /**
     * Returns the value of field quota_membername
     *
     * @return string
     */
    public function getQuotaMembername()
    {
        return $this->quota_membername;
    }

    /**
     * Returns the value of field quota_storeid
     *
     * @return integer
     */
    public function getQuotaStoreid()
    {
        return $this->quota_storeid;
    }

    /**
     * Returns the value of field quota_storename
     *
     * @return string
     */
    public function getQuotaStorename()
    {
        return $this->quota_storename;
    }

    /**
     * Returns the value of field quota_starttime
     *
     * @return integer
     */
    public function getQuotaStarttime()
    {
        return $this->quota_starttime;
    }

    /**
     * Returns the value of field quota_endtime
     *
     * @return integer
     */
    public function getQuotaEndtime()
    {
        return $this->quota_endtime;
    }

    /**
     * Returns the value of field quota_state
     *
     * @return integer
     */
    public function getQuotaState()
    {
        return $this->quota_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'voucher_quota';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VoucherQuota[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VoucherQuota
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
