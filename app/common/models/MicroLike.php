<?php

namespace Ypk\Models;

class MicroLike extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $like_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $like_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $like_object_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $like_member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $like_time;

    /**
     * Method to set the value of field like_id
     *
     * @param integer $like_id
     * @return $this
     */
    public function setLikeId($like_id)
    {
        $this->like_id = $like_id;

        return $this;
    }

    /**
     * Method to set the value of field like_type
     *
     * @param integer $like_type
     * @return $this
     */
    public function setLikeType($like_type)
    {
        $this->like_type = $like_type;

        return $this;
    }

    /**
     * Method to set the value of field like_object_id
     *
     * @param integer $like_object_id
     * @return $this
     */
    public function setLikeObjectId($like_object_id)
    {
        $this->like_object_id = $like_object_id;

        return $this;
    }

    /**
     * Method to set the value of field like_member_id
     *
     * @param integer $like_member_id
     * @return $this
     */
    public function setLikeMemberId($like_member_id)
    {
        $this->like_member_id = $like_member_id;

        return $this;
    }

    /**
     * Method to set the value of field like_time
     *
     * @param integer $like_time
     * @return $this
     */
    public function setLikeTime($like_time)
    {
        $this->like_time = $like_time;

        return $this;
    }

    /**
     * Returns the value of field like_id
     *
     * @return integer
     */
    public function getLikeId()
    {
        return $this->like_id;
    }

    /**
     * Returns the value of field like_type
     *
     * @return integer
     */
    public function getLikeType()
    {
        return $this->like_type;
    }

    /**
     * Returns the value of field like_object_id
     *
     * @return integer
     */
    public function getLikeObjectId()
    {
        return $this->like_object_id;
    }

    /**
     * Returns the value of field like_member_id
     *
     * @return integer
     */
    public function getLikeMemberId()
    {
        return $this->like_member_id;
    }

    /**
     * Returns the value of field like_time
     *
     * @return integer
     */
    public function getLikeTime()
    {
        return $this->like_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'micro_like';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroLike[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroLike
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
