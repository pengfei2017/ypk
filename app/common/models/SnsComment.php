<?php

namespace Ypk\Models;

class SnsComment extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $comment_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $comment_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $comment_membername;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $comment_memberavatar;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $comment_originalid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $comment_originaltype;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $comment_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $comment_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $comment_ip;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $comment_state;

    /**
     * Method to set the value of field comment_id
     *
     * @param integer $comment_id
     * @return $this
     */
    public function setCommentId($comment_id)
    {
        $this->comment_id = $comment_id;

        return $this;
    }

    /**
     * Method to set the value of field comment_memberid
     *
     * @param integer $comment_memberid
     * @return $this
     */
    public function setCommentMemberid($comment_memberid)
    {
        $this->comment_memberid = $comment_memberid;

        return $this;
    }

    /**
     * Method to set the value of field comment_membername
     *
     * @param string $comment_membername
     * @return $this
     */
    public function setCommentMembername($comment_membername)
    {
        $this->comment_membername = $comment_membername;

        return $this;
    }

    /**
     * Method to set the value of field comment_memberavatar
     *
     * @param string $comment_memberavatar
     * @return $this
     */
    public function setCommentMemberavatar($comment_memberavatar)
    {
        $this->comment_memberavatar = $comment_memberavatar;

        return $this;
    }

    /**
     * Method to set the value of field comment_originalid
     *
     * @param integer $comment_originalid
     * @return $this
     */
    public function setCommentOriginalid($comment_originalid)
    {
        $this->comment_originalid = $comment_originalid;

        return $this;
    }

    /**
     * Method to set the value of field comment_originaltype
     *
     * @param integer $comment_originaltype
     * @return $this
     */
    public function setCommentOriginaltype($comment_originaltype)
    {
        $this->comment_originaltype = $comment_originaltype;

        return $this;
    }

    /**
     * Method to set the value of field comment_content
     *
     * @param string $comment_content
     * @return $this
     */
    public function setCommentContent($comment_content)
    {
        $this->comment_content = $comment_content;

        return $this;
    }

    /**
     * Method to set the value of field comment_addtime
     *
     * @param integer $comment_addtime
     * @return $this
     */
    public function setCommentAddtime($comment_addtime)
    {
        $this->comment_addtime = $comment_addtime;

        return $this;
    }

    /**
     * Method to set the value of field comment_ip
     *
     * @param string $comment_ip
     * @return $this
     */
    public function setCommentIp($comment_ip)
    {
        $this->comment_ip = $comment_ip;

        return $this;
    }

    /**
     * Method to set the value of field comment_state
     *
     * @param integer $comment_state
     * @return $this
     */
    public function setCommentState($comment_state)
    {
        $this->comment_state = $comment_state;

        return $this;
    }

    /**
     * Returns the value of field comment_id
     *
     * @return integer
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * Returns the value of field comment_memberid
     *
     * @return integer
     */
    public function getCommentMemberid()
    {
        return $this->comment_memberid;
    }

    /**
     * Returns the value of field comment_membername
     *
     * @return string
     */
    public function getCommentMembername()
    {
        return $this->comment_membername;
    }

    /**
     * Returns the value of field comment_memberavatar
     *
     * @return string
     */
    public function getCommentMemberavatar()
    {
        return $this->comment_memberavatar;
    }

    /**
     * Returns the value of field comment_originalid
     *
     * @return integer
     */
    public function getCommentOriginalid()
    {
        return $this->comment_originalid;
    }

    /**
     * Returns the value of field comment_originaltype
     *
     * @return integer
     */
    public function getCommentOriginaltype()
    {
        return $this->comment_originaltype;
    }

    /**
     * Returns the value of field comment_content
     *
     * @return string
     */
    public function getCommentContent()
    {
        return $this->comment_content;
    }

    /**
     * Returns the value of field comment_addtime
     *
     * @return integer
     */
    public function getCommentAddtime()
    {
        return $this->comment_addtime;
    }

    /**
     * Returns the value of field comment_ip
     *
     * @return string
     */
    public function getCommentIp()
    {
        return $this->comment_ip;
    }

    /**
     * Returns the value of field comment_state
     *
     * @return integer
     */
    public function getCommentState()
    {
        return $this->comment_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_comment';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsComment[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsComment
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
