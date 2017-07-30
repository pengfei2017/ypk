<?php

namespace Ypk\Models;

class StoreDistribution extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $distri_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $distri_store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $distri_store_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $distri_seller_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $distri_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $distri_create_time;

    /**
     * Method to set the value of field distri_id
     *
     * @param integer $distri_id
     * @return $this
     */
    public function setDistriId($distri_id)
    {
        $this->distri_id = $distri_id;

        return $this;
    }

    /**
     * Method to set the value of field distri_store_id
     *
     * @param integer $distri_store_id
     * @return $this
     */
    public function setDistriStoreId($distri_store_id)
    {
        $this->distri_store_id = $distri_store_id;

        return $this;
    }

    /**
     * Method to set the value of field distri_store_name
     *
     * @param string $distri_store_name
     * @return $this
     */
    public function setDistriStoreName($distri_store_name)
    {
        $this->distri_store_name = $distri_store_name;

        return $this;
    }

    /**
     * Method to set the value of field distri_seller_name
     *
     * @param string $distri_seller_name
     * @return $this
     */
    public function setDistriSellerName($distri_seller_name)
    {
        $this->distri_seller_name = $distri_seller_name;

        return $this;
    }

    /**
     * Method to set the value of field distri_state
     *
     * @param integer $distri_state
     * @return $this
     */
    public function setDistriState($distri_state)
    {
        $this->distri_state = $distri_state;

        return $this;
    }

    /**
     * Method to set the value of field distri_create_time
     *
     * @param integer $distri_create_time
     * @return $this
     */
    public function setDistriCreateTime($distri_create_time)
    {
        $this->distri_create_time = $distri_create_time;

        return $this;
    }

    /**
     * Returns the value of field distri_id
     *
     * @return integer
     */
    public function getDistriId()
    {
        return $this->distri_id;
    }

    /**
     * Returns the value of field distri_store_id
     *
     * @return integer
     */
    public function getDistriStoreId()
    {
        return $this->distri_store_id;
    }

    /**
     * Returns the value of field distri_store_name
     *
     * @return string
     */
    public function getDistriStoreName()
    {
        return $this->distri_store_name;
    }

    /**
     * Returns the value of field distri_seller_name
     *
     * @return string
     */
    public function getDistriSellerName()
    {
        return $this->distri_seller_name;
    }

    /**
     * Returns the value of field distri_state
     *
     * @return integer
     */
    public function getDistriState()
    {
        return $this->distri_state;
    }

    /**
     * Returns the value of field distri_create_time
     *
     * @return integer
     */
    public function getDistriCreateTime()
    {
        return $this->distri_create_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_distribution';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreDistribution[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreDistribution
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
