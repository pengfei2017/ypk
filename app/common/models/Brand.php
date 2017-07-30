<?php

namespace Ypk\Models;

class Brand extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $brand_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $brand_name;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $brand_initial;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $brand_class;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $brand_pic;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $brand_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $brand_recommend;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $brand_apply;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $class_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $show_type;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $brand_bgpic;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $brand_xbgpic;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $brand_tjstore;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $brand_introduction;

    /**
     * Method to set the value of field brand_id
     *
     * @param integer $brand_id
     * @return $this
     */
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Method to set the value of field brand_name
     *
     * @param string $brand_name
     * @return $this
     */
    public function setBrandName($brand_name)
    {
        $this->brand_name = $brand_name;

        return $this;
    }

    /**
     * Method to set the value of field brand_initial
     *
     * @param string $brand_initial
     * @return $this
     */
    public function setBrandInitial($brand_initial)
    {
        $this->brand_initial = $brand_initial;

        return $this;
    }

    /**
     * Method to set the value of field brand_class
     *
     * @param string $brand_class
     * @return $this
     */
    public function setBrandClass($brand_class)
    {
        $this->brand_class = $brand_class;

        return $this;
    }

    /**
     * Method to set the value of field brand_pic
     *
     * @param string $brand_pic
     * @return $this
     */
    public function setBrandPic($brand_pic)
    {
        $this->brand_pic = $brand_pic;

        return $this;
    }

    /**
     * Method to set the value of field brand_sort
     *
     * @param integer $brand_sort
     * @return $this
     */
    public function setBrandSort($brand_sort)
    {
        $this->brand_sort = $brand_sort;

        return $this;
    }

    /**
     * Method to set the value of field brand_recommend
     *
     * @param integer $brand_recommend
     * @return $this
     */
    public function setBrandRecommend($brand_recommend)
    {
        $this->brand_recommend = $brand_recommend;

        return $this;
    }

    /**
     * Method to set the value of field store_id
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

        return $this;
    }

    /**
     * Method to set the value of field brand_apply
     *
     * @param integer $brand_apply
     * @return $this
     */
    public function setBrandApply($brand_apply)
    {
        $this->brand_apply = $brand_apply;

        return $this;
    }

    /**
     * Method to set the value of field class_id
     *
     * @param integer $class_id
     * @return $this
     */
    public function setClassId($class_id)
    {
        $this->class_id = $class_id;

        return $this;
    }

    /**
     * Method to set the value of field show_type
     *
     * @param integer $show_type
     * @return $this
     */
    public function setShowType($show_type)
    {
        $this->show_type = $show_type;

        return $this;
    }

    /**
     * Method to set the value of field brand_bgpic
     *
     * @param string $brand_bgpic
     * @return $this
     */
    public function setBrandBgpic($brand_bgpic)
    {
        $this->brand_bgpic = $brand_bgpic;

        return $this;
    }

    /**
     * Method to set the value of field brand_xbgpic
     *
     * @param string $brand_xbgpic
     * @return $this
     */
    public function setBrandXbgpic($brand_xbgpic)
    {
        $this->brand_xbgpic = $brand_xbgpic;

        return $this;
    }

    /**
     * Method to set the value of field brand_tjstore
     *
     * @param string $brand_tjstore
     * @return $this
     */
    public function setBrandTjstore($brand_tjstore)
    {
        $this->brand_tjstore = $brand_tjstore;

        return $this;
    }

    /**
     * Method to set the value of field brand_introduction
     *
     * @param string $brand_introduction
     * @return $this
     */
    public function setBrandIntroduction($brand_introduction)
    {
        $this->brand_introduction = $brand_introduction;

        return $this;
    }

    /**
     * Returns the value of field brand_id
     *
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Returns the value of field brand_name
     *
     * @return string
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Returns the value of field brand_initial
     *
     * @return string
     */
    public function getBrandInitial()
    {
        return $this->brand_initial;
    }

    /**
     * Returns the value of field brand_class
     *
     * @return string
     */
    public function getBrandClass()
    {
        return $this->brand_class;
    }

    /**
     * Returns the value of field brand_pic
     *
     * @return string
     */
    public function getBrandPic()
    {
        return $this->brand_pic;
    }

    /**
     * Returns the value of field brand_sort
     *
     * @return integer
     */
    public function getBrandSort()
    {
        return $this->brand_sort;
    }

    /**
     * Returns the value of field brand_recommend
     *
     * @return integer
     */
    public function getBrandRecommend()
    {
        return $this->brand_recommend;
    }

    /**
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field brand_apply
     *
     * @return integer
     */
    public function getBrandApply()
    {
        return $this->brand_apply;
    }

    /**
     * Returns the value of field class_id
     *
     * @return integer
     */
    public function getClassId()
    {
        return $this->class_id;
    }

    /**
     * Returns the value of field show_type
     *
     * @return integer
     */
    public function getShowType()
    {
        return $this->show_type;
    }

    /**
     * Returns the value of field brand_bgpic
     *
     * @return string
     */
    public function getBrandBgpic()
    {
        return $this->brand_bgpic;
    }

    /**
     * Returns the value of field brand_xbgpic
     *
     * @return string
     */
    public function getBrandXbgpic()
    {
        return $this->brand_xbgpic;
    }

    /**
     * Returns the value of field brand_tjstore
     *
     * @return string
     */
    public function getBrandTjstore()
    {
        return $this->brand_tjstore;
    }

    /**
     * Returns the value of field brand_introduction
     *
     * @return string
     */
    public function getBrandIntroduction()
    {
        return $this->brand_introduction;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'brand';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Brand[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Brand
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
