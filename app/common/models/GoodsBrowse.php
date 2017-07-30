<?php

namespace Ypk\Models;

class GoodsBrowse extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $browsetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $gc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $gc_id_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $gc_id_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $gc_id_3;

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
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field browsetime
     *
     * @param integer $browsetime
     * @return $this
     */
    public function setBrowsetime($browsetime)
    {
        $this->browsetime = $browsetime;

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
     * Method to set the value of field gc_id_1
     *
     * @param integer $gc_id_1
     * @return $this
     */
    public function setGcId1($gc_id_1)
    {
        $this->gc_id_1 = $gc_id_1;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_2
     *
     * @param integer $gc_id_2
     * @return $this
     */
    public function setGcId2($gc_id_2)
    {
        $this->gc_id_2 = $gc_id_2;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_3
     *
     * @param integer $gc_id_3
     * @return $this
     */
    public function setGcId3($gc_id_3)
    {
        $this->gc_id_3 = $gc_id_3;

        return $this;
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
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field browsetime
     *
     * @return integer
     */
    public function getBrowsetime()
    {
        return $this->browsetime;
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
     * Returns the value of field gc_id_1
     *
     * @return integer
     */
    public function getGcId1()
    {
        return $this->gc_id_1;
    }

    /**
     * Returns the value of field gc_id_2
     *
     * @return integer
     */
    public function getGcId2()
    {
        return $this->gc_id_2;
    }

    /**
     * Returns the value of field gc_id_3
     *
     * @return integer
     */
    public function getGcId3()
    {
        return $this->gc_id_3;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_browse';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsBrowse[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsBrowse
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
