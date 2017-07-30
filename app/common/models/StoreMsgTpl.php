<?php

namespace Ypk\Models;

class StoreMsgTpl extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=100, nullable=false)
     */
    protected $smt_code;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $smt_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $smt_message_switch;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $smt_message_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $smt_message_forced;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $smt_short_switch;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $smt_short_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $smt_short_forced;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $smt_mail_switch;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $smt_mail_subject;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $smt_mail_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $smt_mail_forced;

    /**
     * Method to set the value of field smt_code
     *
     * @param string $smt_code
     * @return $this
     */
    public function setSmtCode($smt_code)
    {
        $this->smt_code = $smt_code;

        return $this;
    }

    /**
     * Method to set the value of field smt_name
     *
     * @param string $smt_name
     * @return $this
     */
    public function setSmtName($smt_name)
    {
        $this->smt_name = $smt_name;

        return $this;
    }

    /**
     * Method to set the value of field smt_message_switch
     *
     * @param integer $smt_message_switch
     * @return $this
     */
    public function setSmtMessageSwitch($smt_message_switch)
    {
        $this->smt_message_switch = $smt_message_switch;

        return $this;
    }

    /**
     * Method to set the value of field smt_message_content
     *
     * @param string $smt_message_content
     * @return $this
     */
    public function setSmtMessageContent($smt_message_content)
    {
        $this->smt_message_content = $smt_message_content;

        return $this;
    }

    /**
     * Method to set the value of field smt_message_forced
     *
     * @param integer $smt_message_forced
     * @return $this
     */
    public function setSmtMessageForced($smt_message_forced)
    {
        $this->smt_message_forced = $smt_message_forced;

        return $this;
    }

    /**
     * Method to set the value of field smt_short_switch
     *
     * @param integer $smt_short_switch
     * @return $this
     */
    public function setSmtShortSwitch($smt_short_switch)
    {
        $this->smt_short_switch = $smt_short_switch;

        return $this;
    }

    /**
     * Method to set the value of field smt_short_content
     *
     * @param string $smt_short_content
     * @return $this
     */
    public function setSmtShortContent($smt_short_content)
    {
        $this->smt_short_content = $smt_short_content;

        return $this;
    }

    /**
     * Method to set the value of field smt_short_forced
     *
     * @param integer $smt_short_forced
     * @return $this
     */
    public function setSmtShortForced($smt_short_forced)
    {
        $this->smt_short_forced = $smt_short_forced;

        return $this;
    }

    /**
     * Method to set the value of field smt_mail_switch
     *
     * @param integer $smt_mail_switch
     * @return $this
     */
    public function setSmtMailSwitch($smt_mail_switch)
    {
        $this->smt_mail_switch = $smt_mail_switch;

        return $this;
    }

    /**
     * Method to set the value of field smt_mail_subject
     *
     * @param string $smt_mail_subject
     * @return $this
     */
    public function setSmtMailSubject($smt_mail_subject)
    {
        $this->smt_mail_subject = $smt_mail_subject;

        return $this;
    }

    /**
     * Method to set the value of field smt_mail_content
     *
     * @param string $smt_mail_content
     * @return $this
     */
    public function setSmtMailContent($smt_mail_content)
    {
        $this->smt_mail_content = $smt_mail_content;

        return $this;
    }

    /**
     * Method to set the value of field smt_mail_forced
     *
     * @param integer $smt_mail_forced
     * @return $this
     */
    public function setSmtMailForced($smt_mail_forced)
    {
        $this->smt_mail_forced = $smt_mail_forced;

        return $this;
    }

    /**
     * Returns the value of field smt_code
     *
     * @return string
     */
    public function getSmtCode()
    {
        return $this->smt_code;
    }

    /**
     * Returns the value of field smt_name
     *
     * @return string
     */
    public function getSmtName()
    {
        return $this->smt_name;
    }

    /**
     * Returns the value of field smt_message_switch
     *
     * @return integer
     */
    public function getSmtMessageSwitch()
    {
        return $this->smt_message_switch;
    }

    /**
     * Returns the value of field smt_message_content
     *
     * @return string
     */
    public function getSmtMessageContent()
    {
        return $this->smt_message_content;
    }

    /**
     * Returns the value of field smt_message_forced
     *
     * @return integer
     */
    public function getSmtMessageForced()
    {
        return $this->smt_message_forced;
    }

    /**
     * Returns the value of field smt_short_switch
     *
     * @return integer
     */
    public function getSmtShortSwitch()
    {
        return $this->smt_short_switch;
    }

    /**
     * Returns the value of field smt_short_content
     *
     * @return string
     */
    public function getSmtShortContent()
    {
        return $this->smt_short_content;
    }

    /**
     * Returns the value of field smt_short_forced
     *
     * @return integer
     */
    public function getSmtShortForced()
    {
        return $this->smt_short_forced;
    }

    /**
     * Returns the value of field smt_mail_switch
     *
     * @return integer
     */
    public function getSmtMailSwitch()
    {
        return $this->smt_mail_switch;
    }

    /**
     * Returns the value of field smt_mail_subject
     *
     * @return string
     */
    public function getSmtMailSubject()
    {
        return $this->smt_mail_subject;
    }

    /**
     * Returns the value of field smt_mail_content
     *
     * @return string
     */
    public function getSmtMailContent()
    {
        return $this->smt_mail_content;
    }

    /**
     * Returns the value of field smt_mail_forced
     *
     * @return integer
     */
    public function getSmtMailForced()
    {
        return $this->smt_mail_forced;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_msg_tpl';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMsgTpl[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMsgTpl
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
