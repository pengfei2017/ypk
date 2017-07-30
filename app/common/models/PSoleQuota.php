<?php

namespace Ypk\Models;

class PSoleQuota extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sole_quota_id;

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
    protected $sole_quota_starttime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sole_quota_endtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $sole_state;

    /**
     * Method to set the value of field sole_quota_id
     *
     * @param integer $sole_quota_id
     * @return $this
     */
    public function setSoleQuotaId($sole_quota_id)
    {
        $this->sole_quota_id = $sole_quota_id;

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
     * Method to set the value of field sole_quota_starttime
     *
     * @param integer $sole_quota_starttime
     * @return $this
     */
    public function setSoleQuotaStarttime($sole_quota_starttime)
    {
        $this->sole_quota_starttime = $sole_quota_starttime;

        return $this;
    }

    /**
     * Method to set the value of field sole_quota_endtime
     *
     * @param integer $sole_quota_endtime
     * @return $this
     */
    public function setSoleQuotaEndtime($sole_quota_endtime)
    {
        $this->sole_quota_endtime = $sole_quota_endtime;

        return $this;
    }

    /**
     * Method to set the value of field sole_state
     *
     * @param integer $sole_state
     * @return $this
     */
    public function setSoleState($sole_state)
    {
        $this->sole_state = $sole_state;

        return $this;
    }

    /**
     * Returns the value of field sole_quota_id
     *
     * @return integer
     */
    public function getSoleQuotaId()
    {
        return $this->sole_quota_id;
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
     * Returns the value of field sole_quota_starttime
     *
     * @return integer
     */
    public function getSoleQuotaStarttime()
    {
        return $this->sole_quota_starttime;
    }

    /**
     * Returns the value of field sole_quota_endtime
     *
     * @return integer
     */
    public function getSoleQuotaEndtime()
    {
        return $this->sole_quota_endtime;
    }

    /**
     * Returns the value of field sole_state
     *
     * @return integer
     */
    public function getSoleState()
    {
        return $this->sole_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_sole_quota';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PSoleQuota[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PSoleQuota
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
