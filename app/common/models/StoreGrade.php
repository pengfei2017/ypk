<?php

namespace Ypk\Models;

class StoreGrade extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sg_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $sg_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sg_goods_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $sg_album_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sg_space_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $sg_template_number;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $sg_template;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $sg_price;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $sg_description;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $sg_function;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $sg_sort;

    /**
     * Method to set the value of field sg_id
     *
     * @param integer $sg_id
     * @return $this
     */
    public function setSgId($sg_id)
    {
        $this->sg_id = $sg_id;

        return $this;
    }

    /**
     * Method to set the value of field sg_name
     *
     * @param string $sg_name
     * @return $this
     */
    public function setSgName($sg_name)
    {
        $this->sg_name = $sg_name;

        return $this;
    }

    /**
     * Method to set the value of field sg_goods_limit
     *
     * @param integer $sg_goods_limit
     * @return $this
     */
    public function setSgGoodsLimit($sg_goods_limit)
    {
        $this->sg_goods_limit = $sg_goods_limit;

        return $this;
    }

    /**
     * Method to set the value of field sg_album_limit
     *
     * @param integer $sg_album_limit
     * @return $this
     */
    public function setSgAlbumLimit($sg_album_limit)
    {
        $this->sg_album_limit = $sg_album_limit;

        return $this;
    }

    /**
     * Method to set the value of field sg_space_limit
     *
     * @param integer $sg_space_limit
     * @return $this
     */
    public function setSgSpaceLimit($sg_space_limit)
    {
        $this->sg_space_limit = $sg_space_limit;

        return $this;
    }

    /**
     * Method to set the value of field sg_template_number
     *
     * @param integer $sg_template_number
     * @return $this
     */
    public function setSgTemplateNumber($sg_template_number)
    {
        $this->sg_template_number = $sg_template_number;

        return $this;
    }

    /**
     * Method to set the value of field sg_template
     *
     * @param string $sg_template
     * @return $this
     */
    public function setSgTemplate($sg_template)
    {
        $this->sg_template = $sg_template;

        return $this;
    }

    /**
     * Method to set the value of field sg_price
     *
     * @param double $sg_price
     * @return $this
     */
    public function setSgPrice($sg_price)
    {
        $this->sg_price = $sg_price;

        return $this;
    }

    /**
     * Method to set the value of field sg_description
     *
     * @param string $sg_description
     * @return $this
     */
    public function setSgDescription($sg_description)
    {
        $this->sg_description = $sg_description;

        return $this;
    }

    /**
     * Method to set the value of field sg_function
     *
     * @param string $sg_function
     * @return $this
     */
    public function setSgFunction($sg_function)
    {
        $this->sg_function = $sg_function;

        return $this;
    }

    /**
     * Method to set the value of field sg_sort
     *
     * @param integer $sg_sort
     * @return $this
     */
    public function setSgSort($sg_sort)
    {
        $this->sg_sort = $sg_sort;

        return $this;
    }

    /**
     * Returns the value of field sg_id
     *
     * @return integer
     */
    public function getSgId()
    {
        return $this->sg_id;
    }

    /**
     * Returns the value of field sg_name
     *
     * @return string
     */
    public function getSgName()
    {
        return $this->sg_name;
    }

    /**
     * Returns the value of field sg_goods_limit
     *
     * @return integer
     */
    public function getSgGoodsLimit()
    {
        return $this->sg_goods_limit;
    }

    /**
     * Returns the value of field sg_album_limit
     *
     * @return integer
     */
    public function getSgAlbumLimit()
    {
        return $this->sg_album_limit;
    }

    /**
     * Returns the value of field sg_space_limit
     *
     * @return integer
     */
    public function getSgSpaceLimit()
    {
        return $this->sg_space_limit;
    }

    /**
     * Returns the value of field sg_template_number
     *
     * @return integer
     */
    public function getSgTemplateNumber()
    {
        return $this->sg_template_number;
    }

    /**
     * Returns the value of field sg_template
     *
     * @return string
     */
    public function getSgTemplate()
    {
        return $this->sg_template;
    }

    /**
     * Returns the value of field sg_price
     *
     * @return double
     */
    public function getSgPrice()
    {
        return $this->sg_price;
    }

    /**
     * Returns the value of field sg_description
     *
     * @return string
     */
    public function getSgDescription()
    {
        return $this->sg_description;
    }

    /**
     * Returns the value of field sg_function
     *
     * @return string
     */
    public function getSgFunction()
    {
        return $this->sg_function;
    }

    /**
     * Returns the value of field sg_sort
     *
     * @return integer
     */
    public function getSgSort()
    {
        return $this->sg_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_grade';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreGrade[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreGrade
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
