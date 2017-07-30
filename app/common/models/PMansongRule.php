<?php

namespace Ypk\Models;

class PMansongRule extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $rule_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mansong_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $discount;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $mansong_goods_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_id;

    /**
     * Method to set the value of field rule_id
     *
     * @param integer $rule_id
     * @return $this
     */
    public function setRuleId($rule_id)
    {
        $this->rule_id = $rule_id;

        return $this;
    }

    /**
     * Method to set the value of field mansong_id
     *
     * @param integer $mansong_id
     * @return $this
     */
    public function setMansongId($mansong_id)
    {
        $this->mansong_id = $mansong_id;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param integer $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field discount
     *
     * @param integer $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Method to set the value of field mansong_goods_name
     *
     * @param string $mansong_goods_name
     * @return $this
     */
    public function setMansongGoodsName($mansong_goods_name)
    {
        $this->mansong_goods_name = $mansong_goods_name;

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
     * Returns the value of field rule_id
     *
     * @return integer
     */
    public function getRuleId()
    {
        return $this->rule_id;
    }

    /**
     * Returns the value of field mansong_id
     *
     * @return integer
     */
    public function getMansongId()
    {
        return $this->mansong_id;
    }

    /**
     * Returns the value of field price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field discount
     *
     * @return integer
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Returns the value of field mansong_goods_name
     *
     * @return string
     */
    public function getMansongGoodsName()
    {
        return $this->mansong_goods_name;
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
        return 'p_mansong_rule';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PMansongRule[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PMansongRule
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
