<?php

namespace Ypk\Models;

class ArrivalNotice extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $an_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $goods_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

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
    protected $an_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $an_email;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=false)
     */
    protected $an_mobile;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $an_type;

    /**
     * Method to set the value of field an_id
     *
     * @param integer $an_id
     * @return $this
     */
    public function setAnId($an_id)
    {
        $this->an_id = $an_id;

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
     * Method to set the value of field goods_name
     *
     * @param string $goods_name
     * @return $this
     */
    public function setGoodsName($goods_name)
    {
        $this->goods_name = $goods_name;

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
     * Method to set the value of field an_addtime
     *
     * @param integer $an_addtime
     * @return $this
     */
    public function setAnAddtime($an_addtime)
    {
        $this->an_addtime = $an_addtime;

        return $this;
    }

    /**
     * Method to set the value of field an_email
     *
     * @param string $an_email
     * @return $this
     */
    public function setAnEmail($an_email)
    {
        $this->an_email = $an_email;

        return $this;
    }

    /**
     * Method to set the value of field an_mobile
     *
     * @param string $an_mobile
     * @return $this
     */
    public function setAnMobile($an_mobile)
    {
        $this->an_mobile = $an_mobile;

        return $this;
    }

    /**
     * Method to set the value of field an_type
     *
     * @param integer $an_type
     * @return $this
     */
    public function setAnType($an_type)
    {
        $this->an_type = $an_type;

        return $this;
    }

    /**
     * Returns the value of field an_id
     *
     * @return integer
     */
    public function getAnId()
    {
        return $this->an_id;
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
     * Returns the value of field goods_name
     *
     * @return string
     */
    public function getGoodsName()
    {
        return $this->goods_name;
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
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field an_addtime
     *
     * @return integer
     */
    public function getAnAddtime()
    {
        return $this->an_addtime;
    }

    /**
     * Returns the value of field an_email
     *
     * @return string
     */
    public function getAnEmail()
    {
        return $this->an_email;
    }

    /**
     * Returns the value of field an_mobile
     *
     * @return string
     */
    public function getAnMobile()
    {
        return $this->an_mobile;
    }

    /**
     * Returns the value of field an_type
     *
     * @return integer
     */
    public function getAnType()
    {
        return $this->an_type;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'arrival_notice';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ArrivalNotice[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ArrivalNotice
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
