<?php

namespace Ypk\Models;

class PFcodeQuota extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $fcq_id;

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
    protected $fcq_starttime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $fcq_endtime;

    /**
     * Method to set the value of field fcq_id
     *
     * @param integer $fcq_id
     * @return $this
     */
    public function setFcqId($fcq_id)
    {
        $this->fcq_id = $fcq_id;

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
     * Method to set the value of field fcq_starttime
     *
     * @param integer $fcq_starttime
     * @return $this
     */
    public function setFcqStarttime($fcq_starttime)
    {
        $this->fcq_starttime = $fcq_starttime;

        return $this;
    }

    /**
     * Method to set the value of field fcq_endtime
     *
     * @param integer $fcq_endtime
     * @return $this
     */
    public function setFcqEndtime($fcq_endtime)
    {
        $this->fcq_endtime = $fcq_endtime;

        return $this;
    }

    /**
     * Returns the value of field fcq_id
     *
     * @return integer
     */
    public function getFcqId()
    {
        return $this->fcq_id;
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
     * Returns the value of field fcq_starttime
     *
     * @return integer
     */
    public function getFcqStarttime()
    {
        return $this->fcq_starttime;
    }

    /**
     * Returns the value of field fcq_endtime
     *
     * @return integer
     */
    public function getFcqEndtime()
    {
        return $this->fcq_endtime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_fcode_quota';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PFcodeQuota[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PFcodeQuota
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
