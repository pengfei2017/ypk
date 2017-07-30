<?php

namespace Ypk\Models;

class CircleAffix extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $affix_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $affix_filename;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $affix_filethumb;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $affix_filesize;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $affix_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $affix_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $reply_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_id;

    /**
     * Method to set the value of field affix_id
     *
     * @param integer $affix_id
     * @return $this
     */
    public function setAffixId($affix_id)
    {
        $this->affix_id = $affix_id;

        return $this;
    }

    /**
     * Method to set the value of field affix_filename
     *
     * @param string $affix_filename
     * @return $this
     */
    public function setAffixFilename($affix_filename)
    {
        $this->affix_filename = $affix_filename;

        return $this;
    }

    /**
     * Method to set the value of field affix_filethumb
     *
     * @param string $affix_filethumb
     * @return $this
     */
    public function setAffixFilethumb($affix_filethumb)
    {
        $this->affix_filethumb = $affix_filethumb;

        return $this;
    }

    /**
     * Method to set the value of field affix_filesize
     *
     * @param integer $affix_filesize
     * @return $this
     */
    public function setAffixFilesize($affix_filesize)
    {
        $this->affix_filesize = $affix_filesize;

        return $this;
    }

    /**
     * Method to set the value of field affix_addtime
     *
     * @param string $affix_addtime
     * @return $this
     */
    public function setAffixAddtime($affix_addtime)
    {
        $this->affix_addtime = $affix_addtime;

        return $this;
    }

    /**
     * Method to set the value of field affix_type
     *
     * @param integer $affix_type
     * @return $this
     */
    public function setAffixType($affix_type)
    {
        $this->affix_type = $affix_type;

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
     * Method to set the value of field reply_id
     *
     * @param integer $reply_id
     * @return $this
     */
    public function setReplyId($reply_id)
    {
        $this->reply_id = $reply_id;

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
     * Returns the value of field affix_id
     *
     * @return integer
     */
    public function getAffixId()
    {
        return $this->affix_id;
    }

    /**
     * Returns the value of field affix_filename
     *
     * @return string
     */
    public function getAffixFilename()
    {
        return $this->affix_filename;
    }

    /**
     * Returns the value of field affix_filethumb
     *
     * @return string
     */
    public function getAffixFilethumb()
    {
        return $this->affix_filethumb;
    }

    /**
     * Returns the value of field affix_filesize
     *
     * @return integer
     */
    public function getAffixFilesize()
    {
        return $this->affix_filesize;
    }

    /**
     * Returns the value of field affix_addtime
     *
     * @return string
     */
    public function getAffixAddtime()
    {
        return $this->affix_addtime;
    }

    /**
     * Returns the value of field affix_type
     *
     * @return integer
     */
    public function getAffixType()
    {
        return $this->affix_type;
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
     * Returns the value of field theme_id
     *
     * @return integer
     */
    public function getThemeId()
    {
        return $this->theme_id;
    }

    /**
     * Returns the value of field reply_id
     *
     * @return integer
     */
    public function getReplyId()
    {
        return $this->reply_id;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_affix';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleAffix[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleAffix
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
