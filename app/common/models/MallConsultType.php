<?php

namespace Ypk\Models;

class MallConsultType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mct_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $mct_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $mct_introduce;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $mct_sort;

    /**
     * Method to set the value of field mct_id
     *
     * @param integer $mct_id
     * @return $this
     */
    public function setMctId($mct_id)
    {
        $this->mct_id = $mct_id;

        return $this;
    }

    /**
     * Method to set the value of field mct_name
     *
     * @param string $mct_name
     * @return $this
     */
    public function setMctName($mct_name)
    {
        $this->mct_name = $mct_name;

        return $this;
    }

    /**
     * Method to set the value of field mct_introduce
     *
     * @param string $mct_introduce
     * @return $this
     */
    public function setMctIntroduce($mct_introduce)
    {
        $this->mct_introduce = $mct_introduce;

        return $this;
    }

    /**
     * Method to set the value of field mct_sort
     *
     * @param integer $mct_sort
     * @return $this
     */
    public function setMctSort($mct_sort)
    {
        $this->mct_sort = $mct_sort;

        return $this;
    }

    /**
     * Returns the value of field mct_id
     *
     * @return integer
     */
    public function getMctId()
    {
        return $this->mct_id;
    }

    /**
     * Returns the value of field mct_name
     *
     * @return string
     */
    public function getMctName()
    {
        return $this->mct_name;
    }

    /**
     * Returns the value of field mct_introduce
     *
     * @return string
     */
    public function getMctIntroduce()
    {
        return $this->mct_introduce;
    }

    /**
     * Returns the value of field mct_sort
     *
     * @return integer
     */
    public function getMctSort()
    {
        return $this->mct_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mall_consult_type';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MallConsultType[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MallConsultType
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
