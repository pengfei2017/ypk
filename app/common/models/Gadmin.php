<?php

namespace Ypk\Models;

class Gadmin extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $gid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $gname;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $limits;

    /**
     * Method to set the value of field gid
     *
     * @param integer $gid
     * @return $this
     */
    public function setGid($gid)
    {
        $this->gid = $gid;

        return $this;
    }

    /**
     * Method to set the value of field gname
     *
     * @param string $gname
     * @return $this
     */
    public function setGname($gname)
    {
        $this->gname = $gname;

        return $this;
    }

    /**
     * Method to set the value of field limits
     *
     * @param string $limits
     * @return $this
     */
    public function setLimits($limits)
    {
        $this->limits = $limits;

        return $this;
    }

    /**
     * Returns the value of field gid
     *
     * @return integer
     */
    public function getGid()
    {
        return $this->gid;
    }

    /**
     * Returns the value of field gname
     *
     * @return string
     */
    public function getGname()
    {
        return $this->gname;
    }

    /**
     * Returns the value of field limits
     *
     * @return string
     */
    public function getLimits()
    {
        return $this->limits;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'gadmin';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Gadmin[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Gadmin
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
