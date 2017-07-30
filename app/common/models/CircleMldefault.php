<?php

namespace Ypk\Models;

class CircleMldefault extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $mld_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mld_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mld_exp;

    /**
     * Method to set the value of field mld_id
     *
     * @param integer $mld_id
     * @return $this
     */
    public function setMldId($mld_id)
    {
        $this->mld_id = $mld_id;

        return $this;
    }

    /**
     * Method to set the value of field mld_name
     *
     * @param string $mld_name
     * @return $this
     */
    public function setMldName($mld_name)
    {
        $this->mld_name = $mld_name;

        return $this;
    }

    /**
     * Method to set the value of field mld_exp
     *
     * @param integer $mld_exp
     * @return $this
     */
    public function setMldExp($mld_exp)
    {
        $this->mld_exp = $mld_exp;

        return $this;
    }

    /**
     * Returns the value of field mld_id
     *
     * @return integer
     */
    public function getMldId()
    {
        return $this->mld_id;
    }

    /**
     * Returns the value of field mld_name
     *
     * @return string
     */
    public function getMldName()
    {
        return $this->mld_name;
    }

    /**
     * Returns the value of field mld_exp
     *
     * @return integer
     */
    public function getMldExp()
    {
        return $this->mld_exp;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_mldefault';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMldefault[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMldefault
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
