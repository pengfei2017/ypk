<?php

namespace Ypk\Models;

class PCouSku extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sku_id;

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
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $tstart;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $tend;

    /**
     * Method to set the value of field sku_id
     *
     * @param integer $sku_id
     * @return $this
     */
    public function setSkuId($sku_id)
    {
        $this->sku_id = $sku_id;

        return $this;
    }

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
     * Method to set the value of field tstart
     *
     * @param integer $tstart
     * @return $this
     */
    public function setTstart($tstart)
    {
        $this->tstart = $tstart;

        return $this;
    }

    /**
     * Method to set the value of field tend
     *
     * @param integer $tend
     * @return $this
     */
    public function setTend($tend)
    {
        $this->tend = $tend;

        return $this;
    }

    /**
     * Returns the value of field sku_id
     *
     * @return integer
     */
    public function getSkuId()
    {
        return $this->sku_id;
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
     * Returns the value of field tstart
     *
     * @return integer
     */
    public function getTstart()
    {
        return $this->tstart;
    }

    /**
     * Returns the value of field tend
     *
     * @return integer
     */
    public function getTend()
    {
        return $this->tend;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_cou_sku';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PCouSku[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PCouSku
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
