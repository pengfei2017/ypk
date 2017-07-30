<?php

namespace Ypk\Models;

class SellerGroupBclass extends \Phalcon\Mvc\Model
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
    protected $group_id;

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
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $gc_id;

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
     * Returns the value of field bid
     *
     * @return integer
     */
    public function getBid()
    {
        return $this->bid;
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
     * Returns the value of field gc_id
     *
     * @return integer
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'seller_group_bclass';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SellerGroupBclass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SellerGroupBclass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
