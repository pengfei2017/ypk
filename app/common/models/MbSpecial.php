<?php

namespace Ypk\Models;

class MbSpecial extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $special_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $special_desc;

    /**
     * Method to set the value of field special_id
     *
     * @param integer $special_id
     * @return $this
     */
    public function setSpecialId($special_id)
    {
        $this->special_id = $special_id;

        return $this;
    }

    /**
     * Method to set the value of field special_desc
     *
     * @param string $special_desc
     * @return $this
     */
    public function setSpecialDesc($special_desc)
    {
        $this->special_desc = $special_desc;

        return $this;
    }

    /**
     * Returns the value of field special_id
     *
     * @return integer
     */
    public function getSpecialId()
    {
        return $this->special_id;
    }

    /**
     * Returns the value of field special_desc
     *
     * @return string
     */
    public function getSpecialDesc()
    {
        return $this->special_desc;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mb_special';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbSpecial[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbSpecial
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
