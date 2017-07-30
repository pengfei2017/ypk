<?php

namespace Ypk\Models;

class MbUserToken extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $token_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $token;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $openid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $login_time;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $client_type;

    /**
     * Method to set the value of field token_id
     *
     * @param integer $token_id
     * @return $this
     */
    public function setTokenId($token_id)
    {
        $this->token_id = $token_id;

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
     * Method to set the value of field token
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Method to set the value of field openid
     *
     * @param string $openid
     * @return $this
     */
    public function setOpenid($openid)
    {
        $this->openid = $openid;

        return $this;
    }

    /**
     * Method to set the value of field login_time
     *
     * @param integer $login_time
     * @return $this
     */
    public function setLoginTime($login_time)
    {
        $this->login_time = $login_time;

        return $this;
    }

    /**
     * Method to set the value of field client_type
     *
     * @param string $client_type
     * @return $this
     */
    public function setClientType($client_type)
    {
        $this->client_type = $client_type;

        return $this;
    }

    /**
     * Returns the value of field token_id
     *
     * @return integer
     */
    public function getTokenId()
    {
        return $this->token_id;
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
     * Returns the value of field token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Returns the value of field openid
     *
     * @return string
     */
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     * Returns the value of field login_time
     *
     * @return integer
     */
    public function getLoginTime()
    {
        return $this->login_time;
    }

    /**
     * Returns the value of field client_type
     *
     * @return string
     */
    public function getClientType()
    {
        return $this->client_type;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mb_user_token';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbUserToken[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbUserToken
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
