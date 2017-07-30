<?php

namespace Ypk\Models;

class Consult extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $consult_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $goods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $goods_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $member_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ct_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $consult_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $consult_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $consult_reply;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $consult_reply_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $isanonymous;

    /**
     * Method to set the value of field consult_id
     *
     * @param integer $consult_id
     * @return $this
     */
    public function setConsultId($consult_id)
    {
        $this->consult_id = $consult_id;

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
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

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
     * Method to set the value of field store_name
     *
     * @param string $store_name
     * @return $this
     */
    public function setStoreName($store_name)
    {
        $this->store_name = $store_name;

        return $this;
    }

    /**
     * Method to set the value of field ct_id
     *
     * @param integer $ct_id
     * @return $this
     */
    public function setCtId($ct_id)
    {
        $this->ct_id = $ct_id;

        return $this;
    }

    /**
     * Method to set the value of field consult_content
     *
     * @param string $consult_content
     * @return $this
     */
    public function setConsultContent($consult_content)
    {
        $this->consult_content = $consult_content;

        return $this;
    }

    /**
     * Method to set the value of field consult_addtime
     *
     * @param integer $consult_addtime
     * @return $this
     */
    public function setConsultAddtime($consult_addtime)
    {
        $this->consult_addtime = $consult_addtime;

        return $this;
    }

    /**
     * Method to set the value of field consult_reply
     *
     * @param string $consult_reply
     * @return $this
     */
    public function setConsultReply($consult_reply)
    {
        $this->consult_reply = $consult_reply;

        return $this;
    }

    /**
     * Method to set the value of field consult_reply_time
     *
     * @param integer $consult_reply_time
     * @return $this
     */
    public function setConsultReplyTime($consult_reply_time)
    {
        $this->consult_reply_time = $consult_reply_time;

        return $this;
    }

    /**
     * Method to set the value of field isanonymous
     *
     * @param integer $isanonymous
     * @return $this
     */
    public function setIsanonymous($isanonymous)
    {
        $this->isanonymous = $isanonymous;

        return $this;
    }

    /**
     * Returns the value of field consult_id
     *
     * @return integer
     */
    public function getConsultId()
    {
        return $this->consult_id;
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
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
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
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field ct_id
     *
     * @return integer
     */
    public function getCtId()
    {
        return $this->ct_id;
    }

    /**
     * Returns the value of field consult_content
     *
     * @return string
     */
    public function getConsultContent()
    {
        return $this->consult_content;
    }

    /**
     * Returns the value of field consult_addtime
     *
     * @return integer
     */
    public function getConsultAddtime()
    {
        return $this->consult_addtime;
    }

    /**
     * Returns the value of field consult_reply
     *
     * @return string
     */
    public function getConsultReply()
    {
        return $this->consult_reply;
    }

    /**
     * Returns the value of field consult_reply_time
     *
     * @return integer
     */
    public function getConsultReplyTime()
    {
        return $this->consult_reply_time;
    }

    /**
     * Returns the value of field isanonymous
     *
     * @return integer
     */
    public function getIsanonymous()
    {
        return $this->isanonymous;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'consult';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Consult[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Consult
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
