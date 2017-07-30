<?php

namespace Ypk\Models;

class StoreWatermark extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $wm_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $jpeg_quality;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $wm_image_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $wm_image_pos;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $wm_image_transition;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $wm_text;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $wm_text_size;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $wm_text_angle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $wm_text_pos;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $wm_text_font;

    /**
     *
     * @var string
     * @Column(type="string", length=7, nullable=false)
     */
    protected $wm_text_color;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $wm_is_open;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_id;

    /**
     * Method to set the value of field wm_id
     *
     * @param integer $wm_id
     * @return $this
     */
    public function setWmId($wm_id)
    {
        $this->wm_id = $wm_id;

        return $this;
    }

    /**
     * Method to set the value of field jpeg_quality
     *
     * @param integer $jpeg_quality
     * @return $this
     */
    public function setJpegQuality($jpeg_quality)
    {
        $this->jpeg_quality = $jpeg_quality;

        return $this;
    }

    /**
     * Method to set the value of field wm_image_name
     *
     * @param string $wm_image_name
     * @return $this
     */
    public function setWmImageName($wm_image_name)
    {
        $this->wm_image_name = $wm_image_name;

        return $this;
    }

    /**
     * Method to set the value of field wm_image_pos
     *
     * @param integer $wm_image_pos
     * @return $this
     */
    public function setWmImagePos($wm_image_pos)
    {
        $this->wm_image_pos = $wm_image_pos;

        return $this;
    }

    /**
     * Method to set the value of field wm_image_transition
     *
     * @param integer $wm_image_transition
     * @return $this
     */
    public function setWmImageTransition($wm_image_transition)
    {
        $this->wm_image_transition = $wm_image_transition;

        return $this;
    }

    /**
     * Method to set the value of field wm_text
     *
     * @param string $wm_text
     * @return $this
     */
    public function setWmText($wm_text)
    {
        $this->wm_text = $wm_text;

        return $this;
    }

    /**
     * Method to set the value of field wm_text_size
     *
     * @param integer $wm_text_size
     * @return $this
     */
    public function setWmTextSize($wm_text_size)
    {
        $this->wm_text_size = $wm_text_size;

        return $this;
    }

    /**
     * Method to set the value of field wm_text_angle
     *
     * @param integer $wm_text_angle
     * @return $this
     */
    public function setWmTextAngle($wm_text_angle)
    {
        $this->wm_text_angle = $wm_text_angle;

        return $this;
    }

    /**
     * Method to set the value of field wm_text_pos
     *
     * @param integer $wm_text_pos
     * @return $this
     */
    public function setWmTextPos($wm_text_pos)
    {
        $this->wm_text_pos = $wm_text_pos;

        return $this;
    }

    /**
     * Method to set the value of field wm_text_font
     *
     * @param string $wm_text_font
     * @return $this
     */
    public function setWmTextFont($wm_text_font)
    {
        $this->wm_text_font = $wm_text_font;

        return $this;
    }

    /**
     * Method to set the value of field wm_text_color
     *
     * @param string $wm_text_color
     * @return $this
     */
    public function setWmTextColor($wm_text_color)
    {
        $this->wm_text_color = $wm_text_color;

        return $this;
    }

    /**
     * Method to set the value of field wm_is_open
     *
     * @param integer $wm_is_open
     * @return $this
     */
    public function setWmIsOpen($wm_is_open)
    {
        $this->wm_is_open = $wm_is_open;

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
     * Returns the value of field wm_id
     *
     * @return integer
     */
    public function getWmId()
    {
        return $this->wm_id;
    }

    /**
     * Returns the value of field jpeg_quality
     *
     * @return integer
     */
    public function getJpegQuality()
    {
        return $this->jpeg_quality;
    }

    /**
     * Returns the value of field wm_image_name
     *
     * @return string
     */
    public function getWmImageName()
    {
        return $this->wm_image_name;
    }

    /**
     * Returns the value of field wm_image_pos
     *
     * @return integer
     */
    public function getWmImagePos()
    {
        return $this->wm_image_pos;
    }

    /**
     * Returns the value of field wm_image_transition
     *
     * @return integer
     */
    public function getWmImageTransition()
    {
        return $this->wm_image_transition;
    }

    /**
     * Returns the value of field wm_text
     *
     * @return string
     */
    public function getWmText()
    {
        return $this->wm_text;
    }

    /**
     * Returns the value of field wm_text_size
     *
     * @return integer
     */
    public function getWmTextSize()
    {
        return $this->wm_text_size;
    }

    /**
     * Returns the value of field wm_text_angle
     *
     * @return integer
     */
    public function getWmTextAngle()
    {
        return $this->wm_text_angle;
    }

    /**
     * Returns the value of field wm_text_pos
     *
     * @return integer
     */
    public function getWmTextPos()
    {
        return $this->wm_text_pos;
    }

    /**
     * Returns the value of field wm_text_font
     *
     * @return string
     */
    public function getWmTextFont()
    {
        return $this->wm_text_font;
    }

    /**
     * Returns the value of field wm_text_color
     *
     * @return string
     */
    public function getWmTextColor()
    {
        return $this->wm_text_color;
    }

    /**
     * Returns the value of field wm_is_open
     *
     * @return integer
     */
    public function getWmIsOpen()
    {
        return $this->wm_is_open;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_watermark';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreWatermark[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreWatermark
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
