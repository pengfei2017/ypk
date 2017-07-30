<?php

namespace Ypk\Models;

class TypeSpec extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sp_id;

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
     * Method to set the value of field sp_id
     *
     * @param integer $sp_id
     * @return $this
     */
    public function setSpId($sp_id)
    {
        $this->sp_id = $sp_id;

        return $this;
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
     * Returns the value of field sp_id
     *
     * @return integer
     */
    public function getSpId()
    {
        return $this->sp_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'type_spec';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TypeSpec[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TypeSpec
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
