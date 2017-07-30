<?php

namespace Ypk\Models;

class MicroStore extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $microshop_store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $shop_store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $microshop_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $microshop_commend;

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
     * Method to set the value of field microshop_store_id
     *
     * @param integer $microshop_store_id
     * @return $this
     */
    public function setMicroshopStoreId($microshop_store_id)
    {
        $this->microshop_store_id = $microshop_store_id;

        return $this;
    }

    /**
     * Method to set the value of field shop_store_id
     *
     * @param integer $shop_store_id
     * @return $this
     */
    public function setShopStoreId($shop_store_id)
    {
        $this->shop_store_id = $shop_store_id;

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
     * Returns the value of field microshop_store_id
     *
     * @return integer
     */
    public function getMicroshopStoreId()
    {
        return $this->microshop_store_id;
    }

    /**
     * Returns the value of field shop_store_id
     *
     * @return integer
     */
    public function getShopStoreId()
    {
        return $this->shop_store_id;
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
     * Returns the value of field microshop_commend
     *
     * @return integer
     */
    public function getMicroshopCommend()
    {
        return $this->microshop_commend;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'micro_store';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroStore[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroStore
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
