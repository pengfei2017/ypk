<?php

namespace Ypk\Models;

class RefundReason extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $reason_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $reason_info;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $update_time;

    /**
     * Method to set the value of field reason_id
     *
     * @param integer $reason_id
     * @return $this
     */
    public function setReasonId($reason_id)
    {
        $this->reason_id = $reason_id;

        return $this;
    }

    /**
     * Method to set the value of field reason_info
     *
     * @param string $reason_info
     * @return $this
     */
    public function setReasonInfo($reason_info)
    {
        $this->reason_info = $reason_info;

        return $this;
    }

    /**
     * Method to set the value of field sort
     *
     * @param integer $sort
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Method to set the value of field update_time
     *
     * @param integer $update_time
     * @return $this
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;

        return $this;
    }

    /**
     * Returns the value of field reason_id
     *
     * @return integer
     */
    public function getReasonId()
    {
        return $this->reason_id;
    }

    /**
     * Returns the value of field reason_info
     *
     * @return string
     */
    public function getReasonInfo()
    {
        return $this->reason_info;
    }

    /**
     * Returns the value of field sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Returns the value of field update_time
     *
     * @return integer
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'refund_reason';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RefundReason[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RefundReason
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
