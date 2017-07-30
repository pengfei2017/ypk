<?php

namespace Ypk\Models;

class MicroGoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $commend_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $commend_member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $commend_goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $commend_goods_commonid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $commend_goods_store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $commend_goods_name;

    /**
     *
     * @var double
     * @Column(type="double", length=11, nullable=false)
     */
    protected $commend_goods_price;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $commend_goods_image;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=false)
     */
    protected $commend_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $commend_time;

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
    protected $like_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $comment_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $click_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $microshop_commend;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $microshop_sort;

    /**
     * Method to set the value of field commend_id
     *
     * @param integer $commend_id
     * @return $this
     */
    public function setCommendId($commend_id)
    {
        $this->commend_id = $commend_id;

        return $this;
    }

    /**
     * Method to set the value of field commend_member_id
     *
     * @param integer $commend_member_id
     * @return $this
     */
    public function setCommendMemberId($commend_member_id)
    {
        $this->commend_member_id = $commend_member_id;

        return $this;
    }

    /**
     * Method to set the value of field commend_goods_id
     *
     * @param integer $commend_goods_id
     * @return $this
     */
    public function setCommendGoodsId($commend_goods_id)
    {
        $this->commend_goods_id = $commend_goods_id;

        return $this;
    }

    /**
     * Method to set the value of field commend_goods_commonid
     *
     * @param integer $commend_goods_commonid
     * @return $this
     */
    public function setCommendGoodsCommonid($commend_goods_commonid)
    {
        $this->commend_goods_commonid = $commend_goods_commonid;

        return $this;
    }

    /**
     * Method to set the value of field commend_goods_store_id
     *
     * @param integer $commend_goods_store_id
     * @return $this
     */
    public function setCommendGoodsStoreId($commend_goods_store_id)
    {
        $this->commend_goods_store_id = $commend_goods_store_id;

        return $this;
    }

    /**
     * Method to set the value of field commend_goods_name
     *
     * @param string $commend_goods_name
     * @return $this
     */
    public function setCommendGoodsName($commend_goods_name)
    {
        $this->commend_goods_name = $commend_goods_name;

        return $this;
    }

    /**
     * Method to set the value of field commend_goods_price
     *
     * @param double $commend_goods_price
     * @return $this
     */
    public function setCommendGoodsPrice($commend_goods_price)
    {
        $this->commend_goods_price = $commend_goods_price;

        return $this;
    }

    /**
     * Method to set the value of field commend_goods_image
     *
     * @param string $commend_goods_image
     * @return $this
     */
    public function setCommendGoodsImage($commend_goods_image)
    {
        $this->commend_goods_image = $commend_goods_image;

        return $this;
    }

    /**
     * Method to set the value of field commend_message
     *
     * @param string $commend_message
     * @return $this
     */
    public function setCommendMessage($commend_message)
    {
        $this->commend_message = $commend_message;

        return $this;
    }

    /**
     * Method to set the value of field commend_time
     *
     * @param integer $commend_time
     * @return $this
     */
    public function setCommendTime($commend_time)
    {
        $this->commend_time = $commend_time;

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
     * Method to set the value of field like_count
     *
     * @param integer $like_count
     * @return $this
     */
    public function setLikeCount($like_count)
    {
        $this->like_count = $like_count;

        return $this;
    }

    /**
     * Method to set the value of field comment_count
     *
     * @param integer $comment_count
     * @return $this
     */
    public function setCommentCount($comment_count)
    {
        $this->comment_count = $comment_count;

        return $this;
    }

    /**
     * Method to set the value of field click_count
     *
     * @param integer $click_count
     * @return $this
     */
    public function setClickCount($click_count)
    {
        $this->click_count = $click_count;

        return $this;
    }

    /**
     * Method to set the value of field microshop_commend
     *
     * @param integer $microshop_commend
     * @return $this
     */
    public function setMicroshopCommend($microshop_commend)
    {
        $this->microshop_commend = $microshop_commend;

        return $this;
    }

    /**
     * Method to set the value of field microshop_sort
     *
     * @param integer $microshop_sort
     * @return $this
     */
    public function setMicroshopSort($microshop_sort)
    {
        $this->microshop_sort = $microshop_sort;

        return $this;
    }

    /**
     * Returns the value of field commend_id
     *
     * @return integer
     */
    public function getCommendId()
    {
        return $this->commend_id;
    }

    /**
     * Returns the value of field commend_member_id
     *
     * @return integer
     */
    public function getCommendMemberId()
    {
        return $this->commend_member_id;
    }

    /**
     * Returns the value of field commend_goods_id
     *
     * @return integer
     */
    public function getCommendGoodsId()
    {
        return $this->commend_goods_id;
    }

    /**
     * Returns the value of field commend_goods_commonid
     *
     * @return integer
     */
    public function getCommendGoodsCommonid()
    {
        return $this->commend_goods_commonid;
    }

    /**
     * Returns the value of field commend_goods_store_id
     *
     * @return integer
     */
    public function getCommendGoodsStoreId()
    {
        return $this->commend_goods_store_id;
    }

    /**
     * Returns the value of field commend_goods_name
     *
     * @return string
     */
    public function getCommendGoodsName()
    {
        return $this->commend_goods_name;
    }

    /**
     * Returns the value of field commend_goods_price
     *
     * @return double
     */
    public function getCommendGoodsPrice()
    {
        return $this->commend_goods_price;
    }

    /**
     * Returns the value of field commend_goods_image
     *
     * @return string
     */
    public function getCommendGoodsImage()
    {
        return $this->commend_goods_image;
    }

    /**
     * Returns the value of field commend_message
     *
     * @return string
     */
    public function getCommendMessage()
    {
        return $this->commend_message;
    }

    /**
     * Returns the value of field commend_time
     *
     * @return integer
     */
    public function getCommendTime()
    {
        return $this->commend_time;
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
     * Returns the value of field like_count
     *
     * @return integer
     */
    public function getLikeCount()
    {
        return $this->like_count;
    }

    /**
     * Returns the value of field comment_count
     *
     * @return integer
     */
    public function getCommentCount()
    {
        return $this->comment_count;
    }

    /**
     * Returns the value of field click_count
     *
     * @return integer
     */
    public function getClickCount()
    {
        return $this->click_count;
    }

    /**
     * Returns the value of field microshop_commend
     *
     * @return integer
     */
    public function getMicroshopCommend()
    {
        return $this->microshop_commend;
    }

    /**
     * Returns the value of field microshop_sort
     *
     * @return integer
     */
    public function getMicroshopSort()
    {
        return $this->microshop_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'micro_goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroGoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroGoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
