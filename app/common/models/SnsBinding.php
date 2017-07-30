<?php

namespace Ypk\Models;

class SnsBinding extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsbind_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsbind_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $snsbind_membername;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $snsbind_appsign;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsbind_updatetime;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $snsbind_openid;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $snsbind_openinfo;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $snsbind_accesstoken;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsbind_expiresin;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $snsbind_refreshtoken;

    /**
     * Method to set the value of field snsbind_id
     *
     * @param integer $snsbind_id
     * @return $this
     */
    public function setSnsbindId($snsbind_id)
    {
        $this->snsbind_id = $snsbind_id;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_memberid
     *
     * @param integer $snsbind_memberid
     * @return $this
     */
    public function setSnsbindMemberid($snsbind_memberid)
    {
        $this->snsbind_memberid = $snsbind_memberid;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_membername
     *
     * @param string $snsbind_membername
     * @return $this
     */
    public function setSnsbindMembername($snsbind_membername)
    {
        $this->snsbind_membername = $snsbind_membername;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_appsign
     *
     * @param string $snsbind_appsign
     * @return $this
     */
    public function setSnsbindAppsign($snsbind_appsign)
    {
        $this->snsbind_appsign = $snsbind_appsign;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_updatetime
     *
     * @param integer $snsbind_updatetime
     * @return $this
     */
    public function setSnsbindUpdatetime($snsbind_updatetime)
    {
        $this->snsbind_updatetime = $snsbind_updatetime;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_openid
     *
     * @param string $snsbind_openid
     * @return $this
     */
    public function setSnsbindOpenid($snsbind_openid)
    {
        $this->snsbind_openid = $snsbind_openid;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_openinfo
     *
     * @param string $snsbind_openinfo
     * @return $this
     */
    public function setSnsbindOpeninfo($snsbind_openinfo)
    {
        $this->snsbind_openinfo = $snsbind_openinfo;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_accesstoken
     *
     * @param string $snsbind_accesstoken
     * @return $this
     */
    public function setSnsbindAccesstoken($snsbind_accesstoken)
    {
        $this->snsbind_accesstoken = $snsbind_accesstoken;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_expiresin
     *
     * @param integer $snsbind_expiresin
     * @return $this
     */
    public function setSnsbindExpiresin($snsbind_expiresin)
    {
        $this->snsbind_expiresin = $snsbind_expiresin;

        return $this;
    }

    /**
     * Method to set the value of field snsbind_refreshtoken
     *
     * @param string $snsbind_refreshtoken
     * @return $this
     */
    public function setSnsbindRefreshtoken($snsbind_refreshtoken)
    {
        $this->snsbind_refreshtoken = $snsbind_refreshtoken;

        return $this;
    }

    /**
     * Returns the value of field snsbind_id
     *
     * @return integer
     */
    public function getSnsbindId()
    {
        return $this->snsbind_id;
    }

    /**
     * Returns the value of field snsbind_memberid
     *
     * @return integer
     */
    public function getSnsbindMemberid()
    {
        return $this->snsbind_memberid;
    }

    /**
     * Returns the value of field snsbind_membername
     *
     * @return string
     */
    public function getSnsbindMembername()
    {
        return $this->snsbind_membername;
    }

    /**
     * Returns the value of field snsbind_appsign
     *
     * @return string
     */
    public function getSnsbindAppsign()
    {
        return $this->snsbind_appsign;
    }

    /**
     * Returns the value of field snsbind_updatetime
     *
     * @return integer
     */
    public function getSnsbindUpdatetime()
    {
        return $this->snsbind_updatetime;
    }

    /**
     * Returns the value of field snsbind_openid
     *
     * @return string
     */
    public function getSnsbindOpenid()
    {
        return $this->snsbind_openid;
    }

    /**
     * Returns the value of field snsbind_openinfo
     *
     * @return string
     */
    public function getSnsbindOpeninfo()
    {
        return $this->snsbind_openinfo;
    }

    /**
     * Returns the value of field snsbind_accesstoken
     *
     * @return string
     */
    public function getSnsbindAccesstoken()
    {
        return $this->snsbind_accesstoken;
    }

    /**
     * Returns the value of field snsbind_expiresin
     *
     * @return integer
     */
    public function getSnsbindExpiresin()
    {
        return $this->snsbind_expiresin;
    }

    /**
     * Returns the value of field snsbind_refreshtoken
     *
     * @return string
     */
    public function getSnsbindRefreshtoken()
    {
        return $this->snsbind_refreshtoken;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_binding';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsBinding[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsBinding
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
