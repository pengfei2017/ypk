<?php

namespace Ypk\Models;

class MemberCommon extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=6, nullable=true)
     */
    protected $auth_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $send_acode_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $send_mb_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $send_email_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $send_mb_times;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $send_acode_times;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $auth_code_check_times;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $auth_modify_pwd_time;

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
     * Method to set the value of field auth_code
     *
     * @param string $auth_code
     * @return $this
     */
    public function setAuthCode($auth_code)
    {
        $this->auth_code = $auth_code;

        return $this;
    }

    /**
     * Method to set the value of field send_acode_time
     *
     * @param integer $send_acode_time
     * @return $this
     */
    public function setSendAcodeTime($send_acode_time)
    {
        $this->send_acode_time = $send_acode_time;

        return $this;
    }

    /**
     * Method to set the value of field send_mb_time
     *
     * @param integer $send_mb_time
     * @return $this
     */
    public function setSendMbTime($send_mb_time)
    {
        $this->send_mb_time = $send_mb_time;

        return $this;
    }

    /**
     * Method to set the value of field send_email_time
     *
     * @param integer $send_email_time
     * @return $this
     */
    public function setSendEmailTime($send_email_time)
    {
        $this->send_email_time = $send_email_time;

        return $this;
    }

    /**
     * Method to set the value of field send_mb_times
     *
     * @param integer $send_mb_times
     * @return $this
     */
    public function setSendMbTimes($send_mb_times)
    {
        $this->send_mb_times = $send_mb_times;

        return $this;
    }

    /**
     * Method to set the value of field send_acode_times
     *
     * @param integer $send_acode_times
     * @return $this
     */
    public function setSendAcodeTimes($send_acode_times)
    {
        $this->send_acode_times = $send_acode_times;

        return $this;
    }

    /**
     * Method to set the value of field auth_code_check_times
     *
     * @param integer $auth_code_check_times
     * @return $this
     */
    public function setAuthCodeCheckTimes($auth_code_check_times)
    {
        $this->auth_code_check_times = $auth_code_check_times;

        return $this;
    }

    /**
     * Method to set the value of field auth_modify_pwd_time
     *
     * @param integer $auth_modify_pwd_time
     * @return $this
     */
    public function setAuthModifyPwdTime($auth_modify_pwd_time)
    {
        $this->auth_modify_pwd_time = $auth_modify_pwd_time;

        return $this;
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
     * Returns the value of field auth_code
     *
     * @return string
     */
    public function getAuthCode()
    {
        return $this->auth_code;
    }

    /**
     * Returns the value of field send_acode_time
     *
     * @return integer
     */
    public function getSendAcodeTime()
    {
        return $this->send_acode_time;
    }

    /**
     * Returns the value of field send_mb_time
     *
     * @return integer
     */
    public function getSendMbTime()
    {
        return $this->send_mb_time;
    }

    /**
     * Returns the value of field send_email_time
     *
     * @return integer
     */
    public function getSendEmailTime()
    {
        return $this->send_email_time;
    }

    /**
     * Returns the value of field send_mb_times
     *
     * @return integer
     */
    public function getSendMbTimes()
    {
        return $this->send_mb_times;
    }

    /**
     * Returns the value of field send_acode_times
     *
     * @return integer
     */
    public function getSendAcodeTimes()
    {
        return $this->send_acode_times;
    }

    /**
     * Returns the value of field auth_code_check_times
     *
     * @return integer
     */
    public function getAuthCodeCheckTimes()
    {
        return $this->auth_code_check_times;
    }

    /**
     * Returns the value of field auth_modify_pwd_time
     *
     * @return integer
     */
    public function getAuthModifyPwdTime()
    {
        return $this->auth_modify_pwd_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_common';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberCommon[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberCommon
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
