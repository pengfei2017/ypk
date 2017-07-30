<?php

namespace Ypk\Models;

class PBoothQuota extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $booth_quota_id;

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
    protected $booth_quota_starttime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $booth_quota_endtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $booth_state;

    /**
     * Method to set the value of field booth_quota_id
     *
     * @param integer $booth_quota_id
     * @return $this
     */
    public function setBoothQuotaId($booth_quota_id)
    {
        $this->booth_quota_id = $booth_quota_id;

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
     * Method to set the value of field booth_quota_starttime
     *
     * @param integer $booth_quota_starttime
     * @return $this
     */
    public function setBoothQuotaStarttime($booth_quota_starttime)
    {
        $this->booth_quota_starttime = $booth_quota_starttime;

        return $this;
    }

    /**
     * Method to set the value of field booth_quota_endtime
     *
     * @param integer $booth_quota_endtime
     * @return $this
     */
    public function setBoothQuotaEndtime($booth_quota_endtime)
    {
        $this->booth_quota_endtime = $booth_quota_endtime;

        return $this;
    }

    /**
     * Method to set the value of field booth_state
     *
     * @param integer $booth_state
     * @return $this
     */
    public function setBoothState($booth_state)
    {
        $this->booth_state = $booth_state;

        return $this;
    }

    /**
     * Returns the value of field booth_quota_id
     *
     * @return integer
     */
    public function getBoothQuotaId()
    {
        return $this->booth_quota_id;
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
     * Returns the value of field booth_quota_starttime
     *
     * @return integer
     */
    public function getBoothQuotaStarttime()
    {
        return $this->booth_quota_starttime;
    }

    /**
     * Returns the value of field booth_quota_endtime
     *
     * @return integer
     */
    public function getBoothQuotaEndtime()
    {
        return $this->booth_quota_endtime;
    }

    /**
     * Returns the value of field booth_state
     *
     * @return integer
     */
    public function getBoothState()
    {
        return $this->booth_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_booth_quota';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBoothQuota[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBoothQuota
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
