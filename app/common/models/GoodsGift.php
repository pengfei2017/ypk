<?php

namespace Ypk\Models;

class GoodsGift extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gift_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_commonid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gift_goodsid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $gift_goodsname;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $gift_goodsimage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $gift_amount;

    /**
     * Method to set the value of field gift_id
     *
     * @param integer $gift_id
     * @return $this
     */
    public function setGiftId($gift_id)
    {
        $this->gift_id = $gift_id;

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
     * Method to set the value of field goods_commonid
     *
     * @param integer $goods_commonid
     * @return $this
     */
    public function setGoodsCommonid($goods_commonid)
    {
        $this->goods_commonid = $goods_commonid;

        return $this;
    }

    /**
     * Method to set the value of field gift_goodsid
     *
     * @param integer $gift_goodsid
     * @return $this
     */
    public function setGiftGoodsid($gift_goodsid)
    {
        $this->gift_goodsid = $gift_goodsid;

        return $this;
    }

    /**
     * Method to set the value of field gift_goodsname
     *
     * @param string $gift_goodsname
     * @return $this
     */
    public function setGiftGoodsname($gift_goodsname)
    {
        $this->gift_goodsname = $gift_goodsname;

        return $this;
    }

    /**
     * Method to set the value of field gift_goodsimage
     *
     * @param string $gift_goodsimage
     * @return $this
     */
    public function setGiftGoodsimage($gift_goodsimage)
    {
        $this->gift_goodsimage = $gift_goodsimage;

        return $this;
    }

    /**
     * Method to set the value of field gift_amount
     *
     * @param integer $gift_amount
     * @return $this
     */
    public function setGiftAmount($gift_amount)
    {
        $this->gift_amount = $gift_amount;

        return $this;
    }

    /**
     * Returns the value of field gift_id
     *
     * @return integer
     */
    public function getGiftId()
    {
        return $this->gift_id;
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
     * Returns the value of field goods_commonid
     *
     * @return integer
     */
    public function getGoodsCommonid()
    {
        return $this->goods_commonid;
    }

    /**
     * Returns the value of field gift_goodsid
     *
     * @return integer
     */
    public function getGiftGoodsid()
    {
        return $this->gift_goodsid;
    }

    /**
     * Returns the value of field gift_goodsname
     *
     * @return string
     */
    public function getGiftGoodsname()
    {
        return $this->gift_goodsname;
    }

    /**
     * Returns the value of field gift_goodsimage
     *
     * @return string
     */
    public function getGiftGoodsimage()
    {
        return $this->gift_goodsimage;
    }

    /**
     * Returns the value of field gift_amount
     *
     * @return integer
     */
    public function getGiftAmount()
    {
        return $this->gift_amount;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_gift';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsGift[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsGift
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
