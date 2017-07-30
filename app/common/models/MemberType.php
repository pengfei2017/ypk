<?php

namespace Ypk\Models;

class MemberType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $type_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $is_enable;

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
     * Method to set the value of field type_name
     *
     * @param string $type_name
     * @return $this
     */
    public function setTypeName($type_name)
    {
        $this->type_name = $type_name;

        return $this;
    }

    /**
     * Method to set the value of field is_enable
     *
     * @param integer $is_enable
     * @return $this
     */
    public function setIsEnable($is_enable)
    {
        $this->is_enable = $is_enable;

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
     * Returns the value of field type_name
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->type_name;
    }

    /**
     * Returns the value of field is_enable
     *
     * @return integer
     */
    public function getIsEnable()
    {
        return $this->is_enable;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_type';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberType[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberType
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
