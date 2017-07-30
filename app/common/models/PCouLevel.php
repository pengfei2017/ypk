<?php

namespace Ypk\Models;

class PCouLevel extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cou_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $xlevel;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $mincost;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $maxcou;

    /**
     * Method to set the value of field cou_id
     *
     * @param integer $cou_id
     * @return $this
     */
    public function setCouId($cou_id)
    {
        $this->cou_id = $cou_id;

        return $this;
    }

    /**
     * Method to set the value of field xlevel
     *
     * @param integer $xlevel
     * @return $this
     */
    public function setXlevel($xlevel)
    {
        $this->xlevel = $xlevel;

        return $this;
    }

    /**
     * Method to set the value of field mincost
     *
     * @param double $mincost
     * @return $this
     */
    public function setMincost($mincost)
    {
        $this->mincost = $mincost;

        return $this;
    }

    /**
     * Method to set the value of field maxcou
     *
     * @param integer $maxcou
     * @return $this
     */
    public function setMaxcou($maxcou)
    {
        $this->maxcou = $maxcou;

        return $this;
    }

    /**
     * Returns the value of field cou_id
     *
     * @return integer
     */
    public function getCouId()
    {
        return $this->cou_id;
    }

    /**
     * Returns the value of field xlevel
     *
     * @return integer
     */
    public function getXlevel()
    {
        return $this->xlevel;
    }

    /**
     * Returns the value of field mincost
     *
     * @return double
     */
    public function getMincost()
    {
        return $this->mincost;
    }

    /**
     * Returns the value of field maxcou
     *
     * @return integer
     */
    public function getMaxcou()
    {
        return $this->maxcou;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_cou_level';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PCouLevel[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PCouLevel
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
