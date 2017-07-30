<?php

namespace Ypk\Models;

class PBookQuota extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $bkq_id;

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
    protected $bkq_starttime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $bkq_endtime;

    /**
     * Method to set the value of field bkq_id
     *
     * @param integer $bkq_id
     * @return $this
     */
    public function setBkqId($bkq_id)
    {
        $this->bkq_id = $bkq_id;

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
     * Method to set the value of field bkq_starttime
     *
     * @param integer $bkq_starttime
     * @return $this
     */
    public function setBkqStarttime($bkq_starttime)
    {
        $this->bkq_starttime = $bkq_starttime;

        return $this;
    }

    /**
     * Method to set the value of field bkq_endtime
     *
     * @param integer $bkq_endtime
     * @return $this
     */
    public function setBkqEndtime($bkq_endtime)
    {
        $this->bkq_endtime = $bkq_endtime;

        return $this;
    }

    /**
     * Returns the value of field bkq_id
     *
     * @return integer
     */
    public function getBkqId()
    {
        return $this->bkq_id;
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
     * Returns the value of field bkq_starttime
     *
     * @return integer
     */
    public function getBkqStarttime()
    {
        return $this->bkq_starttime;
    }

    /**
     * Returns the value of field bkq_endtime
     *
     * @return integer
     */
    public function getBkqEndtime()
    {
        return $this->bkq_endtime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_book_quota';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBookQuota[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBookQuota
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
