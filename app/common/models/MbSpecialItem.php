<?php

namespace Ypk\Models;

class MbSpecialItem extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $item_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $special_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $item_type;

    /**
     *
     * @var string
     * @Column(type="string", length=2000, nullable=true)
     */
    protected $item_data;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $item_usable;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $item_sort;

    /**
     * Method to set the value of field item_id
     *
     * @param integer $item_id
     * @return $this
     */
    public function setItemId($item_id)
    {
        $this->item_id = $item_id;

        return $this;
    }

    /**
     * Method to set the value of field special_id
     *
     * @param integer $special_id
     * @return $this
     */
    public function setSpecialId($special_id)
    {
        $this->special_id = $special_id;

        return $this;
    }

    /**
     * Method to set the value of field item_type
     *
     * @param string $item_type
     * @return $this
     */
    public function setItemType($item_type)
    {
        $this->item_type = $item_type;

        return $this;
    }

    /**
     * Method to set the value of field item_data
     *
     * @param string $item_data
     * @return $this
     */
    public function setItemData($item_data)
    {
        $this->item_data = $item_data;

        return $this;
    }

    /**
     * Method to set the value of field item_usable
     *
     * @param integer $item_usable
     * @return $this
     */
    public function setItemUsable($item_usable)
    {
        $this->item_usable = $item_usable;

        return $this;
    }

    /**
     * Method to set the value of field item_sort
     *
     * @param integer $item_sort
     * @return $this
     */
    public function setItemSort($item_sort)
    {
        $this->item_sort = $item_sort;

        return $this;
    }

    /**
     * Returns the value of field item_id
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Returns the value of field special_id
     *
     * @return integer
     */
    public function getSpecialId()
    {
        return $this->special_id;
    }

    /**
     * Returns the value of field item_type
     *
     * @return string
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * Returns the value of field item_data
     *
     * @return string
     */
    public function getItemData()
    {
        return $this->item_data;
    }

    /**
     * Returns the value of field item_usable
     *
     * @return integer
     */
    public function getItemUsable()
    {
        return $this->item_usable;
    }

    /**
     * Returns the value of field item_sort
     *
     * @return integer
     */
    public function getItemSort()
    {
        return $this->item_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mb_special_item';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbSpecialItem[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbSpecialItem
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
