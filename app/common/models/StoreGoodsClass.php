<?php

namespace Ypk\Models;

class StoreGoodsClass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $stc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $stc_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $stc_parent_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $stc_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $stc_sort;

    /**
     * Method to set the value of field stc_id
     *
     * @param integer $stc_id
     * @return $this
     */
    public function setStcId($stc_id)
    {
        $this->stc_id = $stc_id;

        return $this;
    }

    /**
     * Method to set the value of field stc_name
     *
     * @param string $stc_name
     * @return $this
     */
    public function setStcName($stc_name)
    {
        $this->stc_name = $stc_name;

        return $this;
    }

    /**
     * Method to set the value of field stc_parent_id
     *
     * @param integer $stc_parent_id
     * @return $this
     */
    public function setStcParentId($stc_parent_id)
    {
        $this->stc_parent_id = $stc_parent_id;

        return $this;
    }

    /**
     * Method to set the value of field stc_state
     *
     * @param integer $stc_state
     * @return $this
     */
    public function setStcState($stc_state)
    {
        $this->stc_state = $stc_state;

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
     * Method to set the value of field stc_sort
     *
     * @param integer $stc_sort
     * @return $this
     */
    public function setStcSort($stc_sort)
    {
        $this->stc_sort = $stc_sort;

        return $this;
    }

    /**
     * Returns the value of field stc_id
     *
     * @return integer
     */
    public function getStcId()
    {
        return $this->stc_id;
    }

    /**
     * Returns the value of field stc_name
     *
     * @return string
     */
    public function getStcName()
    {
        return $this->stc_name;
    }

    /**
     * Returns the value of field stc_parent_id
     *
     * @return integer
     */
    public function getStcParentId()
    {
        return $this->stc_parent_id;
    }

    /**
     * Returns the value of field stc_state
     *
     * @return integer
     */
    public function getStcState()
    {
        return $this->stc_state;
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
     * Returns the value of field stc_sort
     *
     * @return integer
     */
    public function getStcSort()
    {
        return $this->stc_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_goods_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreGoodsClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreGoodsClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
