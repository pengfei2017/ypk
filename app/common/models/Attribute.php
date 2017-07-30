<?php

namespace Ypk\Models;

class Attribute extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $attr_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $attr_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $attr_value;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $attr_show;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $attr_sort;

    /**
     * Method to set the value of field attr_id
     *
     * @param integer $attr_id
     * @return $this
     */
    public function setAttrId($attr_id)
    {
        $this->attr_id = $attr_id;

        return $this;
    }

    /**
     * Method to set the value of field attr_name
     *
     * @param string $attr_name
     * @return $this
     */
    public function setAttrName($attr_name)
    {
        $this->attr_name = $attr_name;

        return $this;
    }

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
     * Method to set the value of field attr_value
     *
     * @param string $attr_value
     * @return $this
     */
    public function setAttrValue($attr_value)
    {
        $this->attr_value = $attr_value;

        return $this;
    }

    /**
     * Method to set the value of field attr_show
     *
     * @param integer $attr_show
     * @return $this
     */
    public function setAttrShow($attr_show)
    {
        $this->attr_show = $attr_show;

        return $this;
    }

    /**
     * Method to set the value of field attr_sort
     *
     * @param integer $attr_sort
     * @return $this
     */
    public function setAttrSort($attr_sort)
    {
        $this->attr_sort = $attr_sort;

        return $this;
    }

    /**
     * Returns the value of field attr_id
     *
     * @return integer
     */
    public function getAttrId()
    {
        return $this->attr_id;
    }

    /**
     * Returns the value of field attr_name
     *
     * @return string
     */
    public function getAttrName()
    {
        return $this->attr_name;
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
     * Returns the value of field attr_value
     *
     * @return string
     */
    public function getAttrValue()
    {
        return $this->attr_value;
    }

    /**
     * Returns the value of field attr_show
     *
     * @return integer
     */
    public function getAttrShow()
    {
        return $this->attr_show;
    }

    /**
     * Returns the value of field attr_sort
     *
     * @return integer
     */
    public function getAttrSort()
    {
        return $this->attr_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'attribute';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Attribute[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Attribute
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
