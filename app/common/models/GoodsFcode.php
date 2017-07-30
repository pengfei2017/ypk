<?php

namespace Ypk\Models;

class GoodsFcode extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $fc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $fc_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $fc_state;

    /**
     * Method to set the value of field fc_id
     *
     * @param integer $fc_id
     * @return $this
     */
    public function setFcId($fc_id)
    {
        $this->fc_id = $fc_id;

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
     * Method to set the value of field fc_code
     *
     * @param string $fc_code
     * @return $this
     */
    public function setFcCode($fc_code)
    {
        $this->fc_code = $fc_code;

        return $this;
    }

    /**
     * Method to set the value of field fc_state
     *
     * @param integer $fc_state
     * @return $this
     */
    public function setFcState($fc_state)
    {
        $this->fc_state = $fc_state;

        return $this;
    }

    /**
     * Returns the value of field fc_id
     *
     * @return integer
     */
    public function getFcId()
    {
        return $this->fc_id;
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
     * Returns the value of field fc_code
     *
     * @return string
     */
    public function getFcCode()
    {
        return $this->fc_code;
    }

    /**
     * Returns the value of field fc_state
     *
     * @return integer
     */
    public function getFcState()
    {
        return $this->fc_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_fcode';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsFcode[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsFcode
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
