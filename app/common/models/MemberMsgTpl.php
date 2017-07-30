<?php

namespace Ypk\Models;

class MemberMsgTpl extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=50, nullable=false)
     */
    protected $mmt_code;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $mmt_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $mmt_message_switch;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $mmt_message_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $mmt_short_switch;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $mmt_short_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $mmt_mail_switch;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $mmt_mail_subject;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $mmt_mail_content;

    /**
     * Method to set the value of field mmt_code
     *
     * @param string $mmt_code
     * @return $this
     */
    public function setMmtCode($mmt_code)
    {
        $this->mmt_code = $mmt_code;

        return $this;
    }

    /**
     * Method to set the value of field mmt_name
     *
     * @param string $mmt_name
     * @return $this
     */
    public function setMmtName($mmt_name)
    {
        $this->mmt_name = $mmt_name;

        return $this;
    }

    /**
     * Method to set the value of field mmt_message_switch
     *
     * @param integer $mmt_message_switch
     * @return $this
     */
    public function setMmtMessageSwitch($mmt_message_switch)
    {
        $this->mmt_message_switch = $mmt_message_switch;

        return $this;
    }

    /**
     * Method to set the value of field mmt_message_content
     *
     * @param string $mmt_message_content
     * @return $this
     */
    public function setMmtMessageContent($mmt_message_content)
    {
        $this->mmt_message_content = $mmt_message_content;

        return $this;
    }

    /**
     * Method to set the value of field mmt_short_switch
     *
     * @param integer $mmt_short_switch
     * @return $this
     */
    public function setMmtShortSwitch($mmt_short_switch)
    {
        $this->mmt_short_switch = $mmt_short_switch;

        return $this;
    }

    /**
     * Method to set the value of field mmt_short_content
     *
     * @param string $mmt_short_content
     * @return $this
     */
    public function setMmtShortContent($mmt_short_content)
    {
        $this->mmt_short_content = $mmt_short_content;

        return $this;
    }

    /**
     * Method to set the value of field mmt_mail_switch
     *
     * @param integer $mmt_mail_switch
     * @return $this
     */
    public function setMmtMailSwitch($mmt_mail_switch)
    {
        $this->mmt_mail_switch = $mmt_mail_switch;

        return $this;
    }

    /**
     * Method to set the value of field mmt_mail_subject
     *
     * @param string $mmt_mail_subject
     * @return $this
     */
    public function setMmtMailSubject($mmt_mail_subject)
    {
        $this->mmt_mail_subject = $mmt_mail_subject;

        return $this;
    }

    /**
     * Method to set the value of field mmt_mail_content
     *
     * @param string $mmt_mail_content
     * @return $this
     */
    public function setMmtMailContent($mmt_mail_content)
    {
        $this->mmt_mail_content = $mmt_mail_content;

        return $this;
    }

    /**
     * Returns the value of field mmt_code
     *
     * @return string
     */
    public function getMmtCode()
    {
        return $this->mmt_code;
    }

    /**
     * Returns the value of field mmt_name
     *
     * @return string
     */
    public function getMmtName()
    {
        return $this->mmt_name;
    }

    /**
     * Returns the value of field mmt_message_switch
     *
     * @return integer
     */
    public function getMmtMessageSwitch()
    {
        return $this->mmt_message_switch;
    }

    /**
     * Returns the value of field mmt_message_content
     *
     * @return string
     */
    public function getMmtMessageContent()
    {
        return $this->mmt_message_content;
    }

    /**
     * Returns the value of field mmt_short_switch
     *
     * @return integer
     */
    public function getMmtShortSwitch()
    {
        return $this->mmt_short_switch;
    }

    /**
     * Returns the value of field mmt_short_content
     *
     * @return string
     */
    public function getMmtShortContent()
    {
        return $this->mmt_short_content;
    }

    /**
     * Returns the value of field mmt_mail_switch
     *
     * @return integer
     */
    public function getMmtMailSwitch()
    {
        return $this->mmt_mail_switch;
    }

    /**
     * Returns the value of field mmt_mail_subject
     *
     * @return string
     */
    public function getMmtMailSubject()
    {
        return $this->mmt_mail_subject;
    }

    /**
     * Returns the value of field mmt_mail_content
     *
     * @return string
     */
    public function getMmtMailContent()
    {
        return $this->mmt_mail_content;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_msg_tpl';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberMsgTpl[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberMsgTpl
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
