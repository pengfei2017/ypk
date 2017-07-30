<?php

namespace Ypk\Models;

class VrGroupbuyArea extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $area_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $area_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $parent_area_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $add_time;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $first_letter;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $area_number;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $post;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $hot_city;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $area_num;

    /**
     * Method to set the value of field area_id
     *
     * @param integer $area_id
     * @return $this
     */
    public function setAreaId($area_id)
    {
        $this->area_id = $area_id;

        return $this;
    }

    /**
     * Method to set the value of field area_name
     *
     * @param string $area_name
     * @return $this
     */
    public function setAreaName($area_name)
    {
        $this->area_name = $area_name;

        return $this;
    }

    /**
     * Method to set the value of field parent_area_id
     *
     * @param integer $parent_area_id
     * @return $this
     */
    public function setParentAreaId($parent_area_id)
    {
        $this->parent_area_id = $parent_area_id;

        return $this;
    }

    /**
     * Method to set the value of field add_time
     *
     * @param integer $add_time
     * @return $this
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;

        return $this;
    }

    /**
     * Method to set the value of field first_letter
     *
     * @param string $first_letter
     * @return $this
     */
    public function setFirstLetter($first_letter)
    {
        $this->first_letter = $first_letter;

        return $this;
    }

    /**
     * Method to set the value of field area_number
     *
     * @param string $area_number
     * @return $this
     */
    public function setAreaNumber($area_number)
    {
        $this->area_number = $area_number;

        return $this;
    }

    /**
     * Method to set the value of field post
     *
     * @param string $post
     * @return $this
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Method to set the value of field hot_city
     *
     * @param integer $hot_city
     * @return $this
     */
    public function setHotCity($hot_city)
    {
        $this->hot_city = $hot_city;

        return $this;
    }

    /**
     * Method to set the value of field area_num
     *
     * @param integer $area_num
     * @return $this
     */
    public function setAreaNum($area_num)
    {
        $this->area_num = $area_num;

        return $this;
    }

    /**
     * Returns the value of field area_id
     *
     * @return integer
     */
    public function getAreaId()
    {
        return $this->area_id;
    }

    /**
     * Returns the value of field area_name
     *
     * @return string
     */
    public function getAreaName()
    {
        return $this->area_name;
    }

    /**
     * Returns the value of field parent_area_id
     *
     * @return integer
     */
    public function getParentAreaId()
    {
        return $this->parent_area_id;
    }

    /**
     * Returns the value of field add_time
     *
     * @return integer
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * Returns the value of field first_letter
     *
     * @return string
     */
    public function getFirstLetter()
    {
        return $this->first_letter;
    }

    /**
     * Returns the value of field area_number
     *
     * @return string
     */
    public function getAreaNumber()
    {
        return $this->area_number;
    }

    /**
     * Returns the value of field post
     *
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Returns the value of field hot_city
     *
     * @return integer
     */
    public function getHotCity()
    {
        return $this->hot_city;
    }

    /**
     * Returns the value of field area_num
     *
     * @return integer
     */
    public function getAreaNum()
    {
        return $this->area_num;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vr_groupbuy_area';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrGroupbuyArea[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrGroupbuyArea
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
