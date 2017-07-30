<?php

namespace Ypk\Models;

class CircleThreply extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_id;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
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
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $reply_content;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $reply_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $reply_replyid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $reply_replyname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_closed;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $reply_exp;

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
     * Method to set the value of field reply_content
     *
     * @param string $reply_content
     * @return $this
     */
    public function setReplyContent($reply_content)
    {
        $this->reply_content = $reply_content;

        return $this;
    }

    /**
     * Method to set the value of field reply_addtime
     *
     * @param string $reply_addtime
     * @return $this
     */
    public function setReplyAddtime($reply_addtime)
    {
        $this->reply_addtime = $reply_addtime;

        return $this;
    }

    /**
     * Method to set the value of field reply_replyid
     *
     * @param integer $reply_replyid
     * @return $this
     */
    public function setReplyReplyid($reply_replyid)
    {
        $this->reply_replyid = $reply_replyid;

        return $this;
    }

    /**
     * Method to set the value of field reply_replyname
     *
     * @param string $reply_replyname
     * @return $this
     */
    public function setReplyReplyname($reply_replyname)
    {
        $this->reply_replyname = $reply_replyname;

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
     * Method to set the value of field reply_exp
     *
     * @param integer $reply_exp
     * @return $this
     */
    public function setReplyExp($reply_exp)
    {
        $this->reply_exp = $reply_exp;

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
     * Returns the value of field reply_content
     *
     * @return string
     */
    public function getReplyContent()
    {
        return $this->reply_content;
    }

    /**
     * Returns the value of field reply_addtime
     *
     * @return string
     */
    public function getReplyAddtime()
    {
        return $this->reply_addtime;
    }

    /**
     * Returns the value of field reply_replyid
     *
     * @return integer
     */
    public function getReplyReplyid()
    {
        return $this->reply_replyid;
    }

    /**
     * Returns the value of field reply_replyname
     *
     * @return string
     */
    public function getReplyReplyname()
    {
        return $this->reply_replyname;
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
     * Returns the value of field reply_exp
     *
     * @return integer
     */
    public function getReplyExp()
    {
        return $this->reply_exp;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_threply';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThreply[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThreply
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
