<?php

namespace Ypk\Models;

class CmsSpecial extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=50, nullable=false)
     */
    protected $special_title;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $special_stitle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $special_margin_top;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $special_background;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $special_image;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $special_image_all;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $special_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $special_modify_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $special_publish_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $special_state;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $special_background_color;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $special_repeat;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $special_type;

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
     * Method to set the value of field special_title
     *
     * @param string $special_title
     * @return $this
     */
    public function setSpecialTitle($special_title)
    {
        $this->special_title = $special_title;

        return $this;
    }

    /**
     * Method to set the value of field special_stitle
     *
     * @param string $special_stitle
     * @return $this
     */
    public function setSpecialStitle($special_stitle)
    {
        $this->special_stitle = $special_stitle;

        return $this;
    }

    /**
     * Method to set the value of field special_margin_top
     *
     * @param integer $special_margin_top
     * @return $this
     */
    public function setSpecialMarginTop($special_margin_top)
    {
        $this->special_margin_top = $special_margin_top;

        return $this;
    }

    /**
     * Method to set the value of field special_background
     *
     * @param string $special_background
     * @return $this
     */
    public function setSpecialBackground($special_background)
    {
        $this->special_background = $special_background;

        return $this;
    }

    /**
     * Method to set the value of field special_image
     *
     * @param string $special_image
     * @return $this
     */
    public function setSpecialImage($special_image)
    {
        $this->special_image = $special_image;

        return $this;
    }

    /**
     * Method to set the value of field special_image_all
     *
     * @param string $special_image_all
     * @return $this
     */
    public function setSpecialImageAll($special_image_all)
    {
        $this->special_image_all = $special_image_all;

        return $this;
    }

    /**
     * Method to set the value of field special_content
     *
     * @param string $special_content
     * @return $this
     */
    public function setSpecialContent($special_content)
    {
        $this->special_content = $special_content;

        return $this;
    }

    /**
     * Method to set the value of field special_modify_time
     *
     * @param integer $special_modify_time
     * @return $this
     */
    public function setSpecialModifyTime($special_modify_time)
    {
        $this->special_modify_time = $special_modify_time;

        return $this;
    }

    /**
     * Method to set the value of field special_publish_id
     *
     * @param integer $special_publish_id
     * @return $this
     */
    public function setSpecialPublishId($special_publish_id)
    {
        $this->special_publish_id = $special_publish_id;

        return $this;
    }

    /**
     * Method to set the value of field special_state
     *
     * @param integer $special_state
     * @return $this
     */
    public function setSpecialState($special_state)
    {
        $this->special_state = $special_state;

        return $this;
    }

    /**
     * Method to set the value of field special_background_color
     *
     * @param string $special_background_color
     * @return $this
     */
    public function setSpecialBackgroundColor($special_background_color)
    {
        $this->special_background_color = $special_background_color;

        return $this;
    }

    /**
     * Method to set the value of field special_repeat
     *
     * @param string $special_repeat
     * @return $this
     */
    public function setSpecialRepeat($special_repeat)
    {
        $this->special_repeat = $special_repeat;

        return $this;
    }

    /**
     * Method to set the value of field special_type
     *
     * @param integer $special_type
     * @return $this
     */
    public function setSpecialType($special_type)
    {
        $this->special_type = $special_type;

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
     * Returns the value of field special_title
     *
     * @return string
     */
    public function getSpecialTitle()
    {
        return $this->special_title;
    }

    /**
     * Returns the value of field special_stitle
     *
     * @return string
     */
    public function getSpecialStitle()
    {
        return $this->special_stitle;
    }

    /**
     * Returns the value of field special_margin_top
     *
     * @return integer
     */
    public function getSpecialMarginTop()
    {
        return $this->special_margin_top;
    }

    /**
     * Returns the value of field special_background
     *
     * @return string
     */
    public function getSpecialBackground()
    {
        return $this->special_background;
    }

    /**
     * Returns the value of field special_image
     *
     * @return string
     */
    public function getSpecialImage()
    {
        return $this->special_image;
    }

    /**
     * Returns the value of field special_image_all
     *
     * @return string
     */
    public function getSpecialImageAll()
    {
        return $this->special_image_all;
    }

    /**
     * Returns the value of field special_content
     *
     * @return string
     */
    public function getSpecialContent()
    {
        return $this->special_content;
    }

    /**
     * Returns the value of field special_modify_time
     *
     * @return integer
     */
    public function getSpecialModifyTime()
    {
        return $this->special_modify_time;
    }

    /**
     * Returns the value of field special_publish_id
     *
     * @return integer
     */
    public function getSpecialPublishId()
    {
        return $this->special_publish_id;
    }

    /**
     * Returns the value of field special_state
     *
     * @return integer
     */
    public function getSpecialState()
    {
        return $this->special_state;
    }

    /**
     * Returns the value of field special_background_color
     *
     * @return string
     */
    public function getSpecialBackgroundColor()
    {
        return $this->special_background_color;
    }

    /**
     * Returns the value of field special_repeat
     *
     * @return string
     */
    public function getSpecialRepeat()
    {
        return $this->special_repeat;
    }

    /**
     * Returns the value of field special_type
     *
     * @return integer
     */
    public function getSpecialType()
    {
        return $this->special_type;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_special';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsSpecial[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsSpecial
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
