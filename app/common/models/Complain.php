<?php

namespace Ypk\Models;

class Complain extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $complain_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $order_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $order_goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $accuser_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $accuser_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $accused_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $accused_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $complain_subject_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $complain_subject_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $complain_content;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $complain_pic1;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $complain_pic2;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $complain_pic3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $complain_datetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $complain_handle_datetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $complain_handle_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $appeal_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $appeal_datetime;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $appeal_pic1;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $appeal_pic2;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $appeal_pic3;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $final_handle_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $final_handle_datetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $final_handle_member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $complain_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $complain_active;

    /**
     * Method to set the value of field complain_id
     *
     * @param integer $complain_id
     * @return $this
     */
    public function setComplainId($complain_id)
    {
        $this->complain_id = $complain_id;

        return $this;
    }

    /**
     * Method to set the value of field order_id
     *
     * @param integer $order_id
     * @return $this
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }

    /**
     * Method to set the value of field order_goods_id
     *
     * @param integer $order_goods_id
     * @return $this
     */
    public function setOrderGoodsId($order_goods_id)
    {
        $this->order_goods_id = $order_goods_id;

        return $this;
    }

    /**
     * Method to set the value of field accuser_id
     *
     * @param integer $accuser_id
     * @return $this
     */
    public function setAccuserId($accuser_id)
    {
        $this->accuser_id = $accuser_id;

        return $this;
    }

    /**
     * Method to set the value of field accuser_name
     *
     * @param string $accuser_name
     * @return $this
     */
    public function setAccuserName($accuser_name)
    {
        $this->accuser_name = $accuser_name;

        return $this;
    }

    /**
     * Method to set the value of field accused_id
     *
     * @param integer $accused_id
     * @return $this
     */
    public function setAccusedId($accused_id)
    {
        $this->accused_id = $accused_id;

        return $this;
    }

    /**
     * Method to set the value of field accused_name
     *
     * @param string $accused_name
     * @return $this
     */
    public function setAccusedName($accused_name)
    {
        $this->accused_name = $accused_name;

        return $this;
    }

    /**
     * Method to set the value of field complain_subject_content
     *
     * @param string $complain_subject_content
     * @return $this
     */
    public function setComplainSubjectContent($complain_subject_content)
    {
        $this->complain_subject_content = $complain_subject_content;

        return $this;
    }

    /**
     * Method to set the value of field complain_subject_id
     *
     * @param integer $complain_subject_id
     * @return $this
     */
    public function setComplainSubjectId($complain_subject_id)
    {
        $this->complain_subject_id = $complain_subject_id;

        return $this;
    }

    /**
     * Method to set the value of field complain_content
     *
     * @param string $complain_content
     * @return $this
     */
    public function setComplainContent($complain_content)
    {
        $this->complain_content = $complain_content;

        return $this;
    }

    /**
     * Method to set the value of field complain_pic1
     *
     * @param string $complain_pic1
     * @return $this
     */
    public function setComplainPic1($complain_pic1)
    {
        $this->complain_pic1 = $complain_pic1;

        return $this;
    }

    /**
     * Method to set the value of field complain_pic2
     *
     * @param string $complain_pic2
     * @return $this
     */
    public function setComplainPic2($complain_pic2)
    {
        $this->complain_pic2 = $complain_pic2;

        return $this;
    }

    /**
     * Method to set the value of field complain_pic3
     *
     * @param string $complain_pic3
     * @return $this
     */
    public function setComplainPic3($complain_pic3)
    {
        $this->complain_pic3 = $complain_pic3;

        return $this;
    }

    /**
     * Method to set the value of field complain_datetime
     *
     * @param integer $complain_datetime
     * @return $this
     */
    public function setComplainDatetime($complain_datetime)
    {
        $this->complain_datetime = $complain_datetime;

        return $this;
    }

    /**
     * Method to set the value of field complain_handle_datetime
     *
     * @param integer $complain_handle_datetime
     * @return $this
     */
    public function setComplainHandleDatetime($complain_handle_datetime)
    {
        $this->complain_handle_datetime = $complain_handle_datetime;

        return $this;
    }

    /**
     * Method to set the value of field complain_handle_member_id
     *
     * @param integer $complain_handle_member_id
     * @return $this
     */
    public function setComplainHandleMemberId($complain_handle_member_id)
    {
        $this->complain_handle_member_id = $complain_handle_member_id;

        return $this;
    }

    /**
     * Method to set the value of field appeal_message
     *
     * @param string $appeal_message
     * @return $this
     */
    public function setAppealMessage($appeal_message)
    {
        $this->appeal_message = $appeal_message;

        return $this;
    }

    /**
     * Method to set the value of field appeal_datetime
     *
     * @param integer $appeal_datetime
     * @return $this
     */
    public function setAppealDatetime($appeal_datetime)
    {
        $this->appeal_datetime = $appeal_datetime;

        return $this;
    }

    /**
     * Method to set the value of field appeal_pic1
     *
     * @param string $appeal_pic1
     * @return $this
     */
    public function setAppealPic1($appeal_pic1)
    {
        $this->appeal_pic1 = $appeal_pic1;

        return $this;
    }

    /**
     * Method to set the value of field appeal_pic2
     *
     * @param string $appeal_pic2
     * @return $this
     */
    public function setAppealPic2($appeal_pic2)
    {
        $this->appeal_pic2 = $appeal_pic2;

        return $this;
    }

    /**
     * Method to set the value of field appeal_pic3
     *
     * @param string $appeal_pic3
     * @return $this
     */
    public function setAppealPic3($appeal_pic3)
    {
        $this->appeal_pic3 = $appeal_pic3;

        return $this;
    }

    /**
     * Method to set the value of field final_handle_message
     *
     * @param string $final_handle_message
     * @return $this
     */
    public function setFinalHandleMessage($final_handle_message)
    {
        $this->final_handle_message = $final_handle_message;

        return $this;
    }

    /**
     * Method to set the value of field final_handle_datetime
     *
     * @param integer $final_handle_datetime
     * @return $this
     */
    public function setFinalHandleDatetime($final_handle_datetime)
    {
        $this->final_handle_datetime = $final_handle_datetime;

        return $this;
    }

    /**
     * Method to set the value of field final_handle_member_id
     *
     * @param integer $final_handle_member_id
     * @return $this
     */
    public function setFinalHandleMemberId($final_handle_member_id)
    {
        $this->final_handle_member_id = $final_handle_member_id;

        return $this;
    }

    /**
     * Method to set the value of field complain_state
     *
     * @param integer $complain_state
     * @return $this
     */
    public function setComplainState($complain_state)
    {
        $this->complain_state = $complain_state;

        return $this;
    }

    /**
     * Method to set the value of field complain_active
     *
     * @param integer $complain_active
     * @return $this
     */
    public function setComplainActive($complain_active)
    {
        $this->complain_active = $complain_active;

        return $this;
    }

    /**
     * Returns the value of field complain_id
     *
     * @return integer
     */
    public function getComplainId()
    {
        return $this->complain_id;
    }

    /**
     * Returns the value of field order_id
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Returns the value of field order_goods_id
     *
     * @return integer
     */
    public function getOrderGoodsId()
    {
        return $this->order_goods_id;
    }

    /**
     * Returns the value of field accuser_id
     *
     * @return integer
     */
    public function getAccuserId()
    {
        return $this->accuser_id;
    }

    /**
     * Returns the value of field accuser_name
     *
     * @return string
     */
    public function getAccuserName()
    {
        return $this->accuser_name;
    }

    /**
     * Returns the value of field accused_id
     *
     * @return integer
     */
    public function getAccusedId()
    {
        return $this->accused_id;
    }

    /**
     * Returns the value of field accused_name
     *
     * @return string
     */
    public function getAccusedName()
    {
        return $this->accused_name;
    }

    /**
     * Returns the value of field complain_subject_content
     *
     * @return string
     */
    public function getComplainSubjectContent()
    {
        return $this->complain_subject_content;
    }

    /**
     * Returns the value of field complain_subject_id
     *
     * @return integer
     */
    public function getComplainSubjectId()
    {
        return $this->complain_subject_id;
    }

    /**
     * Returns the value of field complain_content
     *
     * @return string
     */
    public function getComplainContent()
    {
        return $this->complain_content;
    }

    /**
     * Returns the value of field complain_pic1
     *
     * @return string
     */
    public function getComplainPic1()
    {
        return $this->complain_pic1;
    }

    /**
     * Returns the value of field complain_pic2
     *
     * @return string
     */
    public function getComplainPic2()
    {
        return $this->complain_pic2;
    }

    /**
     * Returns the value of field complain_pic3
     *
     * @return string
     */
    public function getComplainPic3()
    {
        return $this->complain_pic3;
    }

    /**
     * Returns the value of field complain_datetime
     *
     * @return integer
     */
    public function getComplainDatetime()
    {
        return $this->complain_datetime;
    }

    /**
     * Returns the value of field complain_handle_datetime
     *
     * @return integer
     */
    public function getComplainHandleDatetime()
    {
        return $this->complain_handle_datetime;
    }

    /**
     * Returns the value of field complain_handle_member_id
     *
     * @return integer
     */
    public function getComplainHandleMemberId()
    {
        return $this->complain_handle_member_id;
    }

    /**
     * Returns the value of field appeal_message
     *
     * @return string
     */
    public function getAppealMessage()
    {
        return $this->appeal_message;
    }

    /**
     * Returns the value of field appeal_datetime
     *
     * @return integer
     */
    public function getAppealDatetime()
    {
        return $this->appeal_datetime;
    }

    /**
     * Returns the value of field appeal_pic1
     *
     * @return string
     */
    public function getAppealPic1()
    {
        return $this->appeal_pic1;
    }

    /**
     * Returns the value of field appeal_pic2
     *
     * @return string
     */
    public function getAppealPic2()
    {
        return $this->appeal_pic2;
    }

    /**
     * Returns the value of field appeal_pic3
     *
     * @return string
     */
    public function getAppealPic3()
    {
        return $this->appeal_pic3;
    }

    /**
     * Returns the value of field final_handle_message
     *
     * @return string
     */
    public function getFinalHandleMessage()
    {
        return $this->final_handle_message;
    }

    /**
     * Returns the value of field final_handle_datetime
     *
     * @return integer
     */
    public function getFinalHandleDatetime()
    {
        return $this->final_handle_datetime;
    }

    /**
     * Returns the value of field final_handle_member_id
     *
     * @return integer
     */
    public function getFinalHandleMemberId()
    {
        return $this->final_handle_member_id;
    }

    /**
     * Returns the value of field complain_state
     *
     * @return integer
     */
    public function getComplainState()
    {
        return $this->complain_state;
    }

    /**
     * Returns the value of field complain_active
     *
     * @return integer
     */
    public function getComplainActive()
    {
        return $this->complain_active;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'complain';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Complain[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Complain
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
