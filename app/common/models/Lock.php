<?php

namespace Ypk\Models;

class Lock extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=20, nullable=false)
     */
    protected $pid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $pvalue;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $expiretime;

    /**
     * Method to set the value of field pid
     *
     * @param string $pid
     * @return $this
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Method to set the value of field pvalue
     *
     * @param integer $pvalue
     * @return $this
     */
    public function setPvalue($pvalue)
    {
        $this->pvalue = $pvalue;

        return $this;
    }

    /**
     * Method to set the value of field expiretime
     *
     * @param integer $expiretime
     * @return $this
     */
    public function setExpiretime($expiretime)
    {
        $this->expiretime = $expiretime;

        return $this;
    }

    /**
     * Returns the value of field pid
     *
     * @return string
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Returns the value of field pvalue
     *
     * @return integer
     */
    public function getPvalue()
    {
        return $this->pvalue;
    }

    /**
     * Returns the value of field expiretime
     *
     * @return integer
     */
    public function getExpiretime()
    {
        return $this->expiretime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'lock';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Lock[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Lock
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
