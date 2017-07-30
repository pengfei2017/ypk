<?php

namespace Ypk\Models;

class StoreClass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $sc_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $sc_bail;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $sc_sort;

    /**
     * Method to set the value of field sc_id
     *
     * @param integer $sc_id
     * @return $this
     */
    public function setScId($sc_id)
    {
        $this->sc_id = $sc_id;

        return $this;
    }

    /**
     * Method to set the value of field sc_name
     *
     * @param string $sc_name
     * @return $this
     */
    public function setScName($sc_name)
    {
        $this->sc_name = $sc_name;

        return $this;
    }

    /**
     * Method to set the value of field sc_bail
     *
     * @param integer $sc_bail
     * @return $this
     */
    public function setScBail($sc_bail)
    {
        $this->sc_bail = $sc_bail;

        return $this;
    }

    /**
     * Method to set the value of field sc_sort
     *
     * @param integer $sc_sort
     * @return $this
     */
    public function setScSort($sc_sort)
    {
        $this->sc_sort = $sc_sort;

        return $this;
    }

    /**
     * Returns the value of field sc_id
     *
     * @return integer
     */
    public function getScId()
    {
        return $this->sc_id;
    }

    /**
     * Returns the value of field sc_name
     *
     * @return string
     */
    public function getScName()
    {
        return $this->sc_name;
    }

    /**
     * Returns the value of field sc_bail
     *
     * @return integer
     */
    public function getScBail()
    {
        return $this->sc_bail;
    }

    /**
     * Returns the value of field sc_sort
     *
     * @return integer
     */
    public function getScSort()
    {
        return $this->sc_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
