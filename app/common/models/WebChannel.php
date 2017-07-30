<?php

namespace Ypk\Models;

class WebChannel extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $channel_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $channel_name;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $channel_style;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $gc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $gc_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $keywords;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $top_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $floor_ids;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $update_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $channel_show;

    /**
     * Method to set the value of field channel_id
     *
     * @param integer $channel_id
     * @return $this
     */
    public function setChannelId($channel_id)
    {
        $this->channel_id = $channel_id;

        return $this;
    }

    /**
     * Method to set the value of field channel_name
     *
     * @param string $channel_name
     * @return $this
     */
    public function setChannelName($channel_name)
    {
        $this->channel_name = $channel_name;

        return $this;
    }

    /**
     * Method to set the value of field channel_style
     *
     * @param string $channel_style
     * @return $this
     */
    public function setChannelStyle($channel_style)
    {
        $this->channel_style = $channel_style;

        return $this;
    }

    /**
     * Method to set the value of field gc_id
     *
     * @param integer $gc_id
     * @return $this
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

        return $this;
    }

    /**
     * Method to set the value of field gc_name
     *
     * @param string $gc_name
     * @return $this
     */
    public function setGcName($gc_name)
    {
        $this->gc_name = $gc_name;

        return $this;
    }

    /**
     * Method to set the value of field keywords
     *
     * @param string $keywords
     * @return $this
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field top_id
     *
     * @param integer $top_id
     * @return $this
     */
    public function setTopId($top_id)
    {
        $this->top_id = $top_id;

        return $this;
    }

    /**
     * Method to set the value of field floor_ids
     *
     * @param string $floor_ids
     * @return $this
     */
    public function setFloorIds($floor_ids)
    {
        $this->floor_ids = $floor_ids;

        return $this;
    }

    /**
     * Method to set the value of field update_time
     *
     * @param integer $update_time
     * @return $this
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;

        return $this;
    }

    /**
     * Method to set the value of field channel_show
     *
     * @param integer $channel_show
     * @return $this
     */
    public function setChannelShow($channel_show)
    {
        $this->channel_show = $channel_show;

        return $this;
    }

    /**
     * Returns the value of field channel_id
     *
     * @return integer
     */
    public function getChannelId()
    {
        return $this->channel_id;
    }

    /**
     * Returns the value of field channel_name
     *
     * @return string
     */
    public function getChannelName()
    {
        return $this->channel_name;
    }

    /**
     * Returns the value of field channel_style
     *
     * @return string
     */
    public function getChannelStyle()
    {
        return $this->channel_style;
    }

    /**
     * Returns the value of field gc_id
     *
     * @return integer
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Returns the value of field gc_name
     *
     * @return string
     */
    public function getGcName()
    {
        return $this->gc_name;
    }

    /**
     * Returns the value of field keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field top_id
     *
     * @return integer
     */
    public function getTopId()
    {
        return $this->top_id;
    }

    /**
     * Returns the value of field floor_ids
     *
     * @return string
     */
    public function getFloorIds()
    {
        return $this->floor_ids;
    }

    /**
     * Returns the value of field update_time
     *
     * @return integer
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Returns the value of field channel_show
     *
     * @return integer
     */
    public function getChannelShow()
    {
        return $this->channel_show;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'web_channel';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return WebChannel[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return WebChannel
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
