<?php

namespace Ypk\Models;

class OrderSnapshot extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rec_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $create_time;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $goods_attr;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $goods_body;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $plate_top;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $plate_bottom;

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
     * Method to set the value of field create_time
     *
     * @param integer $create_time
     * @return $this
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;

        return $this;
    }

    /**
     * Method to set the value of field goods_attr
     *
     * @param string $goods_attr
     * @return $this
     */
    public function setGoodsAttr($goods_attr)
    {
        $this->goods_attr = $goods_attr;

        return $this;
    }

    /**
     * Method to set the value of field goods_body
     *
     * @param string $goods_body
     * @return $this
     */
    public function setGoodsBody($goods_body)
    {
        $this->goods_body = $goods_body;

        return $this;
    }

    /**
     * Method to set the value of field plate_top
     *
     * @param string $plate_top
     * @return $this
     */
    public function setPlateTop($plate_top)
    {
        $this->plate_top = $plate_top;

        return $this;
    }

    /**
     * Method to set the value of field plate_bottom
     *
     * @param string $plate_bottom
     * @return $this
     */
    public function setPlateBottom($plate_bottom)
    {
        $this->plate_bottom = $plate_bottom;

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
     * Returns the value of field goods_id
     *
     * @return integer
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * Returns the value of field create_time
     *
     * @return integer
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * Returns the value of field goods_attr
     *
     * @return string
     */
    public function getGoodsAttr()
    {
        return $this->goods_attr;
    }

    /**
     * Returns the value of field goods_body
     *
     * @return string
     */
    public function getGoodsBody()
    {
        return $this->goods_body;
    }

    /**
     * Returns the value of field plate_top
     *
     * @return string
     */
    public function getPlateTop()
    {
        return $this->plate_top;
    }

    /**
     * Returns the value of field plate_bottom
     *
     * @return string
     */
    public function getPlateBottom()
    {
        return $this->plate_bottom;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'order_snapshot';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderSnapshot[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderSnapshot
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
