<?php

namespace Ypk\Models;

class CircleMapply extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $mapply_id;

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
     * @Column(type="string", length=255, nullable=false)
     */
    protected $mapply_reason;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mapply_time;

    /**
     * Method to set the value of field mapply_id
     *
     * @param integer $mapply_id
     * @return $this
     */
    public function setMapplyId($mapply_id)
    {
        $this->mapply_id = $mapply_id;

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
     * Method to set the value of field mapply_reason
     *
     * @param string $mapply_reason
     * @return $this
     */
    public function setMapplyReason($mapply_reason)
    {
        $this->mapply_reason = $mapply_reason;

        return $this;
    }

    /**
     * Method to set the value of field mapply_time
     *
     * @param string $mapply_time
     * @return $this
     */
    public function setMapplyTime($mapply_time)
    {
        $this->mapply_time = $mapply_time;

        return $this;
    }

    /**
     * Returns the value of field mapply_id
     *
     * @return integer
     */
    public function getMapplyId()
    {
        return $this->mapply_id;
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
     * Returns the value of field mapply_reason
     *
     * @return string
     */
    public function getMapplyReason()
    {
        return $this->mapply_reason;
    }

    /**
     * Returns the value of field mapply_time
     *
     * @return string
     */
    public function getMapplyTime()
    {
        return $this->mapply_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_mapply';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMapply[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMapply
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
