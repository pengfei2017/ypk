<?php

namespace Ypk\Models;

class Area extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $area_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $area_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $area_parent_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $area_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $area_deep;

    /**
     *
     * @var string
     * @Column(type="string", length=3, nullable=true)
     */
    protected $area_region;

    /**
     * Method to set the value of field area_id
     *
     * @param integer $area_id
     * @return $this
     */
    public function setAreaId($area_id)
    {
        $this->area_id = $area_id;

        return $this;
    }

    /**
     * Method to set the value of field area_name
     *
     * @param string $area_name
     * @return $this
     */
    public function setAreaName($area_name)
    {
        $this->area_name = $area_name;

        return $this;
    }

    /**
     * Method to set the value of field area_parent_id
     *
     * @param integer $area_parent_id
     * @return $this
     */
    public function setAreaParentId($area_parent_id)
    {
        $this->area_parent_id = $area_parent_id;

        return $this;
    }

    /**
     * Method to set the value of field area_sort
     *
     * @param integer $area_sort
     * @return $this
     */
    public function setAreaSort($area_sort)
    {
        $this->area_sort = $area_sort;

        return $this;
    }

    /**
     * Method to set the value of field area_deep
     *
     * @param integer $area_deep
     * @return $this
     */
    public function setAreaDeep($area_deep)
    {
        $this->area_deep = $area_deep;

        return $this;
    }

    /**
     * Method to set the value of field area_region
     *
     * @param string $area_region
     * @return $this
     */
    public function setAreaRegion($area_region)
    {
        $this->area_region = $area_region;

        return $this;
    }

    /**
     * Returns the value of field area_id
     *
     * @return integer
     */
    public function getAreaId()
    {
        return $this->area_id;
    }

    /**
     * Returns the value of field area_name
     *
     * @return string
     */
    public function getAreaName()
    {
        return $this->area_name;
    }

    /**
     * Returns the value of field area_parent_id
     *
     * @return integer
     */
    public function getAreaParentId()
    {
        return $this->area_parent_id;
    }

    /**
     * Returns the value of field area_sort
     *
     * @return integer
     */
    public function getAreaSort()
    {
        return $this->area_sort;
    }

    /**
     * Returns the value of field area_deep
     *
     * @return integer
     */
    public function getAreaDeep()
    {
        return $this->area_deep;
    }

    /**
     * Returns the value of field area_region
     *
     * @return string
     */
    public function getAreaRegion()
    {
        return $this->area_region;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'area';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Area[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Area
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
