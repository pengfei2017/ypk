<?php

namespace Ypk\Models;

class VrGroupbuyClass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $class_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $class_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $parent_class_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $class_sort;

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
     * Method to set the value of field parent_class_id
     *
     * @param integer $parent_class_id
     * @return $this
     */
    public function setParentClassId($parent_class_id)
    {
        $this->parent_class_id = $parent_class_id;

        return $this;
    }

    /**
     * Method to set the value of field class_sort
     *
     * @param integer $class_sort
     * @return $this
     */
    public function setClassSort($class_sort)
    {
        $this->class_sort = $class_sort;

        return $this;
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
     * Returns the value of field parent_class_id
     *
     * @return integer
     */
    public function getParentClassId()
    {
        return $this->parent_class_id;
    }

    /**
     * Returns the value of field class_sort
     *
     * @return integer
     */
    public function getClassSort()
    {
        return $this->class_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vr_groupbuy_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrGroupbuyClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrGroupbuyClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
