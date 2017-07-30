<?php

namespace Ypk\Models;

class CmsCommentUp extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $up_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $comment_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $up_member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $up_time;

    /**
     * Method to set the value of field up_id
     *
     * @param integer $up_id
     * @return $this
     */
    public function setUpId($up_id)
    {
        $this->up_id = $up_id;

        return $this;
    }

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
     * Method to set the value of field up_member_id
     *
     * @param integer $up_member_id
     * @return $this
     */
    public function setUpMemberId($up_member_id)
    {
        $this->up_member_id = $up_member_id;

        return $this;
    }

    /**
     * Method to set the value of field up_time
     *
     * @param integer $up_time
     * @return $this
     */
    public function setUpTime($up_time)
    {
        $this->up_time = $up_time;

        return $this;
    }

    /**
     * Returns the value of field up_id
     *
     * @return integer
     */
    public function getUpId()
    {
        return $this->up_id;
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
     * Returns the value of field up_member_id
     *
     * @return integer
     */
    public function getUpMemberId()
    {
        return $this->up_member_id;
    }

    /**
     * Returns the value of field up_time
     *
     * @return integer
     */
    public function getUpTime()
    {
        return $this->up_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_comment_up';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsCommentUp[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsCommentUp
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
