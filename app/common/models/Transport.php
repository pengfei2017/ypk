<?php

namespace Ypk\Models;

class Transport extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=false)
     */
    protected $title;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=true)
     */
    protected $send_tpl_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $update_time;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field send_tpl_id
     *
     * @param integer $send_tpl_id
     * @return $this
     */
    public function setSendTplId($send_tpl_id)
    {
        $this->send_tpl_id = $send_tpl_id;

        return $this;
    }

    /**
     * Method to set the value of field store_id
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

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
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field send_tpl_id
     *
     * @return integer
     */
    public function getSendTplId()
    {
        return $this->send_tpl_id;
    }

    /**
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
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
        return 'transport';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Transport[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Transport
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
