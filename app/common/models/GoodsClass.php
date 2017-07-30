<?php

namespace Ypk\Models;

class GoodsClass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $gc_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $type_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_parent_id;

    /**
     *
     * @var double
     * @Column(type="double", nullable=false)
     */
    protected $commis_rate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $gc_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $gc_virtual;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $gc_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $gc_keywords;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $gc_description;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $show_type;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $buy_points_rate;

    /**
     * Method to set the value of field gc_id
     *
     * @param integer $gc_id
     * @return $this
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

        return $this;
    }

    /**
     * Method to set the value of field gc_name
     *
     * @param string $gc_name
     * @return $this
     */
    public function setGcName($gc_name)
    {
        $this->gc_name = $gc_name;

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
     * Method to set the value of field gc_parent_id
     *
     * @param integer $gc_parent_id
     * @return $this
     */
    public function setGcParentId($gc_parent_id)
    {
        $this->gc_parent_id = $gc_parent_id;

        return $this;
    }

    /**
     * Method to set the value of field commis_rate
     *
     * @param double $commis_rate
     * @return $this
     */
    public function setCommisRate($commis_rate)
    {
        $this->commis_rate = $commis_rate;

        return $this;
    }

    /**
     * Method to set the value of field gc_sort
     *
     * @param integer $gc_sort
     * @return $this
     */
    public function setGcSort($gc_sort)
    {
        $this->gc_sort = $gc_sort;

        return $this;
    }

    /**
     * Method to set the value of field gc_virtual
     *
     * @param integer $gc_virtual
     * @return $this
     */
    public function setGcVirtual($gc_virtual)
    {
        $this->gc_virtual = $gc_virtual;

        return $this;
    }

    /**
     * Method to set the value of field gc_title
     *
     * @param string $gc_title
     * @return $this
     */
    public function setGcTitle($gc_title)
    {
        $this->gc_title = $gc_title;

        return $this;
    }

    /**
     * Method to set the value of field gc_keywords
     *
     * @param string $gc_keywords
     * @return $this
     */
    public function setGcKeywords($gc_keywords)
    {
        $this->gc_keywords = $gc_keywords;

        return $this;
    }

    /**
     * Method to set the value of field gc_description
     *
     * @param string $gc_description
     * @return $this
     */
    public function setGcDescription($gc_description)
    {
        $this->gc_description = $gc_description;

        return $this;
    }

    /**
     * Method to set the value of field show_type
     *
     * @param integer $show_type
     * @return $this
     */
    public function setShowType($show_type)
    {
        $this->show_type = $show_type;

        return $this;
    }

    /**
     * Method to set the value of field buy_points_rate
     *
     * @param double $buy_points_rate
     * @return $this
     */
    public function setBuyPointsRate($buy_points_rate)
    {
        $this->buy_points_rate = $buy_points_rate;

        return $this;
    }

    /**
     * Returns the value of field gc_id
     *
     * @return integer
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Returns the value of field gc_name
     *
     * @return string
     */
    public function getGcName()
    {
        return $this->gc_name;
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
     * Returns the value of field gc_parent_id
     *
     * @return integer
     */
    public function getGcParentId()
    {
        return $this->gc_parent_id;
    }

    /**
     * Returns the value of field commis_rate
     *
     * @return double
     */
    public function getCommisRate()
    {
        return $this->commis_rate;
    }

    /**
     * Returns the value of field gc_sort
     *
     * @return integer
     */
    public function getGcSort()
    {
        return $this->gc_sort;
    }

    /**
     * Returns the value of field gc_virtual
     *
     * @return integer
     */
    public function getGcVirtual()
    {
        return $this->gc_virtual;
    }

    /**
     * Returns the value of field gc_title
     *
     * @return string
     */
    public function getGcTitle()
    {
        return $this->gc_title;
    }

    /**
     * Returns the value of field gc_keywords
     *
     * @return string
     */
    public function getGcKeywords()
    {
        return $this->gc_keywords;
    }

    /**
     * Returns the value of field gc_description
     *
     * @return string
     */
    public function getGcDescription()
    {
        return $this->gc_description;
    }

    /**
     * Returns the value of field show_type
     *
     * @return integer
     */
    public function getShowType()
    {
        return $this->show_type;
    }

    /**
     * Returns the value of field buy_points_rate
     *
     * @return double
     */
    public function getBuyPointsRate()
    {
        return $this->buy_points_rate;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
