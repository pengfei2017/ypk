<?php

namespace Ypk\Models;

class SpecValue extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sp_value_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $sp_value_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sp_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $sp_value_color;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $sp_value_sort;

    /**
     * Method to set the value of field sp_value_id
     *
     * @param integer $sp_value_id
     * @return $this
     */
    public function setSpValueId($sp_value_id)
    {
        $this->sp_value_id = $sp_value_id;

        return $this;
    }

    /**
     * Method to set the value of field sp_value_name
     *
     * @param string $sp_value_name
     * @return $this
     */
    public function setSpValueName($sp_value_name)
    {
        $this->sp_value_name = $sp_value_name;

        return $this;
    }

    /**
     * Method to set the value of field sp_id
     *
     * @param integer $sp_id
     * @return $this
     */
    public function setSpId($sp_id)
    {
        $this->sp_id = $sp_id;

        return $this;
    }

    /**
     * Method to set the value of field gc_id
     *
     * @param integer $gc_id
     * @return $this
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

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
     * Method to set the value of field sp_value_color
     *
     * @param string $sp_value_color
     * @return $this
     */
    public function setSpValueColor($sp_value_color)
    {
        $this->sp_value_color = $sp_value_color;

        return $this;
    }

    /**
     * Method to set the value of field sp_value_sort
     *
     * @param integer $sp_value_sort
     * @return $this
     */
    public function setSpValueSort($sp_value_sort)
    {
        $this->sp_value_sort = $sp_value_sort;

        return $this;
    }

    /**
     * Returns the value of field sp_value_id
     *
     * @return integer
     */
    public function getSpValueId()
    {
        return $this->sp_value_id;
    }

    /**
     * Returns the value of field sp_value_name
     *
     * @return string
     */
    public function getSpValueName()
    {
        return $this->sp_value_name;
    }

    /**
     * Returns the value of field sp_id
     *
     * @return integer
     */
    public function getSpId()
    {
        return $this->sp_id;
    }

    /**
     * Returns the value of field gc_id
     *
     * @return integer
     */
    public function getGcId()
    {
        return $this->gc_id;
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
     * Returns the value of field sp_value_color
     *
     * @return string
     */
    public function getSpValueColor()
    {
        return $this->sp_value_color;
    }

    /**
     * Returns the value of field sp_value_sort
     *
     * @return integer
     */
    public function getSpValueSort()
    {
        return $this->sp_value_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'spec_value';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SpecValue[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SpecValue
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
