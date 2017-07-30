<?php

namespace Ypk\Models;

class GroupbuyPriceRange extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $range_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $range_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $range_start;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $range_end;

    /**
     * Method to set the value of field range_id
     *
     * @param integer $range_id
     * @return $this
     */
    public function setRangeId($range_id)
    {
        $this->range_id = $range_id;

        return $this;
    }

    /**
     * Method to set the value of field range_name
     *
     * @param string $range_name
     * @return $this
     */
    public function setRangeName($range_name)
    {
        $this->range_name = $range_name;

        return $this;
    }

    /**
     * Method to set the value of field range_start
     *
     * @param integer $range_start
     * @return $this
     */
    public function setRangeStart($range_start)
    {
        $this->range_start = $range_start;

        return $this;
    }

    /**
     * Method to set the value of field range_end
     *
     * @param integer $range_end
     * @return $this
     */
    public function setRangeEnd($range_end)
    {
        $this->range_end = $range_end;

        return $this;
    }

    /**
     * Returns the value of field range_id
     *
     * @return integer
     */
    public function getRangeId()
    {
        return $this->range_id;
    }

    /**
     * Returns the value of field range_name
     *
     * @return string
     */
    public function getRangeName()
    {
        return $this->range_name;
    }

    /**
     * Returns the value of field range_start
     *
     * @return integer
     */
    public function getRangeStart()
    {
        return $this->range_start;
    }

    /**
     * Returns the value of field range_end
     *
     * @return integer
     */
    public function getRangeEnd()
    {
        return $this->range_end;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'groupbuy_price_range';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GroupbuyPriceRange[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GroupbuyPriceRange
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
