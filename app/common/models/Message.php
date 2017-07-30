<?php

namespace Ypk\Models;

class Message extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $message_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $message_parent_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $from_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=false)
     */
    protected $to_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $message_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $message_body;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $message_time;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $message_update_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $message_open;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $message_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $message_type;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=true)
     */
    protected $read_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=true)
     */
    protected $del_member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $message_ismore;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $from_member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $to_member_name;

    /**
     * Method to set the value of field message_id
     *
     * @param integer $message_id
     * @return $this
     */
    public function setMessageId($message_id)
    {
        $this->message_id = $message_id;

        return $this;
    }

    /**
     * Method to set the value of field message_parent_id
     *
     * @param integer $message_parent_id
     * @return $this
     */
    public function setMessageParentId($message_parent_id)
    {
        $this->message_parent_id = $message_parent_id;

        return $this;
    }

    /**
     * Method to set the value of field from_member_id
     *
     * @param integer $from_member_id
     * @return $this
     */
    public function setFromMemberId($from_member_id)
    {
        $this->from_member_id = $from_member_id;

        return $this;
    }

    /**
     * Method to set the value of field to_member_id
     *
     * @param string $to_member_id
     * @return $this
     */
    public function setToMemberId($to_member_id)
    {
        $this->to_member_id = $to_member_id;

        return $this;
    }

    /**
     * Method to set the value of field message_title
     *
     * @param string $message_title
     * @return $this
     */
    public function setMessageTitle($message_title)
    {
        $this->message_title = $message_title;

        return $this;
    }

    /**
     * Method to set the value of field message_body
     *
     * @param string $message_body
     * @return $this
     */
    public function setMessageBody($message_body)
    {
        $this->message_body = $message_body;

        return $this;
    }

    /**
     * Method to set the value of field message_time
     *
     * @param string $message_time
     * @return $this
     */
    public function setMessageTime($message_time)
    {
        $this->message_time = $message_time;

        return $this;
    }

    /**
     * Method to set the value of field message_update_time
     *
     * @param string $message_update_time
     * @return $this
     */
    public function setMessageUpdateTime($message_update_time)
    {
        $this->message_update_time = $message_update_time;

        return $this;
    }

    /**
     * Method to set the value of field message_open
     *
     * @param integer $message_open
     * @return $this
     */
    public function setMessageOpen($message_open)
    {
        $this->message_open = $message_open;

        return $this;
    }

    /**
     * Method to set the value of field message_state
     *
     * @param integer $message_state
     * @return $this
     */
    public function setMessageState($message_state)
    {
        $this->message_state = $message_state;

        return $this;
    }

    /**
     * Method to set the value of field message_type
     *
     * @param integer $message_type
     * @return $this
     */
    public function setMessageType($message_type)
    {
        $this->message_type = $message_type;

        return $this;
    }

    /**
     * Method to set the value of field read_member_id
     *
     * @param string $read_member_id
     * @return $this
     */
    public function setReadMemberId($read_member_id)
    {
        $this->read_member_id = $read_member_id;

        return $this;
    }

    /**
     * Method to set the value of field del_member_id
     *
     * @param string $del_member_id
     * @return $this
     */
    public function setDelMemberId($del_member_id)
    {
        $this->del_member_id = $del_member_id;

        return $this;
    }

    /**
     * Method to set the value of field message_ismore
     *
     * @param integer $message_ismore
     * @return $this
     */
    public function setMessageIsmore($message_ismore)
    {
        $this->message_ismore = $message_ismore;

        return $this;
    }

    /**
     * Method to set the value of field from_member_name
     *
     * @param string $from_member_name
     * @return $this
     */
    public function setFromMemberName($from_member_name)
    {
        $this->from_member_name = $from_member_name;

        return $this;
    }

    /**
     * Method to set the value of field to_member_name
     *
     * @param string $to_member_name
     * @return $this
     */
    public function setToMemberName($to_member_name)
    {
        $this->to_member_name = $to_member_name;

        return $this;
    }

    /**
     * Returns the value of field message_id
     *
     * @return integer
     */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * Returns the value of field message_parent_id
     *
     * @return integer
     */
    public function getMessageParentId()
    {
        return $this->message_parent_id;
    }

    /**
     * Returns the value of field from_member_id
     *
     * @return integer
     */
    public function getFromMemberId()
    {
        return $this->from_member_id;
    }

    /**
     * Returns the value of field to_member_id
     *
     * @return string
     */
    public function getToMemberId()
    {
        return $this->to_member_id;
    }

    /**
     * Returns the value of field message_title
     *
     * @return string
     */
    public function getMessageTitle()
    {
        return $this->message_title;
    }

    /**
     * Returns the value of field message_body
     *
     * @return string
     */
    public function getMessageBody()
    {
        return $this->message_body;
    }

    /**
     * Returns the value of field message_time
     *
     * @return string
     */
    public function getMessageTime()
    {
        return $this->message_time;
    }

    /**
     * Returns the value of field message_update_time
     *
     * @return string
     */
    public function getMessageUpdateTime()
    {
        return $this->message_update_time;
    }

    /**
     * Returns the value of field message_open
     *
     * @return integer
     */
    public function getMessageOpen()
    {
        return $this->message_open;
    }

    /**
     * Returns the value of field message_state
     *
     * @return integer
     */
    public function getMessageState()
    {
        return $this->message_state;
    }

    /**
     * Returns the value of field message_type
     *
     * @return integer
     */
    public function getMessageType()
    {
        return $this->message_type;
    }

    /**
     * Returns the value of field read_member_id
     *
     * @return string
     */
    public function getReadMemberId()
    {
        return $this->read_member_id;
    }

    /**
     * Returns the value of field del_member_id
     *
     * @return string
     */
    public function getDelMemberId()
    {
        return $this->del_member_id;
    }

    /**
     * Returns the value of field message_ismore
     *
     * @return integer
     */
    public function getMessageIsmore()
    {
        return $this->message_ismore;
    }

    /**
     * Returns the value of field from_member_name
     *
     * @return string
     */
    public function getFromMemberName()
    {
        return $this->from_member_name;
    }

    /**
     * Returns the value of field to_member_name
     *
     * @return string
     */
    public function getToMemberName()
    {
        return $this->to_member_name;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'message';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Message[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Message
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
