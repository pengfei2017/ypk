<?php

namespace Ypk\Models;

class StoreSupplier extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sup_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $sup_store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $sup_store_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $sup_name;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $sup_desc;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $sup_man;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $sup_phone;

    /**
     * Method to set the value of field sup_id
     *
     * @param integer $sup_id
     * @return $this
     */
    public function setSupId($sup_id)
    {
        $this->sup_id = $sup_id;

        return $this;
    }

    /**
     * Method to set the value of field sup_store_id
     *
     * @param integer $sup_store_id
     * @return $this
     */
    public function setSupStoreId($sup_store_id)
    {
        $this->sup_store_id = $sup_store_id;

        return $this;
    }

    /**
     * Method to set the value of field sup_store_name
     *
     * @param string $sup_store_name
     * @return $this
     */
    public function setSupStoreName($sup_store_name)
    {
        $this->sup_store_name = $sup_store_name;

        return $this;
    }

    /**
     * Method to set the value of field sup_name
     *
     * @param string $sup_name
     * @return $this
     */
    public function setSupName($sup_name)
    {
        $this->sup_name = $sup_name;

        return $this;
    }

    /**
     * Method to set the value of field sup_desc
     *
     * @param string $sup_desc
     * @return $this
     */
    public function setSupDesc($sup_desc)
    {
        $this->sup_desc = $sup_desc;

        return $this;
    }

    /**
     * Method to set the value of field sup_man
     *
     * @param string $sup_man
     * @return $this
     */
    public function setSupMan($sup_man)
    {
        $this->sup_man = $sup_man;

        return $this;
    }

    /**
     * Method to set the value of field sup_phone
     *
     * @param string $sup_phone
     * @return $this
     */
    public function setSupPhone($sup_phone)
    {
        $this->sup_phone = $sup_phone;

        return $this;
    }

    /**
     * Returns the value of field sup_id
     *
     * @return integer
     */
    public function getSupId()
    {
        return $this->sup_id;
    }

    /**
     * Returns the value of field sup_store_id
     *
     * @return integer
     */
    public function getSupStoreId()
    {
        return $this->sup_store_id;
    }

    /**
     * Returns the value of field sup_store_name
     *
     * @return string
     */
    public function getSupStoreName()
    {
        return $this->sup_store_name;
    }

    /**
     * Returns the value of field sup_name
     *
     * @return string
     */
    public function getSupName()
    {
        return $this->sup_name;
    }

    /**
     * Returns the value of field sup_desc
     *
     * @return string
     */
    public function getSupDesc()
    {
        return $this->sup_desc;
    }

    /**
     * Returns the value of field sup_man
     *
     * @return string
     */
    public function getSupMan()
    {
        return $this->sup_man;
    }

    /**
     * Returns the value of field sup_phone
     *
     * @return string
     */
    public function getSupPhone()
    {
        return $this->sup_phone;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_supplier';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreSupplier[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreSupplier
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
