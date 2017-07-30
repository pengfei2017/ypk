<?php

namespace Ypk\Models;

class CircleExplog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $el_id;

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
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $el_exp;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $el_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $el_type;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $el_itemid;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $el_desc;

    /**
     * Method to set the value of field el_id
     *
     * @param integer $el_id
     * @return $this
     */
    public function setElId($el_id)
    {
        $this->el_id = $el_id;

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
     * Method to set the value of field el_exp
     *
     * @param integer $el_exp
     * @return $this
     */
    public function setElExp($el_exp)
    {
        $this->el_exp = $el_exp;

        return $this;
    }

    /**
     * Method to set the value of field el_time
     *
     * @param string $el_time
     * @return $this
     */
    public function setElTime($el_time)
    {
        $this->el_time = $el_time;

        return $this;
    }

    /**
     * Method to set the value of field el_type
     *
     * @param integer $el_type
     * @return $this
     */
    public function setElType($el_type)
    {
        $this->el_type = $el_type;

        return $this;
    }

    /**
     * Method to set the value of field el_itemid
     *
     * @param string $el_itemid
     * @return $this
     */
    public function setElItemid($el_itemid)
    {
        $this->el_itemid = $el_itemid;

        return $this;
    }

    /**
     * Method to set the value of field el_desc
     *
     * @param string $el_desc
     * @return $this
     */
    public function setElDesc($el_desc)
    {
        $this->el_desc = $el_desc;

        return $this;
    }

    /**
     * Returns the value of field el_id
     *
     * @return integer
     */
    public function getElId()
    {
        return $this->el_id;
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
     * Returns the value of field el_exp
     *
     * @return integer
     */
    public function getElExp()
    {
        return $this->el_exp;
    }

    /**
     * Returns the value of field el_time
     *
     * @return string
     */
    public function getElTime()
    {
        return $this->el_time;
    }

    /**
     * Returns the value of field el_type
     *
     * @return integer
     */
    public function getElType()
    {
        return $this->el_type;
    }

    /**
     * Returns the value of field el_itemid
     *
     * @return string
     */
    public function getElItemid()
    {
        return $this->el_itemid;
    }

    /**
     * Returns the value of field el_desc
     *
     * @return string
     */
    public function getElDesc()
    {
        return $this->el_desc;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_explog';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleExplog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleExplog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
