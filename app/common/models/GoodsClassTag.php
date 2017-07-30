<?php

namespace Ypk\Models;

class GoodsClassTag extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_tag_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_3;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $gc_tag_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $gc_tag_value;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     * Method to set the value of field gc_tag_id
     *
     * @param integer $gc_tag_id
     * @return $this
     */
    public function setGcTagId($gc_tag_id)
    {
        $this->gc_tag_id = $gc_tag_id;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_1
     *
     * @param integer $gc_id_1
     * @return $this
     */
    public function setGcId1($gc_id_1)
    {
        $this->gc_id_1 = $gc_id_1;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_2
     *
     * @param integer $gc_id_2
     * @return $this
     */
    public function setGcId2($gc_id_2)
    {
        $this->gc_id_2 = $gc_id_2;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_3
     *
     * @param integer $gc_id_3
     * @return $this
     */
    public function setGcId3($gc_id_3)
    {
        $this->gc_id_3 = $gc_id_3;

        return $this;
    }

    /**
     * Method to set the value of field gc_tag_name
     *
     * @param string $gc_tag_name
     * @return $this
     */
    public function setGcTagName($gc_tag_name)
    {
        $this->gc_tag_name = $gc_tag_name;

        return $this;
    }

    /**
     * Method to set the value of field gc_tag_value
     *
     * @param string $gc_tag_value
     * @return $this
     */
    public function setGcTagValue($gc_tag_value)
    {
        $this->gc_tag_value = $gc_tag_value;

        return $this;
    }

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
     * Returns the value of field gc_tag_id
     *
     * @return integer
     */
    public function getGcTagId()
    {
        return $this->gc_tag_id;
    }

    /**
     * Returns the value of field gc_id_1
     *
     * @return integer
     */
    public function getGcId1()
    {
        return $this->gc_id_1;
    }

    /**
     * Returns the value of field gc_id_2
     *
     * @return integer
     */
    public function getGcId2()
    {
        return $this->gc_id_2;
    }

    /**
     * Returns the value of field gc_id_3
     *
     * @return integer
     */
    public function getGcId3()
    {
        return $this->gc_id_3;
    }

    /**
     * Returns the value of field gc_tag_name
     *
     * @return string
     */
    public function getGcTagName()
    {
        return $this->gc_tag_name;
    }

    /**
     * Returns the value of field gc_tag_value
     *
     * @return string
     */
    public function getGcTagValue()
    {
        return $this->gc_tag_value;
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
     * Returns the value of field type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_class_tag';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsClassTag[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsClassTag
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
