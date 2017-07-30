<?php

namespace Ypk\Models;

class SellerLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $log_id;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $log_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $log_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $log_seller_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $log_seller_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $log_store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $log_seller_ip;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $log_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $log_state;

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
     * Method to set the value of field log_content
     *
     * @param string $log_content
     * @return $this
     */
    public function setLogContent($log_content)
    {
        $this->log_content = $log_content;

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
     * Method to set the value of field log_seller_id
     *
     * @param integer $log_seller_id
     * @return $this
     */
    public function setLogSellerId($log_seller_id)
    {
        $this->log_seller_id = $log_seller_id;

        return $this;
    }

    /**
     * Method to set the value of field log_seller_name
     *
     * @param string $log_seller_name
     * @return $this
     */
    public function setLogSellerName($log_seller_name)
    {
        $this->log_seller_name = $log_seller_name;

        return $this;
    }

    /**
     * Method to set the value of field log_store_id
     *
     * @param integer $log_store_id
     * @return $this
     */
    public function setLogStoreId($log_store_id)
    {
        $this->log_store_id = $log_store_id;

        return $this;
    }

    /**
     * Method to set the value of field log_seller_ip
     *
     * @param string $log_seller_ip
     * @return $this
     */
    public function setLogSellerIp($log_seller_ip)
    {
        $this->log_seller_ip = $log_seller_ip;

        return $this;
    }

    /**
     * Method to set the value of field log_url
     *
     * @param string $log_url
     * @return $this
     */
    public function setLogUrl($log_url)
    {
        $this->log_url = $log_url;

        return $this;
    }

    /**
     * Method to set the value of field log_state
     *
     * @param integer $log_state
     * @return $this
     */
    public function setLogState($log_state)
    {
        $this->log_state = $log_state;

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
     * Returns the value of field log_content
     *
     * @return string
     */
    public function getLogContent()
    {
        return $this->log_content;
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
     * Returns the value of field log_seller_id
     *
     * @return integer
     */
    public function getLogSellerId()
    {
        return $this->log_seller_id;
    }

    /**
     * Returns the value of field log_seller_name
     *
     * @return string
     */
    public function getLogSellerName()
    {
        return $this->log_seller_name;
    }

    /**
     * Returns the value of field log_store_id
     *
     * @return integer
     */
    public function getLogStoreId()
    {
        return $this->log_store_id;
    }

    /**
     * Returns the value of field log_seller_ip
     *
     * @return string
     */
    public function getLogSellerIp()
    {
        return $this->log_seller_ip;
    }

    /**
     * Returns the value of field log_url
     *
     * @return string
     */
    public function getLogUrl()
    {
        return $this->log_url;
    }

    /**
     * Returns the value of field log_state
     *
     * @return integer
     */
    public function getLogState()
    {
        return $this->log_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'seller_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SellerLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SellerLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
