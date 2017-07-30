<?php

namespace Ypk\Models;

class SnsSharestore extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $share_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $share_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $share_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $share_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $share_membername;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $share_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $share_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $share_privacy;

    /**
     * Method to set the value of field share_id
     *
     * @param integer $share_id
     * @return $this
     */
    public function setShareId($share_id)
    {
        $this->share_id = $share_id;

        return $this;
    }

    /**
     * Method to set the value of field share_storeid
     *
     * @param integer $share_storeid
     * @return $this
     */
    public function setShareStoreid($share_storeid)
    {
        $this->share_storeid = $share_storeid;

        return $this;
    }

    /**
     * Method to set the value of field share_storename
     *
     * @param string $share_storename
     * @return $this
     */
    public function setShareStorename($share_storename)
    {
        $this->share_storename = $share_storename;

        return $this;
    }

    /**
     * Method to set the value of field share_memberid
     *
     * @param integer $share_memberid
     * @return $this
     */
    public function setShareMemberid($share_memberid)
    {
        $this->share_memberid = $share_memberid;

        return $this;
    }

    /**
     * Method to set the value of field share_membername
     *
     * @param string $share_membername
     * @return $this
     */
    public function setShareMembername($share_membername)
    {
        $this->share_membername = $share_membername;

        return $this;
    }

    /**
     * Method to set the value of field share_content
     *
     * @param string $share_content
     * @return $this
     */
    public function setShareContent($share_content)
    {
        $this->share_content = $share_content;

        return $this;
    }

    /**
     * Method to set the value of field share_addtime
     *
     * @param integer $share_addtime
     * @return $this
     */
    public function setShareAddtime($share_addtime)
    {
        $this->share_addtime = $share_addtime;

        return $this;
    }

    /**
     * Method to set the value of field share_privacy
     *
     * @param integer $share_privacy
     * @return $this
     */
    public function setSharePrivacy($share_privacy)
    {
        $this->share_privacy = $share_privacy;

        return $this;
    }

    /**
     * Returns the value of field share_id
     *
     * @return integer
     */
    public function getShareId()
    {
        return $this->share_id;
    }

    /**
     * Returns the value of field share_storeid
     *
     * @return integer
     */
    public function getShareStoreid()
    {
        return $this->share_storeid;
    }

    /**
     * Returns the value of field share_storename
     *
     * @return string
     */
    public function getShareStorename()
    {
        return $this->share_storename;
    }

    /**
     * Returns the value of field share_memberid
     *
     * @return integer
     */
    public function getShareMemberid()
    {
        return $this->share_memberid;
    }

    /**
     * Returns the value of field share_membername
     *
     * @return string
     */
    public function getShareMembername()
    {
        return $this->share_membername;
    }

    /**
     * Returns the value of field share_content
     *
     * @return string
     */
    public function getShareContent()
    {
        return $this->share_content;
    }

    /**
     * Returns the value of field share_addtime
     *
     * @return integer
     */
    public function getShareAddtime()
    {
        return $this->share_addtime;
    }

    /**
     * Returns the value of field share_privacy
     *
     * @return integer
     */
    public function getSharePrivacy()
    {
        return $this->share_privacy;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_sharestore';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsSharestore[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsSharestore
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
