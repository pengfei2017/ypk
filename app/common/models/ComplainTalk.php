<?php

namespace Ypk\Models;

class ComplainTalk extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $talk_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $complain_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $talk_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $talk_member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $talk_member_type;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $talk_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $talk_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $talk_admin;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $talk_datetime;

    /**
     * Method to set the value of field talk_id
     *
     * @param integer $talk_id
     * @return $this
     */
    public function setTalkId($talk_id)
    {
        $this->talk_id = $talk_id;

        return $this;
    }

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
     * Method to set the value of field talk_member_id
     *
     * @param integer $talk_member_id
     * @return $this
     */
    public function setTalkMemberId($talk_member_id)
    {
        $this->talk_member_id = $talk_member_id;

        return $this;
    }

    /**
     * Method to set the value of field talk_member_name
     *
     * @param string $talk_member_name
     * @return $this
     */
    public function setTalkMemberName($talk_member_name)
    {
        $this->talk_member_name = $talk_member_name;

        return $this;
    }

    /**
     * Method to set the value of field talk_member_type
     *
     * @param string $talk_member_type
     * @return $this
     */
    public function setTalkMemberType($talk_member_type)
    {
        $this->talk_member_type = $talk_member_type;

        return $this;
    }

    /**
     * Method to set the value of field talk_content
     *
     * @param string $talk_content
     * @return $this
     */
    public function setTalkContent($talk_content)
    {
        $this->talk_content = $talk_content;

        return $this;
    }

    /**
     * Method to set the value of field talk_state
     *
     * @param integer $talk_state
     * @return $this
     */
    public function setTalkState($talk_state)
    {
        $this->talk_state = $talk_state;

        return $this;
    }

    /**
     * Method to set the value of field talk_admin
     *
     * @param integer $talk_admin
     * @return $this
     */
    public function setTalkAdmin($talk_admin)
    {
        $this->talk_admin = $talk_admin;

        return $this;
    }

    /**
     * Method to set the value of field talk_datetime
     *
     * @param integer $talk_datetime
     * @return $this
     */
    public function setTalkDatetime($talk_datetime)
    {
        $this->talk_datetime = $talk_datetime;

        return $this;
    }

    /**
     * Returns the value of field talk_id
     *
     * @return integer
     */
    public function getTalkId()
    {
        return $this->talk_id;
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
     * Returns the value of field talk_member_id
     *
     * @return integer
     */
    public function getTalkMemberId()
    {
        return $this->talk_member_id;
    }

    /**
     * Returns the value of field talk_member_name
     *
     * @return string
     */
    public function getTalkMemberName()
    {
        return $this->talk_member_name;
    }

    /**
     * Returns the value of field talk_member_type
     *
     * @return string
     */
    public function getTalkMemberType()
    {
        return $this->talk_member_type;
    }

    /**
     * Returns the value of field talk_content
     *
     * @return string
     */
    public function getTalkContent()
    {
        return $this->talk_content;
    }

    /**
     * Returns the value of field talk_state
     *
     * @return integer
     */
    public function getTalkState()
    {
        return $this->talk_state;
    }

    /**
     * Returns the value of field talk_admin
     *
     * @return integer
     */
    public function getTalkAdmin()
    {
        return $this->talk_admin;
    }

    /**
     * Returns the value of field talk_datetime
     *
     * @return integer
     */
    public function getTalkDatetime()
    {
        return $this->talk_datetime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'complain_talk';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ComplainTalk[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ComplainTalk
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
