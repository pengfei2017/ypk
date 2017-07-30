<?php

namespace Ypk\Models;

class StorePlate extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $plate_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $plate_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $plate_position;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $plate_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     * Method to set the value of field plate_id
     *
     * @param integer $plate_id
     * @return $this
     */
    public function setPlateId($plate_id)
    {
        $this->plate_id = $plate_id;

        return $this;
    }

    /**
     * Method to set the value of field plate_name
     *
     * @param string $plate_name
     * @return $this
     */
    public function setPlateName($plate_name)
    {
        $this->plate_name = $plate_name;

        return $this;
    }

    /**
     * Method to set the value of field plate_position
     *
     * @param integer $plate_position
     * @return $this
     */
    public function setPlatePosition($plate_position)
    {
        $this->plate_position = $plate_position;

        return $this;
    }

    /**
     * Method to set the value of field plate_content
     *
     * @param string $plate_content
     * @return $this
     */
    public function setPlateContent($plate_content)
    {
        $this->plate_content = $plate_content;

        return $this;
    }

    /**
     * Method to set the value of field store_id
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

        return $this;
    }

    /**
     * Returns the value of field plate_id
     *
     * @return integer
     */
    public function getPlateId()
    {
        return $this->plate_id;
    }

    /**
     * Returns the value of field plate_name
     *
     * @return string
     */
    public function getPlateName()
    {
        return $this->plate_name;
    }

    /**
     * Returns the value of field plate_position
     *
     * @return integer
     */
    public function getPlatePosition()
    {
        return $this->plate_position;
    }

    /**
     * Returns the value of field plate_content
     *
     * @return string
     */
    public function getPlateContent()
    {
        return $this->plate_content;
    }

    /**
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_plate';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StorePlate[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StorePlate
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
