<?php

namespace Ypk\Models;

class CmsComment extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $comment_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $comment_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $comment_object_id;

    /**
     *
     * @var string
     * @Column(type="string", length=2000, nullable=false)
     */
    protected $comment_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $comment_member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $comment_time;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $comment_quote;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $comment_up;

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
     * Method to set the value of field comment_type
     *
     * @param integer $comment_type
     * @return $this
     */
    public function setCommentType($comment_type)
    {
        $this->comment_type = $comment_type;

        return $this;
    }

    /**
     * Method to set the value of field comment_object_id
     *
     * @param integer $comment_object_id
     * @return $this
     */
    public function setCommentObjectId($comment_object_id)
    {
        $this->comment_object_id = $comment_object_id;

        return $this;
    }

    /**
     * Method to set the value of field comment_message
     *
     * @param string $comment_message
     * @return $this
     */
    public function setCommentMessage($comment_message)
    {
        $this->comment_message = $comment_message;

        return $this;
    }

    /**
     * Method to set the value of field comment_member_id
     *
     * @param integer $comment_member_id
     * @return $this
     */
    public function setCommentMemberId($comment_member_id)
    {
        $this->comment_member_id = $comment_member_id;

        return $this;
    }

    /**
     * Method to set the value of field comment_time
     *
     * @param integer $comment_time
     * @return $this
     */
    public function setCommentTime($comment_time)
    {
        $this->comment_time = $comment_time;

        return $this;
    }

    /**
     * Method to set the value of field comment_quote
     *
     * @param string $comment_quote
     * @return $this
     */
    public function setCommentQuote($comment_quote)
    {
        $this->comment_quote = $comment_quote;

        return $this;
    }

    /**
     * Method to set the value of field comment_up
     *
     * @param integer $comment_up
     * @return $this
     */
    public function setCommentUp($comment_up)
    {
        $this->comment_up = $comment_up;

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
     * Returns the value of field comment_type
     *
     * @return integer
     */
    public function getCommentType()
    {
        return $this->comment_type;
    }

    /**
     * Returns the value of field comment_object_id
     *
     * @return integer
     */
    public function getCommentObjectId()
    {
        return $this->comment_object_id;
    }

    /**
     * Returns the value of field comment_message
     *
     * @return string
     */
    public function getCommentMessage()
    {
        return $this->comment_message;
    }

    /**
     * Returns the value of field comment_member_id
     *
     * @return integer
     */
    public function getCommentMemberId()
    {
        return $this->comment_member_id;
    }

    /**
     * Returns the value of field comment_time
     *
     * @return integer
     */
    public function getCommentTime()
    {
        return $this->comment_time;
    }

    /**
     * Returns the value of field comment_quote
     *
     * @return string
     */
    public function getCommentQuote()
    {
        return $this->comment_quote;
    }

    /**
     * Returns the value of field comment_up
     *
     * @return integer
     */
    public function getCommentUp()
    {
        return $this->comment_up;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_comment';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsComment[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsComment
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
