<?php

namespace Ypk\Models;

class MemberChatCard extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $order_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $doctor_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $is_use;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $how_lang_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $card_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $chat_card_start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $chat_card_end_time;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $exchange_code;

    /**
     * @return int
     */
    public function getChatCardStartTime()
    {
        return $this->chat_card_start_time;
    }

    /**
     * @param int $chat_card_start_time
     */
    public function setChatCardStartTime($chat_card_start_time)
    {
        $this->chat_card_start_time = $chat_card_start_time;
    }

    /**
     * @return int
     */
    public function getChatCardEndTime()
    {
        return $this->chat_card_end_time;
    }

    /**
     * @param int $chat_card_end_time
     */
    public function setChatCardEndTime($chat_card_end_time)
    {
        $this->chat_card_end_time = $chat_card_end_time;
    }

    /**
     * @return string
     */
    public function getExchangeCode()
    {
        return $this->exchange_code;
    }

    /**
     * @param string $exchange_code
     */
    public function setExchangeCode($exchange_code)
    {
        $this->exchange_code = $exchange_code;
    }


    /**
     * @return int
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param int $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return int
     */
    public function getCardType()
    {
        return $this->card_type;
    }

    /**
     * @param int $card_type
     */
    public function setCardType($card_type)
    {
        $this->card_type = $card_type;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * Method to set the value of field doctor_id
     *
     * @param integer $doctor_id
     * @return $this
     */
    public function setDoctorId($doctor_id)
    {
        $this->doctor_id = $doctor_id;

        return $this;
    }

    /**
     * Method to set the value of field is_use
     *
     * @param integer $is_use
     * @return $this
     */
    public function setIsUse($is_use)
    {
        $this->is_use = $is_use;

        return $this;
    }

    /**
     * Method to set the value of field how_lang_time
     *
     * @param integer $how_lang_time
     * @return $this
     */
    public function setHowLangTime($how_lang_time)
    {
        $this->how_lang_time = $how_lang_time;

        return $this;
    }

    /**
     * Method to set the value of field add_time
     *
     * @param integer $add_time
     * @return $this
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Returns the value of field order_id
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Returns the value of field doctor_id
     *
     * @return integer
     */
    public function getDoctorId()
    {
        return $this->doctor_id;
    }

    /**
     * Returns the value of field is_use
     *
     * @return integer
     */
    public function getIsUse()
    {
        return $this->is_use;
    }

    /**
     * Returns the value of field how_lang_time
     *
     * @return integer
     */
    public function getHowLangTime()
    {
        return $this->how_lang_time;
    }

    /**
     * Returns the value of field add_time
     *
     * @return integer
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_chat_card';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberChatCard[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberChatCard
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
