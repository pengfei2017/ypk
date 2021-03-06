<?php

namespace Ypk\Models;

class AttributeValue extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $attr_value_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $attr_value_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $attr_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $attr_value_sort;

    /**
     * Method to set the value of field attr_value_id
     *
     * @param integer $attr_value_id
     * @return $this
     */
    public function setAttrValueId($attr_value_id)
    {
        $this->attr_value_id = $attr_value_id;

        return $this;
    }

    /**
     * Method to set the value of field attr_value_name
     *
     * @param string $attr_value_name
     * @return $this
     */
    public function setAttrValueName($attr_value_name)
    {
        $this->attr_value_name = $attr_value_name;

        return $this;
    }

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
     * Method to set the value of field attr_value_sort
     *
     * @param integer $attr_value_sort
     * @return $this
     */
    public function setAttrValueSort($attr_value_sort)
    {
        $this->attr_value_sort = $attr_value_sort;

        return $this;
    }

    /**
     * Returns the value of field attr_value_id
     *
     * @return integer
     */
    public function getAttrValueId()
    {
        return $this->attr_value_id;
    }

    /**
     * Returns the value of field attr_value_name
     *
     * @return string
     */
    public function getAttrValueName()
    {
        return $this->attr_value_name;
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
     * Returns the value of field type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Returns the value of field attr_value_sort
     *
     * @return integer
     */
    public function getAttrValueSort()
    {
        return $this->attr_value_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'attribute_value';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AttributeValue[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AttributeValue
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
