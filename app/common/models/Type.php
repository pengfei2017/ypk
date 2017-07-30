<?php

namespace Ypk\Models;

class Type extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $type_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $type_sort;

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
     * Method to set the value of field type_id
     *
     * @param integer $type_id
     * @return $this
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * Method to set the value of field type_name
     *
     * @param string $type_name
     * @return $this
     */
    public function setTypeName($type_name)
    {
        $this->type_name = $type_name;

        return $this;
    }

    /**
     * Method to set the value of field type_sort
     *
     * @param integer $type_sort
     * @return $this
     */
    public function setTypeSort($type_sort)
    {
        $this->type_sort = $type_sort;

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
     * Returns the value of field type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Returns the value of field type_name
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->type_name;
    }

    /**
     * Returns the value of field type_sort
     *
     * @return integer
     */
    public function getTypeSort()
    {
        return $this->type_sort;
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
        return 'type';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Type[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Type
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
