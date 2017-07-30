<?php

namespace Ypk\Models;

class PComboQuota extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cq_id;

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
    protected $cq_starttime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cq_endtime;

    /**
     * Method to set the value of field cq_id
     *
     * @param integer $cq_id
     * @return $this
     */
    public function setCqId($cq_id)
    {
        $this->cq_id = $cq_id;

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
     * Method to set the value of field cq_starttime
     *
     * @param integer $cq_starttime
     * @return $this
     */
    public function setCqStarttime($cq_starttime)
    {
        $this->cq_starttime = $cq_starttime;

        return $this;
    }

    /**
     * Method to set the value of field cq_endtime
     *
     * @param integer $cq_endtime
     * @return $this
     */
    public function setCqEndtime($cq_endtime)
    {
        $this->cq_endtime = $cq_endtime;

        return $this;
    }

    /**
     * Returns the value of field cq_id
     *
     * @return integer
     */
    public function getCqId()
    {
        return $this->cq_id;
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
     * Returns the value of field cq_starttime
     *
     * @return integer
     */
    public function getCqStarttime()
    {
        return $this->cq_starttime;
    }

    /**
     * Returns the value of field cq_endtime
     *
     * @return integer
     */
    public function getCqEndtime()
    {
        return $this->cq_endtime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_combo_quota';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PComboQuota[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PComboQuota
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
