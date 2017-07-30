<?php

namespace Ypk\Models;

class OrderLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $log_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $order_id;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $log_msg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $log_time;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $log_role;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $log_user;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $log_orderstate;

    /**
     * Method to set the value of field log_id
     *
     * @param integer $log_id
     * @return $this
     */
    public function setLogId($log_id)
    {
        $this->log_id = $log_id;

        return $this;
    }

    /**
     * Method to set the value of field order_id
     *
     * @param integer $order_id
     * @return $this
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }

    /**
     * Method to set the value of field log_msg
     *
     * @param string $log_msg
     * @return $this
     */
    public function setLogMsg($log_msg)
    {
        $this->log_msg = $log_msg;

        return $this;
    }

    /**
     * Method to set the value of field log_time
     *
     * @param integer $log_time
     * @return $this
     */
    public function setLogTime($log_time)
    {
        $this->log_time = $log_time;

        return $this;
    }

    /**
     * Method to set the value of field log_role
     *
     * @param string $log_role
     * @return $this
     */
    public function setLogRole($log_role)
    {
        $this->log_role = $log_role;

        return $this;
    }

    /**
     * Method to set the value of field log_user
     *
     * @param string $log_user
     * @return $this
     */
    public function setLogUser($log_user)
    {
        $this->log_user = $log_user;

        return $this;
    }

    /**
     * Method to set the value of field log_orderstate
     *
     * @param string $log_orderstate
     * @return $this
     */
    public function setLogOrderstate($log_orderstate)
    {
        $this->log_orderstate = $log_orderstate;

        return $this;
    }

    /**
     * Returns the value of field log_id
     *
     * @return integer
     */
    public function getLogId()
    {
        return $this->log_id;
    }

    /**
     * Returns the value of field order_id
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Returns the value of field log_msg
     *
     * @return string
     */
    public function getLogMsg()
    {
        return $this->log_msg;
    }

    /**
     * Returns the value of field log_time
     *
     * @return integer
     */
    public function getLogTime()
    {
        return $this->log_time;
    }

    /**
     * Returns the value of field log_role
     *
     * @return string
     */
    public function getLogRole()
    {
        return $this->log_role;
    }

    /**
     * Returns the value of field log_user
     *
     * @return string
     */
    public function getLogUser()
    {
        return $this->log_user;
    }

    /**
     * Returns the value of field log_orderstate
     *
     * @return string
     */
    public function getLogOrderstate()
    {
        return $this->log_orderstate;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'order_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
