<?php

namespace Ypk\Models;

class CircleRecycle extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $recycle_id;

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
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $theme_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $recycle_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $recycle_opid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $recycle_opname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $recycle_type;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $recycle_time;

    /**
     * Method to set the value of field recycle_id
     *
     * @param integer $recycle_id
     * @return $this
     */
    public function setRecycleId($recycle_id)
    {
        $this->recycle_id = $recycle_id;

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
     * Method to set the value of field recycle_content
     *
     * @param string $recycle_content
     * @return $this
     */
    public function setRecycleContent($recycle_content)
    {
        $this->recycle_content = $recycle_content;

        return $this;
    }

    /**
     * Method to set the value of field recycle_opid
     *
     * @param integer $recycle_opid
     * @return $this
     */
    public function setRecycleOpid($recycle_opid)
    {
        $this->recycle_opid = $recycle_opid;

        return $this;
    }

    /**
     * Method to set the value of field recycle_opname
     *
     * @param string $recycle_opname
     * @return $this
     */
    public function setRecycleOpname($recycle_opname)
    {
        $this->recycle_opname = $recycle_opname;

        return $this;
    }

    /**
     * Method to set the value of field recycle_type
     *
     * @param integer $recycle_type
     * @return $this
     */
    public function setRecycleType($recycle_type)
    {
        $this->recycle_type = $recycle_type;

        return $this;
    }

    /**
     * Method to set the value of field recycle_time
     *
     * @param string $recycle_time
     * @return $this
     */
    public function setRecycleTime($recycle_time)
    {
        $this->recycle_time = $recycle_time;

        return $this;
    }

    /**
     * Returns the value of field recycle_id
     *
     * @return integer
     */
    public function getRecycleId()
    {
        return $this->recycle_id;
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
     * Returns the value of field theme_name
     *
     * @return string
     */
    public function getThemeName()
    {
        return $this->theme_name;
    }

    /**
     * Returns the value of field recycle_content
     *
     * @return string
     */
    public function getRecycleContent()
    {
        return $this->recycle_content;
    }

    /**
     * Returns the value of field recycle_opid
     *
     * @return integer
     */
    public function getRecycleOpid()
    {
        return $this->recycle_opid;
    }

    /**
     * Returns the value of field recycle_opname
     *
     * @return string
     */
    public function getRecycleOpname()
    {
        return $this->recycle_opname;
    }

    /**
     * Returns the value of field recycle_type
     *
     * @return integer
     */
    public function getRecycleType()
    {
        return $this->recycle_type;
    }

    /**
     * Returns the value of field recycle_time
     *
     * @return string
     */
    public function getRecycleTime()
    {
        return $this->recycle_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_recycle';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleRecycle[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleRecycle
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
