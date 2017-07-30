<?php

namespace Ypk\Models;

class MicroPersonalClass extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=50, nullable=false)
     */
    protected $class_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $class_sort;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $class_image;

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
     * Method to set the value of field class_image
     *
     * @param string $class_image
     * @return $this
     */
    public function setClassImage($class_image)
    {
        $this->class_image = $class_image;

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
     * Returns the value of field class_sort
     *
     * @return integer
     */
    public function getClassSort()
    {
        return $this->class_sort;
    }

    /**
     * Returns the value of field class_image
     *
     * @return string
     */
    public function getClassImage()
    {
        return $this->class_image;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'micro_personal_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroPersonalClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroPersonalClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
