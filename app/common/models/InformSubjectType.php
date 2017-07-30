<?php

namespace Ypk\Models;

class InformSubjectType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $inform_type_name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $inform_type_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $inform_type_state;

    /**
     * Method to set the value of field inform_type_id
     *
     * @param integer $inform_type_id
     * @return $this
     */
    public function setInformTypeId($inform_type_id)
    {
        $this->inform_type_id = $inform_type_id;

        return $this;
    }

    /**
     * Method to set the value of field inform_type_name
     *
     * @param string $inform_type_name
     * @return $this
     */
    public function setInformTypeName($inform_type_name)
    {
        $this->inform_type_name = $inform_type_name;

        return $this;
    }

    /**
     * Method to set the value of field inform_type_desc
     *
     * @param string $inform_type_desc
     * @return $this
     */
    public function setInformTypeDesc($inform_type_desc)
    {
        $this->inform_type_desc = $inform_type_desc;

        return $this;
    }

    /**
     * Method to set the value of field inform_type_state
     *
     * @param integer $inform_type_state
     * @return $this
     */
    public function setInformTypeState($inform_type_state)
    {
        $this->inform_type_state = $inform_type_state;

        return $this;
    }

    /**
     * Returns the value of field inform_type_id
     *
     * @return integer
     */
    public function getInformTypeId()
    {
        return $this->inform_type_id;
    }

    /**
     * Returns the value of field inform_type_name
     *
     * @return string
     */
    public function getInformTypeName()
    {
        return $this->inform_type_name;
    }

    /**
     * Returns the value of field inform_type_desc
     *
     * @return string
     */
    public function getInformTypeDesc()
    {
        return $this->inform_type_desc;
    }

    /**
     * Returns the value of field inform_type_state
     *
     * @return integer
     */
    public function getInformTypeState()
    {
        return $this->inform_type_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'inform_subject_type';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return InformSubjectType[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return InformSubjectType
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
