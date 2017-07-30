<?php

namespace Ypk\Models;

class TransportExtend extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $area_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $top_area_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $area_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $sprice;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $transport_id;

    /**
     *
     * @var string
     * @Column(type="string", length=60, nullable=true)
     */
    protected $transport_title;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field area_id
     *
     * @param string $area_id
     * @return $this
     */
    public function setAreaId($area_id)
    {
        $this->area_id = $area_id;

        return $this;
    }

    /**
     * Method to set the value of field top_area_id
     *
     * @param string $top_area_id
     * @return $this
     */
    public function setTopAreaId($top_area_id)
    {
        $this->top_area_id = $top_area_id;

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
     * Method to set the value of field sprice
     *
     * @param double $sprice
     * @return $this
     */
    public function setSprice($sprice)
    {
        $this->sprice = $sprice;

        return $this;
    }

    /**
     * Method to set the value of field transport_id
     *
     * @param integer $transport_id
     * @return $this
     */
    public function setTransportId($transport_id)
    {
        $this->transport_id = $transport_id;

        return $this;
    }

    /**
     * Method to set the value of field transport_title
     *
     * @param string $transport_title
     * @return $this
     */
    public function setTransportTitle($transport_title)
    {
        $this->transport_title = $transport_title;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field area_id
     *
     * @return string
     */
    public function getAreaId()
    {
        return $this->area_id;
    }

    /**
     * Returns the value of field top_area_id
     *
     * @return string
     */
    public function getTopAreaId()
    {
        return $this->top_area_id;
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
     * Returns the value of field sprice
     *
     * @return double
     */
    public function getSprice()
    {
        return $this->sprice;
    }

    /**
     * Returns the value of field transport_id
     *
     * @return integer
     */
    public function getTransportId()
    {
        return $this->transport_id;
    }

    /**
     * Returns the value of field transport_title
     *
     * @return string
     */
    public function getTransportTitle()
    {
        return $this->transport_title;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'transport_extend';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TransportExtend[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TransportExtend
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
