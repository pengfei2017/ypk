<?php

namespace Ypk\Models;

class SmsLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $log_id;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=false)
     */
    protected $log_phone;

    /**
     *
     * @var string
     * @Column(type="string", length=6, nullable=false)
     */
    protected $log_captcha;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    protected $log_ip;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=false)
     */
    protected $log_msg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $log_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $add_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $member_name;

    /**
     * Method to set the value of field log_id
     *
     * @param integer $log_id
     * @return $this
     */
    public function setLogId($log_id)
    {
        $this->log_id = $log_id;

        return $this;
    }

    /**
     * Method to set the value of field log_phone
     *
     * @param string $log_phone
     * @return $this
     */
    public function setLogPhone($log_phone)
    {
        $this->log_phone = $log_phone;

        return $this;
    }

    /**
     * Method to set the value of field log_captcha
     *
     * @param string $log_captcha
     * @return $this
     */
    public function setLogCaptcha($log_captcha)
    {
        $this->log_captcha = $log_captcha;

        return $this;
    }

    /**
     * Method to set the value of field log_ip
     *
     * @param string $log_ip
     * @return $this
     */
    public function setLogIp($log_ip)
    {
        $this->log_ip = $log_ip;

        return $this;
    }

    /**
     * Method to set the value of field log_msg
     *
     * @param string $log_msg
     * @return $this
     */
    public function setLogMsg($log_msg)
    {
        $this->log_msg = $log_msg;

        return $this;
    }

    /**
     * Method to set the value of field log_type
     *
     * @param integer $log_type
     * @return $this
     */
    public function setLogType($log_type)
    {
        $this->log_type = $log_type;

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
     * Returns the value of field log_id
     *
     * @return integer
     */
    public function getLogId()
    {
        return $this->log_id;
    }

    /**
     * Returns the value of field log_phone
     *
     * @return string
     */
    public function getLogPhone()
    {
        return $this->log_phone;
    }

    /**
     * Returns the value of field log_captcha
     *
     * @return string
     */
    public function getLogCaptcha()
    {
        return $this->log_captcha;
    }

    /**
     * Returns the value of field log_ip
     *
     * @return string
     */
    public function getLogIp()
    {
        return $this->log_ip;
    }

    /**
     * Returns the value of field log_msg
     *
     * @return string
     */
    public function getLogMsg()
    {
        return $this->log_msg;
    }

    /**
     * Returns the value of field log_type
     *
     * @return integer
     */
    public function getLogType()
    {
        return $this->log_type;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sms_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SmsLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SmsLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
