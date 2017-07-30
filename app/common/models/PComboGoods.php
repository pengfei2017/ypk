<?php

namespace Ypk\Models;

class PComboGoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cg_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $cg_class;

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
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $combo_goodsid;

    /**
     * Method to set the value of field cg_id
     *
     * @param integer $cg_id
     * @return $this
     */
    public function setCgId($cg_id)
    {
        $this->cg_id = $cg_id;

        return $this;
    }

    /**
     * Method to set the value of field cg_class
     *
     * @param string $cg_class
     * @return $this
     */
    public function setCgClass($cg_class)
    {
        $this->cg_class = $cg_class;

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
     * Method to set the value of field combo_goodsid
     *
     * @param integer $combo_goodsid
     * @return $this
     */
    public function setComboGoodsid($combo_goodsid)
    {
        $this->combo_goodsid = $combo_goodsid;

        return $this;
    }

    /**
     * Returns the value of field cg_id
     *
     * @return integer
     */
    public function getCgId()
    {
        return $this->cg_id;
    }

    /**
     * Returns the value of field cg_class
     *
     * @return string
     */
    public function getCgClass()
    {
        return $this->cg_class;
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
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field combo_goodsid
     *
     * @return integer
     */
    public function getComboGoodsid()
    {
        return $this->combo_goodsid;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_combo_goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PComboGoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PComboGoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
