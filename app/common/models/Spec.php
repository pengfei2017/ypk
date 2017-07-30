<?php

namespace Ypk\Models;

class Spec extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sp_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $sp_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $sp_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $class_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $class_name;

    /**
     * Method to set the value of field sp_id
     *
     * @param integer $sp_id
     * @return $this
     */
    public function setSpId($sp_id)
    {
        $this->sp_id = $sp_id;

        return $this;
    }

    /**
     * Method to set the value of field sp_name
     *
     * @param string $sp_name
     * @return $this
     */
    public function setSpName($sp_name)
    {
        $this->sp_name = $sp_name;

        return $this;
    }

    /**
     * Method to set the value of field sp_sort
     *
     * @param integer $sp_sort
     * @return $this
     */
    public function setSpSort($sp_sort)
    {
        $this->sp_sort = $sp_sort;

        return $this;
    }

    /**
     * Method to set the value of field class_id
     *
     * @param integer $class_id
     * @return $this
     */
    public function setClassId($class_id)
    {
        $this->class_id = $class_id;

        return $this;
    }

    /**
     * Method to set the value of field class_name
     *
     * @param string $class_name
     * @return $this
     */
    public function setClassName($class_name)
    {
        $this->class_name = $class_name;

        return $this;
    }

    /**
     * Returns the value of field sp_id
     *
     * @return integer
     */
    public function getSpId()
    {
        return $this->sp_id;
    }

    /**
     * Returns the value of field sp_name
     *
     * @return string
     */
    public function getSpName()
    {
        return $this->sp_name;
    }

    /**
     * Returns the value of field sp_sort
     *
     * @return integer
     */
    public function getSpSort()
    {
        return $this->sp_sort;
    }

    /**
     * Returns the value of field class_id
     *
     * @return integer
     */
    public function getClassId()
    {
        return $this->class_id;
    }

    /**
     * Returns the value of field class_name
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->class_name;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'spec';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Spec[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Spec
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
