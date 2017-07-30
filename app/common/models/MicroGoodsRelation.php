<?php

namespace Ypk\Models;

class MicroGoodsRelation extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $relation_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $class_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $shop_class_id;

    /**
     * Method to set the value of field relation_id
     *
     * @param integer $relation_id
     * @return $this
     */
    public function setRelationId($relation_id)
    {
        $this->relation_id = $relation_id;

        return $this;
    }

    /**
     * Method to set the value of field class_id
     *
     * @param integer $class_id
     * @return $this
     */
    public function setClassId($class_id)
    {
        $this->class_id = $class_id;

        return $this;
    }

    /**
     * Method to set the value of field shop_class_id
     *
     * @param integer $shop_class_id
     * @return $this
     */
    public function setShopClassId($shop_class_id)
    {
        $this->shop_class_id = $shop_class_id;

        return $this;
    }

    /**
     * Returns the value of field relation_id
     *
     * @return integer
     */
    public function getRelationId()
    {
        return $this->relation_id;
    }

    /**
     * Returns the value of field class_id
     *
     * @return integer
     */
    public function getClassId()
    {
        return $this->class_id;
    }

    /**
     * Returns the value of field shop_class_id
     *
     * @return integer
     */
    public function getShopClassId()
    {
        return $this->shop_class_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'micro_goods_relation';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroGoodsRelation[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroGoodsRelation
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
