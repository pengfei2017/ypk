<?php

namespace Ypk\Models;

class SellerGroup extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $group_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $group_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $limits;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $smt_limits;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $gc_limits;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     * Method to set the value of field group_id
     *
     * @param integer $group_id
     * @return $this
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;

        return $this;
    }

    /**
     * Method to set the value of field group_name
     *
     * @param string $group_name
     * @return $this
     */
    public function setGroupName($group_name)
    {
        $this->group_name = $group_name;

        return $this;
    }

    /**
     * Method to set the value of field limits
     *
     * @param string $limits
     * @return $this
     */
    public function setLimits($limits)
    {
        $this->limits = $limits;

        return $this;
    }

    /**
     * Method to set the value of field smt_limits
     *
     * @param string $smt_limits
     * @return $this
     */
    public function setSmtLimits($smt_limits)
    {
        $this->smt_limits = $smt_limits;

        return $this;
    }

    /**
     * Method to set the value of field gc_limits
     *
     * @param integer $gc_limits
     * @return $this
     */
    public function setGcLimits($gc_limits)
    {
        $this->gc_limits = $gc_limits;

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
     * Returns the value of field group_id
     *
     * @return integer
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * Returns the value of field group_name
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * Returns the value of field limits
     *
     * @return string
     */
    public function getLimits()
    {
        return $this->limits;
    }

    /**
     * Returns the value of field smt_limits
     *
     * @return string
     */
    public function getSmtLimits()
    {
        return $this->smt_limits;
    }

    /**
     * Returns the value of field gc_limits
     *
     * @return integer
     */
    public function getGcLimits()
    {
        return $this->gc_limits;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'seller_group';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SellerGroup[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SellerGroup
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
