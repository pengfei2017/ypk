<?php

namespace Ypk\Models;

class SnsMembertag extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mtag_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $mtag_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $mtag_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $mtag_recommend;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $mtag_desc;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $mtag_img;

    /**
     * Method to set the value of field mtag_id
     *
     * @param integer $mtag_id
     * @return $this
     */
    public function setMtagId($mtag_id)
    {
        $this->mtag_id = $mtag_id;

        return $this;
    }

    /**
     * Method to set the value of field mtag_name
     *
     * @param string $mtag_name
     * @return $this
     */
    public function setMtagName($mtag_name)
    {
        $this->mtag_name = $mtag_name;

        return $this;
    }

    /**
     * Method to set the value of field mtag_sort
     *
     * @param integer $mtag_sort
     * @return $this
     */
    public function setMtagSort($mtag_sort)
    {
        $this->mtag_sort = $mtag_sort;

        return $this;
    }

    /**
     * Method to set the value of field mtag_recommend
     *
     * @param integer $mtag_recommend
     * @return $this
     */
    public function setMtagRecommend($mtag_recommend)
    {
        $this->mtag_recommend = $mtag_recommend;

        return $this;
    }

    /**
     * Method to set the value of field mtag_desc
     *
     * @param string $mtag_desc
     * @return $this
     */
    public function setMtagDesc($mtag_desc)
    {
        $this->mtag_desc = $mtag_desc;

        return $this;
    }

    /**
     * Method to set the value of field mtag_img
     *
     * @param string $mtag_img
     * @return $this
     */
    public function setMtagImg($mtag_img)
    {
        $this->mtag_img = $mtag_img;

        return $this;
    }

    /**
     * Returns the value of field mtag_id
     *
     * @return integer
     */
    public function getMtagId()
    {
        return $this->mtag_id;
    }

    /**
     * Returns the value of field mtag_name
     *
     * @return string
     */
    public function getMtagName()
    {
        return $this->mtag_name;
    }

    /**
     * Returns the value of field mtag_sort
     *
     * @return integer
     */
    public function getMtagSort()
    {
        return $this->mtag_sort;
    }

    /**
     * Returns the value of field mtag_recommend
     *
     * @return integer
     */
    public function getMtagRecommend()
    {
        return $this->mtag_recommend;
    }

    /**
     * Returns the value of field mtag_desc
     *
     * @return string
     */
    public function getMtagDesc()
    {
        return $this->mtag_desc;
    }

    /**
     * Returns the value of field mtag_img
     *
     * @return string
     */
    public function getMtagImg()
    {
        return $this->mtag_img;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_membertag';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsMembertag[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsMembertag
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
