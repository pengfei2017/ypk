<?php

namespace Ypk\Models;

class GoodsRecommend extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $rec_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $rec_gc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $rec_goods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $rec_gc_name;

    /**
     * Method to set the value of field rec_id
     *
     * @param integer $rec_id
     * @return $this
     */
    public function setRecId($rec_id)
    {
        $this->rec_id = $rec_id;

        return $this;
    }

    /**
     * Method to set the value of field rec_gc_id
     *
     * @param integer $rec_gc_id
     * @return $this
     */
    public function setRecGcId($rec_gc_id)
    {
        $this->rec_gc_id = $rec_gc_id;

        return $this;
    }

    /**
     * Method to set the value of field rec_goods_id
     *
     * @param integer $rec_goods_id
     * @return $this
     */
    public function setRecGoodsId($rec_goods_id)
    {
        $this->rec_goods_id = $rec_goods_id;

        return $this;
    }

    /**
     * Method to set the value of field rec_gc_name
     *
     * @param string $rec_gc_name
     * @return $this
     */
    public function setRecGcName($rec_gc_name)
    {
        $this->rec_gc_name = $rec_gc_name;

        return $this;
    }

    /**
     * Returns the value of field rec_id
     *
     * @return integer
     */
    public function getRecId()
    {
        return $this->rec_id;
    }

    /**
     * Returns the value of field rec_gc_id
     *
     * @return integer
     */
    public function getRecGcId()
    {
        return $this->rec_gc_id;
    }

    /**
     * Returns the value of field rec_goods_id
     *
     * @return integer
     */
    public function getRecGoodsId()
    {
        return $this->rec_goods_id;
    }

    /**
     * Returns the value of field rec_gc_name
     *
     * @return string
     */
    public function getRecGcName()
    {
        return $this->rec_gc_name;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_recommend';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsRecommend[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsRecommend
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
