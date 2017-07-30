<?php

namespace Ypk\Models;

class GroupbuyClass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $class_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $class_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $class_parent_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $deep;

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
     * Method to set the value of field class_parent_id
     *
     * @param integer $class_parent_id
     * @return $this
     */
    public function setClassParentId($class_parent_id)
    {
        $this->class_parent_id = $class_parent_id;

        return $this;
    }

    /**
     * Method to set the value of field sort
     *
     * @param integer $sort
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Method to set the value of field deep
     *
     * @param integer $deep
     * @return $this
     */
    public function setDeep($deep)
    {
        $this->deep = $deep;

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
     * Returns the value of field class_parent_id
     *
     * @return integer
     */
    public function getClassParentId()
    {
        return $this->class_parent_id;
    }

    /**
     * Returns the value of field sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Returns the value of field deep
     *
     * @return integer
     */
    public function getDeep()
    {
        return $this->deep;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'groupbuy_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GroupbuyClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GroupbuyClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
