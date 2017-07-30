<?php

namespace Ypk\Models;

class StoreBindClass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $bid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $commis_rate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $class_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $class_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $class_3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $state;

    /**
     * Method to set the value of field bid
     *
     * @param integer $bid
     * @return $this
     */
    public function setBid($bid)
    {
        $this->bid = $bid;

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
     * Method to set the value of field commis_rate
     *
     * @param integer $commis_rate
     * @return $this
     */
    public function setCommisRate($commis_rate)
    {
        $this->commis_rate = $commis_rate;

        return $this;
    }

    /**
     * Method to set the value of field class_1
     *
     * @param integer $class_1
     * @return $this
     */
    public function setClass1($class_1)
    {
        $this->class_1 = $class_1;

        return $this;
    }

    /**
     * Method to set the value of field class_2
     *
     * @param integer $class_2
     * @return $this
     */
    public function setClass2($class_2)
    {
        $this->class_2 = $class_2;

        return $this;
    }

    /**
     * Method to set the value of field class_3
     *
     * @param integer $class_3
     * @return $this
     */
    public function setClass3($class_3)
    {
        $this->class_3 = $class_3;

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
     * Returns the value of field bid
     *
     * @return integer
     */
    public function getBid()
    {
        return $this->bid;
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
     * Returns the value of field commis_rate
     *
     * @return integer
     */
    public function getCommisRate()
    {
        return $this->commis_rate;
    }

    /**
     * Returns the value of field class_1
     *
     * @return integer
     */
    public function getClass1()
    {
        return $this->class_1;
    }

    /**
     * Returns the value of field class_2
     *
     * @return integer
     */
    public function getClass2()
    {
        return $this->class_2;
    }

    /**
     * Returns the value of field class_3
     *
     * @return integer
     */
    public function getClass3()
    {
        return $this->class_3;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_bind_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreBindClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreBindClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
