<?php

namespace Ypk\Models;

class SnsSharegoods extends \Phalcon\Mvc\Model
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
    protected $share_goodsid;

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
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $share_likeaddtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $share_privacy;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $share_commentcount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $share_isshare;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $share_islike;

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
     * Method to set the value of field share_goodsid
     *
     * @param integer $share_goodsid
     * @return $this
     */
    public function setShareGoodsid($share_goodsid)
    {
        $this->share_goodsid = $share_goodsid;

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
     * Method to set the value of field share_likeaddtime
     *
     * @param integer $share_likeaddtime
     * @return $this
     */
    public function setShareLikeaddtime($share_likeaddtime)
    {
        $this->share_likeaddtime = $share_likeaddtime;

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
     * Method to set the value of field share_commentcount
     *
     * @param integer $share_commentcount
     * @return $this
     */
    public function setShareCommentcount($share_commentcount)
    {
        $this->share_commentcount = $share_commentcount;

        return $this;
    }

    /**
     * Method to set the value of field share_isshare
     *
     * @param integer $share_isshare
     * @return $this
     */
    public function setShareIsshare($share_isshare)
    {
        $this->share_isshare = $share_isshare;

        return $this;
    }

    /**
     * Method to set the value of field share_islike
     *
     * @param integer $share_islike
     * @return $this
     */
    public function setShareIslike($share_islike)
    {
        $this->share_islike = $share_islike;

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
     * Returns the value of field share_goodsid
     *
     * @return integer
     */
    public function getShareGoodsid()
    {
        return $this->share_goodsid;
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
     * Returns the value of field share_likeaddtime
     *
     * @return integer
     */
    public function getShareLikeaddtime()
    {
        return $this->share_likeaddtime;
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
     * Returns the value of field share_commentcount
     *
     * @return integer
     */
    public function getShareCommentcount()
    {
        return $this->share_commentcount;
    }

    /**
     * Returns the value of field share_isshare
     *
     * @return integer
     */
    public function getShareIsshare()
    {
        return $this->share_isshare;
    }

    /**
     * Returns the value of field share_islike
     *
     * @return integer
     */
    public function getShareIslike()
    {
        return $this->share_islike;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_sharegoods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsSharegoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsSharegoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
