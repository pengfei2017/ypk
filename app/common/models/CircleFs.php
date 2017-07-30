<?php

namespace Ypk\Models;

class CircleFs extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $friendship_id;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=false)
     */
    protected $friendship_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $friendship_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $friendship_status;

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
     * Method to set the value of field friendship_id
     *
     * @param integer $friendship_id
     * @return $this
     */
    public function setFriendshipId($friendship_id)
    {
        $this->friendship_id = $friendship_id;

        return $this;
    }

    /**
     * Method to set the value of field friendship_name
     *
     * @param string $friendship_name
     * @return $this
     */
    public function setFriendshipName($friendship_name)
    {
        $this->friendship_name = $friendship_name;

        return $this;
    }

    /**
     * Method to set the value of field friendship_sort
     *
     * @param integer $friendship_sort
     * @return $this
     */
    public function setFriendshipSort($friendship_sort)
    {
        $this->friendship_sort = $friendship_sort;

        return $this;
    }

    /**
     * Method to set the value of field friendship_status
     *
     * @param integer $friendship_status
     * @return $this
     */
    public function setFriendshipStatus($friendship_status)
    {
        $this->friendship_status = $friendship_status;

        return $this;
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
     * Returns the value of field friendship_id
     *
     * @return integer
     */
    public function getFriendshipId()
    {
        return $this->friendship_id;
    }

    /**
     * Returns the value of field friendship_name
     *
     * @return string
     */
    public function getFriendshipName()
    {
        return $this->friendship_name;
    }

    /**
     * Returns the value of field friendship_sort
     *
     * @return integer
     */
    public function getFriendshipSort()
    {
        return $this->friendship_sort;
    }

    /**
     * Returns the value of field friendship_status
     *
     * @return integer
     */
    public function getFriendshipStatus()
    {
        return $this->friendship_status;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_fs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleFs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleFs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
