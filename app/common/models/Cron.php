<?php

namespace Ypk\Models;

class Cron extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $exeid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $exetime;

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
     * Method to set the value of field type
     *
     * @param integer $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Method to set the value of field exeid
     *
     * @param integer $exeid
     * @return $this
     */
    public function setExeid($exeid)
    {
        $this->exeid = $exeid;

        return $this;
    }

    /**
     * Method to set the value of field exetime
     *
     * @param integer $exetime
     * @return $this
     */
    public function setExetime($exetime)
    {
        $this->exetime = $exetime;

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
     * Returns the value of field type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the value of field exeid
     *
     * @return integer
     */
    public function getExeid()
    {
        return $this->exeid;
    }

    /**
     * Returns the value of field exetime
     *
     * @return integer
     */
    public function getExetime()
    {
        return $this->exetime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cron';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cron[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cron
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
