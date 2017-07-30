<?php

namespace Ypk\Models;

class PCouQuota extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

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
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $tstart;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $tend;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * Method to set the value of field tstart
     *
     * @param integer $tstart
     * @return $this
     */
    public function setTstart($tstart)
    {
        $this->tstart = $tstart;

        return $this;
    }

    /**
     * Method to set the value of field tend
     *
     * @param integer $tend
     * @return $this
     */
    public function setTend($tend)
    {
        $this->tend = $tend;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Returns the value of field tstart
     *
     * @return integer
     */
    public function getTstart()
    {
        return $this->tstart;
    }

    /**
     * Returns the value of field tend
     *
     * @return integer
     */
    public function getTend()
    {
        return $this->tend;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_cou_quota';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PCouQuota[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PCouQuota
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
