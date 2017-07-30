<?php

namespace Ypk\Models;

class StoreMsgRead extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sm_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $seller_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $read_time;

    /**
     * Method to set the value of field sm_id
     *
     * @param integer $sm_id
     * @return $this
     */
    public function setSmId($sm_id)
    {
        $this->sm_id = $sm_id;

        return $this;
    }

    /**
     * Method to set the value of field seller_id
     *
     * @param integer $seller_id
     * @return $this
     */
    public function setSellerId($seller_id)
    {
        $this->seller_id = $seller_id;

        return $this;
    }

    /**
     * Method to set the value of field read_time
     *
     * @param integer $read_time
     * @return $this
     */
    public function setReadTime($read_time)
    {
        $this->read_time = $read_time;

        return $this;
    }

    /**
     * Returns the value of field sm_id
     *
     * @return integer
     */
    public function getSmId()
    {
        return $this->sm_id;
    }

    /**
     * Returns the value of field seller_id
     *
     * @return integer
     */
    public function getSellerId()
    {
        return $this->seller_id;
    }

    /**
     * Returns the value of field read_time
     *
     * @return integer
     */
    public function getReadTime()
    {
        return $this->read_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_msg_read';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMsgRead[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMsgRead
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
