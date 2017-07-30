<?php

namespace Ypk\Models;

class Flowstat1 extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $stattime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $clicknum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $goods_id;

    /**
     * Method to set the value of field stattime
     *
     * @param integer $stattime
     * @return $this
     */
    public function setStattime($stattime)
    {
        $this->stattime = $stattime;

        return $this;
    }

    /**
     * Method to set the value of field clicknum
     *
     * @param integer $clicknum
     * @return $this
     */
    public function setClicknum($clicknum)
    {
        $this->clicknum = $clicknum;

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
     * Method to set the value of field type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Method to set the value of field goods_id
     *
     * @param integer $goods_id
     * @return $this
     */
    public function setGoodsId($goods_id)
    {
        $this->goods_id = $goods_id;

        return $this;
    }

    /**
     * Returns the value of field stattime
     *
     * @return integer
     */
    public function getStattime()
    {
        return $this->stattime;
    }

    /**
     * Returns the value of field clicknum
     *
     * @return integer
     */
    public function getClicknum()
    {
        return $this->clicknum;
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
     * Returns the value of field type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the value of field goods_id
     *
     * @return integer
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'flowstat_1';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Flowstat1[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Flowstat1
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
