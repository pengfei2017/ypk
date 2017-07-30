<?php

namespace Ypk\Models;

class TypeCustom extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $custom_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $custom_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     * Method to set the value of field custom_id
     *
     * @param integer $custom_id
     * @return $this
     */
    public function setCustomId($custom_id)
    {
        $this->custom_id = $custom_id;

        return $this;
    }

    /**
     * Method to set the value of field custom_name
     *
     * @param string $custom_name
     * @return $this
     */
    public function setCustomName($custom_name)
    {
        $this->custom_name = $custom_name;

        return $this;
    }

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
     * Returns the value of field custom_id
     *
     * @return integer
     */
    public function getCustomId()
    {
        return $this->custom_id;
    }

    /**
     * Returns the value of field custom_name
     *
     * @return string
     */
    public function getCustomName()
    {
        return $this->custom_name;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'type_custom';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TypeCustom[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TypeCustom
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
