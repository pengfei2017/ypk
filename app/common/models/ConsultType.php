<?php

namespace Ypk\Models;

class ConsultType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ct_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ct_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $ct_introduce;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $ct_sort;

    /**
     * Method to set the value of field ct_id
     *
     * @param integer $ct_id
     * @return $this
     */
    public function setCtId($ct_id)
    {
        $this->ct_id = $ct_id;

        return $this;
    }

    /**
     * Method to set the value of field ct_name
     *
     * @param string $ct_name
     * @return $this
     */
    public function setCtName($ct_name)
    {
        $this->ct_name = $ct_name;

        return $this;
    }

    /**
     * Method to set the value of field ct_introduce
     *
     * @param string $ct_introduce
     * @return $this
     */
    public function setCtIntroduce($ct_introduce)
    {
        $this->ct_introduce = $ct_introduce;

        return $this;
    }

    /**
     * Method to set the value of field ct_sort
     *
     * @param integer $ct_sort
     * @return $this
     */
    public function setCtSort($ct_sort)
    {
        $this->ct_sort = $ct_sort;

        return $this;
    }

    /**
     * Returns the value of field ct_id
     *
     * @return integer
     */
    public function getCtId()
    {
        return $this->ct_id;
    }

    /**
     * Returns the value of field ct_name
     *
     * @return string
     */
    public function getCtName()
    {
        return $this->ct_name;
    }

    /**
     * Returns the value of field ct_introduce
     *
     * @return string
     */
    public function getCtIntroduce()
    {
        return $this->ct_introduce;
    }

    /**
     * Returns the value of field ct_sort
     *
     * @return integer
     */
    public function getCtSort()
    {
        return $this->ct_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'consult_type';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ConsultType[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ConsultType
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
