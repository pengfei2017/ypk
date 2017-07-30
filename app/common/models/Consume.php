<?php

namespace Ypk\Models;

class Consume extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $consume_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
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
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $consume_amount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $consume_time;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $consume_remark;

    /**
     * Method to set the value of field consume_id
     *
     * @param integer $consume_id
     * @return $this
     */
    public function setConsumeId($consume_id)
    {
        $this->consume_id = $consume_id;

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
     * Method to set the value of field consume_amount
     *
     * @param double $consume_amount
     * @return $this
     */
    public function setConsumeAmount($consume_amount)
    {
        $this->consume_amount = $consume_amount;

        return $this;
    }

    /**
     * Method to set the value of field consume_time
     *
     * @param integer $consume_time
     * @return $this
     */
    public function setConsumeTime($consume_time)
    {
        $this->consume_time = $consume_time;

        return $this;
    }

    /**
     * Method to set the value of field consume_remark
     *
     * @param string $consume_remark
     * @return $this
     */
    public function setConsumeRemark($consume_remark)
    {
        $this->consume_remark = $consume_remark;

        return $this;
    }

    /**
     * Returns the value of field consume_id
     *
     * @return integer
     */
    public function getConsumeId()
    {
        return $this->consume_id;
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
     * Returns the value of field consume_amount
     *
     * @return double
     */
    public function getConsumeAmount()
    {
        return $this->consume_amount;
    }

    /**
     * Returns the value of field consume_time
     *
     * @return integer
     */
    public function getConsumeTime()
    {
        return $this->consume_time;
    }

    /**
     * Returns the value of field consume_remark
     *
     * @return string
     */
    public function getConsumeRemark()
    {
        return $this->consume_remark;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'consume';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Consume[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Consume
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
