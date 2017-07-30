<?php

namespace Ypk\Models;

class ContractItem extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cti_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $cti_name;

    /**
     *
     * @var string
     * @Column(type="string", length=2000, nullable=false)
     */
    protected $cti_describe;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $cti_cost;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $cti_icon;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $cti_descurl;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $cti_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $cti_sort;

    /**
     * Method to set the value of field cti_id
     *
     * @param integer $cti_id
     * @return $this
     */
    public function setCtiId($cti_id)
    {
        $this->cti_id = $cti_id;

        return $this;
    }

    /**
     * Method to set the value of field cti_name
     *
     * @param string $cti_name
     * @return $this
     */
    public function setCtiName($cti_name)
    {
        $this->cti_name = $cti_name;

        return $this;
    }

    /**
     * Method to set the value of field cti_describe
     *
     * @param string $cti_describe
     * @return $this
     */
    public function setCtiDescribe($cti_describe)
    {
        $this->cti_describe = $cti_describe;

        return $this;
    }

    /**
     * Method to set the value of field cti_cost
     *
     * @param double $cti_cost
     * @return $this
     */
    public function setCtiCost($cti_cost)
    {
        $this->cti_cost = $cti_cost;

        return $this;
    }

    /**
     * Method to set the value of field cti_icon
     *
     * @param string $cti_icon
     * @return $this
     */
    public function setCtiIcon($cti_icon)
    {
        $this->cti_icon = $cti_icon;

        return $this;
    }

    /**
     * Method to set the value of field cti_descurl
     *
     * @param string $cti_descurl
     * @return $this
     */
    public function setCtiDescurl($cti_descurl)
    {
        $this->cti_descurl = $cti_descurl;

        return $this;
    }

    /**
     * Method to set the value of field cti_state
     *
     * @param integer $cti_state
     * @return $this
     */
    public function setCtiState($cti_state)
    {
        $this->cti_state = $cti_state;

        return $this;
    }

    /**
     * Method to set the value of field cti_sort
     *
     * @param integer $cti_sort
     * @return $this
     */
    public function setCtiSort($cti_sort)
    {
        $this->cti_sort = $cti_sort;

        return $this;
    }

    /**
     * Returns the value of field cti_id
     *
     * @return integer
     */
    public function getCtiId()
    {
        return $this->cti_id;
    }

    /**
     * Returns the value of field cti_name
     *
     * @return string
     */
    public function getCtiName()
    {
        return $this->cti_name;
    }

    /**
     * Returns the value of field cti_describe
     *
     * @return string
     */
    public function getCtiDescribe()
    {
        return $this->cti_describe;
    }

    /**
     * Returns the value of field cti_cost
     *
     * @return double
     */
    public function getCtiCost()
    {
        return $this->cti_cost;
    }

    /**
     * Returns the value of field cti_icon
     *
     * @return string
     */
    public function getCtiIcon()
    {
        return $this->cti_icon;
    }

    /**
     * Returns the value of field cti_descurl
     *
     * @return string
     */
    public function getCtiDescurl()
    {
        return $this->cti_descurl;
    }

    /**
     * Returns the value of field cti_state
     *
     * @return integer
     */
    public function getCtiState()
    {
        return $this->cti_state;
    }

    /**
     * Returns the value of field cti_sort
     *
     * @return integer
     */
    public function getCtiSort()
    {
        return $this->cti_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'contract_item';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractItem[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractItem
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
