<?php

namespace Ypk\Models;

class CircleClass extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $class_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $class_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $class_status;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_recommend;

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
     * Method to set the value of field class_addtime
     *
     * @param string $class_addtime
     * @return $this
     */
    public function setClassAddtime($class_addtime)
    {
        $this->class_addtime = $class_addtime;

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
     * Method to set the value of field class_status
     *
     * @param integer $class_status
     * @return $this
     */
    public function setClassStatus($class_status)
    {
        $this->class_status = $class_status;

        return $this;
    }

    /**
     * Method to set the value of field is_recommend
     *
     * @param integer $is_recommend
     * @return $this
     */
    public function setIsRecommend($is_recommend)
    {
        $this->is_recommend = $is_recommend;

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
     * Returns the value of field class_addtime
     *
     * @return string
     */
    public function getClassAddtime()
    {
        return $this->class_addtime;
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
     * Returns the value of field class_status
     *
     * @return integer
     */
    public function getClassStatus()
    {
        return $this->class_status;
    }

    /**
     * Returns the value of field is_recommend
     *
     * @return integer
     */
    public function getIsRecommend()
    {
        return $this->is_recommend;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
