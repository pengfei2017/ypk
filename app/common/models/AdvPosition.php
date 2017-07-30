<?php

namespace Ypk\Models;

class AdvPosition extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $ap_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $ap_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $ap_class;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $ap_display;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $is_use;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ap_width;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ap_height;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $adv_num;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $click_num;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $default_content;

    /**
     * Method to set the value of field ap_id
     *
     * @param integer $ap_id
     * @return $this
     */
    public function setApId($ap_id)
    {
        $this->ap_id = $ap_id;

        return $this;
    }

    /**
     * Method to set the value of field ap_name
     *
     * @param string $ap_name
     * @return $this
     */
    public function setApName($ap_name)
    {
        $this->ap_name = $ap_name;

        return $this;
    }

    /**
     * Method to set the value of field ap_class
     *
     * @param integer $ap_class
     * @return $this
     */
    public function setApClass($ap_class)
    {
        $this->ap_class = $ap_class;

        return $this;
    }

    /**
     * Method to set the value of field ap_display
     *
     * @param integer $ap_display
     * @return $this
     */
    public function setApDisplay($ap_display)
    {
        $this->ap_display = $ap_display;

        return $this;
    }

    /**
     * Method to set the value of field is_use
     *
     * @param integer $is_use
     * @return $this
     */
    public function setIsUse($is_use)
    {
        $this->is_use = $is_use;

        return $this;
    }

    /**
     * Method to set the value of field ap_width
     *
     * @param integer $ap_width
     * @return $this
     */
    public function setApWidth($ap_width)
    {
        $this->ap_width = $ap_width;

        return $this;
    }

    /**
     * Method to set the value of field ap_height
     *
     * @param integer $ap_height
     * @return $this
     */
    public function setApHeight($ap_height)
    {
        $this->ap_height = $ap_height;

        return $this;
    }

    /**
     * Method to set the value of field adv_num
     *
     * @param integer $adv_num
     * @return $this
     */
    public function setAdvNum($adv_num)
    {
        $this->adv_num = $adv_num;

        return $this;
    }

    /**
     * Method to set the value of field click_num
     *
     * @param integer $click_num
     * @return $this
     */
    public function setClickNum($click_num)
    {
        $this->click_num = $click_num;

        return $this;
    }

    /**
     * Method to set the value of field default_content
     *
     * @param string $default_content
     * @return $this
     */
    public function setDefaultContent($default_content)
    {
        $this->default_content = $default_content;

        return $this;
    }

    /**
     * Returns the value of field ap_id
     *
     * @return integer
     */
    public function getApId()
    {
        return $this->ap_id;
    }

    /**
     * Returns the value of field ap_name
     *
     * @return string
     */
    public function getApName()
    {
        return $this->ap_name;
    }

    /**
     * Returns the value of field ap_class
     *
     * @return integer
     */
    public function getApClass()
    {
        return $this->ap_class;
    }

    /**
     * Returns the value of field ap_display
     *
     * @return integer
     */
    public function getApDisplay()
    {
        return $this->ap_display;
    }

    /**
     * Returns the value of field is_use
     *
     * @return integer
     */
    public function getIsUse()
    {
        return $this->is_use;
    }

    /**
     * Returns the value of field ap_width
     *
     * @return integer
     */
    public function getApWidth()
    {
        return $this->ap_width;
    }

    /**
     * Returns the value of field ap_height
     *
     * @return integer
     */
    public function getApHeight()
    {
        return $this->ap_height;
    }

    /**
     * Returns the value of field adv_num
     *
     * @return integer
     */
    public function getAdvNum()
    {
        return $this->adv_num;
    }

    /**
     * Returns the value of field click_num
     *
     * @return integer
     */
    public function getClickNum()
    {
        return $this->click_num;
    }

    /**
     * Returns the value of field default_content
     *
     * @return string
     */
    public function getDefaultContent()
    {
        return $this->default_content;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adv_position';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdvPosition[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdvPosition
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
