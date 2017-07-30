<?php

namespace Ypk\Models;

class CircleExpmember extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

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
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $em_exp;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $em_time;

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
     * Method to set the value of field em_exp
     *
     * @param integer $em_exp
     * @return $this
     */
    public function setEmExp($em_exp)
    {
        $this->em_exp = $em_exp;

        return $this;
    }

    /**
     * Method to set the value of field em_time
     *
     * @param string $em_time
     * @return $this
     */
    public function setEmTime($em_time)
    {
        $this->em_time = $em_time;

        return $this;
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
     * Returns the value of field circle_id
     *
     * @return integer
     */
    public function getCircleId()
    {
        return $this->circle_id;
    }

    /**
     * Returns the value of field em_exp
     *
     * @return integer
     */
    public function getEmExp()
    {
        return $this->em_exp;
    }

    /**
     * Returns the value of field em_time
     *
     * @return string
     */
    public function getEmTime()
    {
        return $this->em_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_expmember';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleExpmember[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleExpmember
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
