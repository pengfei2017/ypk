<?php

namespace Ypk\Models;

class Express extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $e_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $e_state;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $e_code;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $e_letter;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $e_order;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $e_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $e_zt_state;

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
     * Method to set the value of field e_name
     *
     * @param string $e_name
     * @return $this
     */
    public function setEName($e_name)
    {
        $this->e_name = $e_name;

        return $this;
    }

    /**
     * Method to set the value of field e_state
     *
     * @param string $e_state
     * @return $this
     */
    public function setEState($e_state)
    {
        $this->e_state = $e_state;

        return $this;
    }

    /**
     * Method to set the value of field e_code
     *
     * @param string $e_code
     * @return $this
     */
    public function setECode($e_code)
    {
        $this->e_code = $e_code;

        return $this;
    }

    /**
     * Method to set the value of field e_letter
     *
     * @param string $e_letter
     * @return $this
     */
    public function setELetter($e_letter)
    {
        $this->e_letter = $e_letter;

        return $this;
    }

    /**
     * Method to set the value of field e_order
     *
     * @param string $e_order
     * @return $this
     */
    public function setEOrder($e_order)
    {
        $this->e_order = $e_order;

        return $this;
    }

    /**
     * Method to set the value of field e_url
     *
     * @param string $e_url
     * @return $this
     */
    public function setEUrl($e_url)
    {
        $this->e_url = $e_url;

        return $this;
    }

    /**
     * Method to set the value of field e_zt_state
     *
     * @param integer $e_zt_state
     * @return $this
     */
    public function setEZtState($e_zt_state)
    {
        $this->e_zt_state = $e_zt_state;

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
     * Returns the value of field e_name
     *
     * @return string
     */
    public function getEName()
    {
        return $this->e_name;
    }

    /**
     * Returns the value of field e_state
     *
     * @return string
     */
    public function getEState()
    {
        return $this->e_state;
    }

    /**
     * Returns the value of field e_code
     *
     * @return string
     */
    public function getECode()
    {
        return $this->e_code;
    }

    /**
     * Returns the value of field e_letter
     *
     * @return string
     */
    public function getELetter()
    {
        return $this->e_letter;
    }

    /**
     * Returns the value of field e_order
     *
     * @return string
     */
    public function getEOrder()
    {
        return $this->e_order;
    }

    /**
     * Returns the value of field e_url
     *
     * @return string
     */
    public function getEUrl()
    {
        return $this->e_url;
    }

    /**
     * Returns the value of field e_zt_state
     *
     * @return integer
     */
    public function getEZtState()
    {
        return $this->e_zt_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'express';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Express[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Express
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
