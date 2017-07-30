<?php

namespace Ypk\Models;

class StoreMsgSetting extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $sms_message_switch;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $sms_short_switch;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $sms_mail_switch;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=true)
     */
    protected $sms_short_number;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $sms_mail_number;

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
     * Method to set the value of field sms_message_switch
     *
     * @param integer $sms_message_switch
     * @return $this
     */
    public function setSmsMessageSwitch($sms_message_switch)
    {
        $this->sms_message_switch = $sms_message_switch;

        return $this;
    }

    /**
     * Method to set the value of field sms_short_switch
     *
     * @param integer $sms_short_switch
     * @return $this
     */
    public function setSmsShortSwitch($sms_short_switch)
    {
        $this->sms_short_switch = $sms_short_switch;

        return $this;
    }

    /**
     * Method to set the value of field sms_mail_switch
     *
     * @param integer $sms_mail_switch
     * @return $this
     */
    public function setSmsMailSwitch($sms_mail_switch)
    {
        $this->sms_mail_switch = $sms_mail_switch;

        return $this;
    }

    /**
     * Method to set the value of field sms_short_number
     *
     * @param string $sms_short_number
     * @return $this
     */
    public function setSmsShortNumber($sms_short_number)
    {
        $this->sms_short_number = $sms_short_number;

        return $this;
    }

    /**
     * Method to set the value of field sms_mail_number
     *
     * @param string $sms_mail_number
     * @return $this
     */
    public function setSmsMailNumber($sms_mail_number)
    {
        $this->sms_mail_number = $sms_mail_number;

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
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field sms_message_switch
     *
     * @return integer
     */
    public function getSmsMessageSwitch()
    {
        return $this->sms_message_switch;
    }

    /**
     * Returns the value of field sms_short_switch
     *
     * @return integer
     */
    public function getSmsShortSwitch()
    {
        return $this->sms_short_switch;
    }

    /**
     * Returns the value of field sms_mail_switch
     *
     * @return integer
     */
    public function getSmsMailSwitch()
    {
        return $this->sms_mail_switch;
    }

    /**
     * Returns the value of field sms_short_number
     *
     * @return string
     */
    public function getSmsShortNumber()
    {
        return $this->sms_short_number;
    }

    /**
     * Returns the value of field sms_mail_number
     *
     * @return string
     */
    public function getSmsMailNumber()
    {
        return $this->sms_mail_number;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_msg_setting';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMsgSetting[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMsgSetting
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
