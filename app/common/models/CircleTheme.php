<?php

namespace Ypk\Models;

class CircleTheme extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $theme_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $theme_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_id;

    /**
     *
     * @var string
     * @Column(type="string", length=12, nullable=false)
     */
    protected $circle_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $thclass_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $thclass_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
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
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_identity;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $theme_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $theme_editname;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $theme_edittime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_likecount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_commentcount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_browsecount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_sharecount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_stick;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_digest;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $lastspeak_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $lastspeak_name;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $lastspeak_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $has_goods;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $has_affix;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_closed;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_recommend;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_shut;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_exp;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $theme_readperm;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $theme_special;

    /**
     * Method to set the value of field theme_id
     *
     * @param integer $theme_id
     * @return $this
     */
    public function setThemeId($theme_id)
    {
        $this->theme_id = $theme_id;

        return $this;
    }

    /**
     * Method to set the value of field theme_name
     *
     * @param string $theme_name
     * @return $this
     */
    public function setThemeName($theme_name)
    {
        $this->theme_name = $theme_name;

        return $this;
    }

    /**
     * Method to set the value of field theme_content
     *
     * @param string $theme_content
     * @return $this
     */
    public function setThemeContent($theme_content)
    {
        $this->theme_content = $theme_content;

        return $this;
    }

    /**
     * Method to set the value of field circle_id
     *
     * @param integer $circle_id
     * @return $this
     */
    public function setCircleId($circle_id)
    {
        $this->circle_id = $circle_id;

        return $this;
    }

    /**
     * Method to set the value of field circle_name
     *
     * @param string $circle_name
     * @return $this
     */
    public function setCircleName($circle_name)
    {
        $this->circle_name = $circle_name;

        return $this;
    }

    /**
     * Method to set the value of field thclass_id
     *
     * @param integer $thclass_id
     * @return $this
     */
    public function setThclassId($thclass_id)
    {
        $this->thclass_id = $thclass_id;

        return $this;
    }

    /**
     * Method to set the value of field thclass_name
     *
     * @param string $thclass_name
     * @return $this
     */
    public function setThclassName($thclass_name)
    {
        $this->thclass_name = $thclass_name;

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
     * Method to set the value of field is_identity
     *
     * @param integer $is_identity
     * @return $this
     */
    public function setIsIdentity($is_identity)
    {
        $this->is_identity = $is_identity;

        return $this;
    }

    /**
     * Method to set the value of field theme_addtime
     *
     * @param string $theme_addtime
     * @return $this
     */
    public function setThemeAddtime($theme_addtime)
    {
        $this->theme_addtime = $theme_addtime;

        return $this;
    }

    /**
     * Method to set the value of field theme_editname
     *
     * @param string $theme_editname
     * @return $this
     */
    public function setThemeEditname($theme_editname)
    {
        $this->theme_editname = $theme_editname;

        return $this;
    }

    /**
     * Method to set the value of field theme_edittime
     *
     * @param string $theme_edittime
     * @return $this
     */
    public function setThemeEdittime($theme_edittime)
    {
        $this->theme_edittime = $theme_edittime;

        return $this;
    }

    /**
     * Method to set the value of field theme_likecount
     *
     * @param integer $theme_likecount
     * @return $this
     */
    public function setThemeLikecount($theme_likecount)
    {
        $this->theme_likecount = $theme_likecount;

        return $this;
    }

    /**
     * Method to set the value of field theme_commentcount
     *
     * @param integer $theme_commentcount
     * @return $this
     */
    public function setThemeCommentcount($theme_commentcount)
    {
        $this->theme_commentcount = $theme_commentcount;

        return $this;
    }

    /**
     * Method to set the value of field theme_browsecount
     *
     * @param integer $theme_browsecount
     * @return $this
     */
    public function setThemeBrowsecount($theme_browsecount)
    {
        $this->theme_browsecount = $theme_browsecount;

        return $this;
    }

    /**
     * Method to set the value of field theme_sharecount
     *
     * @param integer $theme_sharecount
     * @return $this
     */
    public function setThemeSharecount($theme_sharecount)
    {
        $this->theme_sharecount = $theme_sharecount;

        return $this;
    }

    /**
     * Method to set the value of field is_stick
     *
     * @param integer $is_stick
     * @return $this
     */
    public function setIsStick($is_stick)
    {
        $this->is_stick = $is_stick;

        return $this;
    }

    /**
     * Method to set the value of field is_digest
     *
     * @param integer $is_digest
     * @return $this
     */
    public function setIsDigest($is_digest)
    {
        $this->is_digest = $is_digest;

        return $this;
    }

    /**
     * Method to set the value of field lastspeak_id
     *
     * @param integer $lastspeak_id
     * @return $this
     */
    public function setLastspeakId($lastspeak_id)
    {
        $this->lastspeak_id = $lastspeak_id;

        return $this;
    }

    /**
     * Method to set the value of field lastspeak_name
     *
     * @param string $lastspeak_name
     * @return $this
     */
    public function setLastspeakName($lastspeak_name)
    {
        $this->lastspeak_name = $lastspeak_name;

        return $this;
    }

    /**
     * Method to set the value of field lastspeak_time
     *
     * @param string $lastspeak_time
     * @return $this
     */
    public function setLastspeakTime($lastspeak_time)
    {
        $this->lastspeak_time = $lastspeak_time;

        return $this;
    }

    /**
     * Method to set the value of field has_goods
     *
     * @param integer $has_goods
     * @return $this
     */
    public function setHasGoods($has_goods)
    {
        $this->has_goods = $has_goods;

        return $this;
    }

    /**
     * Method to set the value of field has_affix
     *
     * @param integer $has_affix
     * @return $this
     */
    public function setHasAffix($has_affix)
    {
        $this->has_affix = $has_affix;

        return $this;
    }

    /**
     * Method to set the value of field is_closed
     *
     * @param integer $is_closed
     * @return $this
     */
    public function setIsClosed($is_closed)
    {
        $this->is_closed = $is_closed;

        return $this;
    }

    /**
     * Method to set the value of field is_recommend
     *
     * @param integer $is_recommend
     * @return $this
     */
    public function setIsRecommend($is_recommend)
    {
        $this->is_recommend = $is_recommend;

        return $this;
    }

    /**
     * Method to set the value of field is_shut
     *
     * @param integer $is_shut
     * @return $this
     */
    public function setIsShut($is_shut)
    {
        $this->is_shut = $is_shut;

        return $this;
    }

    /**
     * Method to set the value of field theme_exp
     *
     * @param integer $theme_exp
     * @return $this
     */
    public function setThemeExp($theme_exp)
    {
        $this->theme_exp = $theme_exp;

        return $this;
    }

    /**
     * Method to set the value of field theme_readperm
     *
     * @param integer $theme_readperm
     * @return $this
     */
    public function setThemeReadperm($theme_readperm)
    {
        $this->theme_readperm = $theme_readperm;

        return $this;
    }

    /**
     * Method to set the value of field theme_special
     *
     * @param integer $theme_special
     * @return $this
     */
    public function setThemeSpecial($theme_special)
    {
        $this->theme_special = $theme_special;

        return $this;
    }

    /**
     * Returns the value of field theme_id
     *
     * @return integer
     */
    public function getThemeId()
    {
        return $this->theme_id;
    }

    /**
     * Returns the value of field theme_name
     *
     * @return string
     */
    public function getThemeName()
    {
        return $this->theme_name;
    }

    /**
     * Returns the value of field theme_content
     *
     * @return string
     */
    public function getThemeContent()
    {
        return $this->theme_content;
    }

    /**
     * Returns the value of field circle_id
     *
     * @return integer
     */
    public function getCircleId()
    {
        return $this->circle_id;
    }

    /**
     * Returns the value of field circle_name
     *
     * @return string
     */
    public function getCircleName()
    {
        return $this->circle_name;
    }

    /**
     * Returns the value of field thclass_id
     *
     * @return integer
     */
    public function getThclassId()
    {
        return $this->thclass_id;
    }

    /**
     * Returns the value of field thclass_name
     *
     * @return string
     */
    public function getThclassName()
    {
        return $this->thclass_name;
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
     * Returns the value of field is_identity
     *
     * @return integer
     */
    public function getIsIdentity()
    {
        return $this->is_identity;
    }

    /**
     * Returns the value of field theme_addtime
     *
     * @return string
     */
    public function getThemeAddtime()
    {
        return $this->theme_addtime;
    }

    /**
     * Returns the value of field theme_editname
     *
     * @return string
     */
    public function getThemeEditname()
    {
        return $this->theme_editname;
    }

    /**
     * Returns the value of field theme_edittime
     *
     * @return string
     */
    public function getThemeEdittime()
    {
        return $this->theme_edittime;
    }

    /**
     * Returns the value of field theme_likecount
     *
     * @return integer
     */
    public function getThemeLikecount()
    {
        return $this->theme_likecount;
    }

    /**
     * Returns the value of field theme_commentcount
     *
     * @return integer
     */
    public function getThemeCommentcount()
    {
        return $this->theme_commentcount;
    }

    /**
     * Returns the value of field theme_browsecount
     *
     * @return integer
     */
    public function getThemeBrowsecount()
    {
        return $this->theme_browsecount;
    }

    /**
     * Returns the value of field theme_sharecount
     *
     * @return integer
     */
    public function getThemeSharecount()
    {
        return $this->theme_sharecount;
    }

    /**
     * Returns the value of field is_stick
     *
     * @return integer
     */
    public function getIsStick()
    {
        return $this->is_stick;
    }

    /**
     * Returns the value of field is_digest
     *
     * @return integer
     */
    public function getIsDigest()
    {
        return $this->is_digest;
    }

    /**
     * Returns the value of field lastspeak_id
     *
     * @return integer
     */
    public function getLastspeakId()
    {
        return $this->lastspeak_id;
    }

    /**
     * Returns the value of field lastspeak_name
     *
     * @return string
     */
    public function getLastspeakName()
    {
        return $this->lastspeak_name;
    }

    /**
     * Returns the value of field lastspeak_time
     *
     * @return string
     */
    public function getLastspeakTime()
    {
        return $this->lastspeak_time;
    }

    /**
     * Returns the value of field has_goods
     *
     * @return integer
     */
    public function getHasGoods()
    {
        return $this->has_goods;
    }

    /**
     * Returns the value of field has_affix
     *
     * @return integer
     */
    public function getHasAffix()
    {
        return $this->has_affix;
    }

    /**
     * Returns the value of field is_closed
     *
     * @return integer
     */
    public function getIsClosed()
    {
        return $this->is_closed;
    }

    /**
     * Returns the value of field is_recommend
     *
     * @return integer
     */
    public function getIsRecommend()
    {
        return $this->is_recommend;
    }

    /**
     * Returns the value of field is_shut
     *
     * @return integer
     */
    public function getIsShut()
    {
        return $this->is_shut;
    }

    /**
     * Returns the value of field theme_exp
     *
     * @return integer
     */
    public function getThemeExp()
    {
        return $this->theme_exp;
    }

    /**
     * Returns the value of field theme_readperm
     *
     * @return integer
     */
    public function getThemeReadperm()
    {
        return $this->theme_readperm;
    }

    /**
     * Returns the value of field theme_special
     *
     * @return integer
     */
    public function getThemeSpecial()
    {
        return $this->theme_special;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_theme';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleTheme[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleTheme
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
