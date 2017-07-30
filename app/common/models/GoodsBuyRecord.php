<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 21:00
 */

namespace Ypk\Models;


use Phalcon\Mvc\Model;

class GoodsBuyRecord extends Model
{
    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $buyer_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_time;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getBuyerId()
    {
        return $this->buyer_id;
    }

    /**
     * @param int $buyer_id
     */
    public function setBuyerId($buyer_id)
    {
        $this->buyer_id = $buyer_id;
    }

    /**
     * @return int
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * @param int $goods_id
     */
    public function setGoodsId($goods_id)
    {
        $this->goods_id = $goods_id;
    }

    /**
     * @return int
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * @param int $add_time
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_buy_record';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsBuyRecord[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsBuyRecord
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}