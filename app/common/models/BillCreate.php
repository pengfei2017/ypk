<?php

namespace Ypk\Models;

class BillCreate extends \Phalcon\Mvc\Model
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
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $os_month;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $os_type;

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
     * Method to set the value of field os_month
     *
     * @param integer $os_month
     * @return $this
     */
    public function setOsMonth($os_month)
    {
        $this->os_month = $os_month;

        return $this;
    }

    /**
     * Method to set the value of field os_type
     *
     * @param integer $os_type
     * @return $this
     */
    public function setOsType($os_type)
    {
        $this->os_type = $os_type;

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
     * Returns the value of field os_month
     *
     * @return integer
     */
    public function getOsMonth()
    {
        return $this->os_month;
    }

    /**
     * Returns the value of field os_type
     *
     * @return integer
     */
    public function getOsType()
    {
        return $this->os_type;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'bill_create';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BillCreate[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BillCreate
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
