<?php

namespace Ypk\Models;

class Apiseccode extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sec_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $sec_key;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $sec_val;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sec_addtime;

    /**
     * Method to set the value of field sec_id
     *
     * @param integer $sec_id
     * @return $this
     */
    public function setSecId($sec_id)
    {
        $this->sec_id = $sec_id;

        return $this;
    }

    /**
     * Method to set the value of field sec_key
     *
     * @param string $sec_key
     * @return $this
     */
    public function setSecKey($sec_key)
    {
        $this->sec_key = $sec_key;

        return $this;
    }

    /**
     * Method to set the value of field sec_val
     *
     * @param string $sec_val
     * @return $this
     */
    public function setSecVal($sec_val)
    {
        $this->sec_val = $sec_val;

        return $this;
    }

    /**
     * Method to set the value of field sec_addtime
     *
     * @param integer $sec_addtime
     * @return $this
     */
    public function setSecAddtime($sec_addtime)
    {
        $this->sec_addtime = $sec_addtime;

        return $this;
    }

    /**
     * Returns the value of field sec_id
     *
     * @return integer
     */
    public function getSecId()
    {
        return $this->sec_id;
    }

    /**
     * Returns the value of field sec_key
     *
     * @return string
     */
    public function getSecKey()
    {
        return $this->sec_key;
    }

    /**
     * Returns the value of field sec_val
     *
     * @return string
     */
    public function getSecVal()
    {
        return $this->sec_val;
    }

    /**
     * Returns the value of field sec_addtime
     *
     * @return integer
     */
    public function getSecAddtime()
    {
        return $this->sec_addtime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'apiseccode';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Apiseccode[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Apiseccode
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
